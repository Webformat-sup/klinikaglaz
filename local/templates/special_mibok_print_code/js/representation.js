document.addEventListener("DOMContentLoaded", () => {
    function getData(data) {
        return new Promise(function(resolve, reject) {
            
            const requestURL = "/bitrix/tools/mibok.glaza/get_representation.php";
            const xhr = new XMLHttpRequest();
            xhr.open('POST', requestURL);
      
            xhr.onload = function() {
                if (this.status == 200) {
                    resolve(this.response);
                } else {
                    let error = new Error(this.statusText);
                    error.code = this.status;
                    reject(error);
                }
            };
      
            xhr.onerror = function() {
                reject(new Error("Network Error"));
            };
        
            xhr.send(data);
        });
    }

    function doElement(id) {
        let represLinkTitle = document.querySelector("#mibok-hid-representation").value;
        let represLink = document.querySelector("#mibok-hid-representation").dataset.site + 'slabovid_view.php?ID=' + id;
        let newElement = document.createElement("a");
        newElement.className = "representation-link";
        newElement.setAttribute('href', represLink);
        newElement.setAttribute('target', '_blank');
        newElement.title = represLinkTitle;
        newElement.textContent = represLinkTitle;
        return newElement;
    }

    function doWrapper(element) {
        if (element.tagName === "VIDEO" && element.parentNode.className.indexOf('video-js') != -1 || element.tagName === "AUDIO" && element.parentNode.className.indexOf('video-js') != -1)
            element.parentNode.classList.add('mibok-margin-bottom');

        let elementStyles = window.getComputedStyle(element);
        let parentStyles = window.getComputedStyle(element.parentNode);
        if (parentStyles.position == 'absolute' || parentStyles.position == 'fixed')
            element.parentNode.style.marginBottom = '20px';
        let maxWidth = elementStyles.width;
        let newDiv = document.createElement("div");
        newDiv.className = 'mibok-position';
        element.after(newDiv);
        newDiv.append(element);
        newDiv.style.width = maxWidth;
    }

    let targetTags = [...document.querySelectorAll("a:not(#bx-panel a, .panel-body a, .navbar a, a.norepreslink), audio, video, iframe, embed, object, img")];
    if (targetTags.length > 0) {
        let linkList = [];
        targetTags.forEach((e) => {
            if (e.tagName === "A" && !["AUDIO", "VIDEO", "EMBED"].includes(e.parentNode.tagName)) linkList.push(e.href);
            else if ((e.tagName === "VIDEO" && e.src.length > 0) 
            || 
            (e.tagName === "AUDIO" && e.src.length > 0) 
            || 
            (e.tagName === "EMBED" && e.src.length > 0) 
            || 
            (e.tagName === "IFRAME" && e.src.length > 0) 
            || 
            (e.tagName === "IMG" && e.src.length > 0)) 
                linkList.push(e.src);
            else if ((e.tagName === "VIDEO" && e.src.length == 0) 
            || 
            (e.tagName === "AUDIO" && e.src.length == 0)) {
                e.childNodes.forEach((childTag) => {
                    if (childTag.tagName === "SOURCE" && childTag.src.length > 0) linkList.push(childTag.src);
                })
            } else if (e.tagName === "IFRAME" && e.src.length == 0 && e.srcdoc.length > 0)
                linkList.push(e.srcdoc);
            else if (e.tagName === "OBJECT" && e.data.length > 0)
                linkList.push(e.data);
        })
        let linkStr = JSON.stringify(linkList);
        getData(linkStr)
            .then(
                response => {
                    let data = JSON.parse(response);
                    return data;
                }
            )
            .then(
                data => {
                    if (data.length <= 0) return;
                    targetTags.forEach((element) => {
                        if(element.tagName === "A" && !["AUDIO", "VIDEO", "EMBED"].includes(element.parentNode.tagName)) {
                            data.forEach((el) => {
                                if(element.href && el.OWNLINK.length > 0 && element.href.endsWith(el.OWNLINK)) {
                                    doWrapper(element);
                                    let newLink = doElement(el.ID);
                                    element.after(newLink);
                                } else if(element.href && el.OUTLINK.length > 0 && element.href.endsWith(el.OUTLINK)) {
                                    doWrapper(element);
                                    let newLink = doElement(el.ID);
                                    element.after(newLink);
                                }
                            });
                        } else if((element.tagName === "VIDEO" && element.src.length > 0) 
                        || 
                        (element.tagName === "AUDIO" && element.src.length > 0) 
                        || 
                        (element.tagName === "EMBED" && element.src.length > 0) 
                        || 
                        (element.tagName === "IFRAME" && element.src.length > 0) 
                        || 
                        (element.tagName === "IMG" && element.src.length > 0)) {
                            data.forEach((el) => {
                                if(el.OWNLINK.length > 0 && element.src.endsWith(el.OWNLINK)) {
                                    doWrapper(element);
                                    let newLink = doElement(el.ID);
                                    element.after(newLink);
                                } else if(el.OUTLINK.length > 0 && element.src.endsWith(el.OUTLINK)) {
                                    doWrapper(element);
                                    let newLink = doElement(el.ID);
                                    element.after(newLink);
                                }
                            });
                        } else if((element.tagName === "VIDEO" && element.src.length == 0) 
                        || 
                        (element.tagName === "AUDIO" && element.src.length == 0)) {
                            element.childNodes.forEach((tag) => {
                                if(tag.tagName === "SOURCE" && tag.src.length > 0) {
                                    data.forEach((el) => {
                                        if(el.OWNLINK.length > 0 && tag.src.endsWith(el.OWNLINK)) {
                                            doWrapper(element);
                                            let newLink = doElement(el.ID);
                                            tag.parentElement.after(newLink);
                                        } else if(el.OUTLINK.length > 0 && tag.src.endsWith(el.OUTLINK)) {
                                            doWrapper(element);
                                            let newLink = doElement(el.ID);
                                            tag.parentElement.after(newLink);
                                        }
                                    });
                                }
                            })
                        } else if(element.tagName === "IFRAME" && element.src.length == 0 && element.srcdoc.length > 0) {
                            data.forEach((el) => {
                                if(el.OWNLINK.length > 0 && element.srcdoc.endsWith(el.OWNLINK)) {
                                    doWrapper(element);
                                    let newLink = doElement(el.ID);
                                    element.after(newLink);
                                } else if(el.OUTLINK.length > 0 && element.srcdoc.endsWith(el.OUTLINK)) {
                                    doWrapper(element);
                                    let newLink = doElement(el.ID);
                                    element.after(newLink);
                                }
                            });
                        } else if(element.tagName === "OBJECT" && element.data.length > 0) {
                            data.forEach((el) => {
                                if(el.OWNLINK.length > 0 && element.data.endsWith(el.OWNLINK)) {
                                    doWrapper(element);
                                    let newLink = doElement(el.ID);
                                    element.after(newLink);
                                } else if(el.OUTLINK.length > 0 && element.data.endsWith(el.OUTLINK)) {
                                    doWrapper(element);
                                    let newLink = doElement(el.ID);
                                    element.after(newLink);
                                }
                            });
                        }
                    });
                }
            )
    }
});