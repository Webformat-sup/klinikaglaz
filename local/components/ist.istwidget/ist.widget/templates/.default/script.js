// кодировка cp-1251

window.addEventListener("DOMContentLoaded", function() {
  [].forEach.call( document.querySelectorAll('.ist_phonemask'), function(input) {
    var keyCode;
    function mask(event) {
      event.keyCode && (keyCode = event.keyCode);
      var pos = this.selectionStart;
      if (pos < 3) event.preventDefault();
      var matrix = "+7 (___) ___-__-__",
          i = 0,
          def = matrix.replace(/\D/g, ""),
          val = this.value.replace(/\D/g, ""),
          new_value = matrix.replace(/[_\d]/g, function(a) {
              return i < val.length ? val.charAt(i++) : a
          });
      i = new_value.indexOf("_");
      if (i != -1) {
          i < 5 && (i = 3);
          new_value = new_value.slice(0, i)
      }
      var reg = matrix.substr(0, this.value.length).replace(/_+/g,
          function(a) {
              return "\\d{1," + a.length + "}"
          }).replace(/[+()]/g, "\\$&");
      reg = new RegExp("^" + reg + "$");
      if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) {
        this.value = new_value;
      }
      if (event.type == "blur" && this.value.length < 5) {
        this.value = "";
      }
    }

    input.addEventListener("input", mask, false);
    input.addEventListener("focus", mask, false);
    input.addEventListener("blur", mask, false);
    input.addEventListener("keydown", mask, false);

  });

});

$(document).ready(function(){
	$('.iquiz__variant__content').on('click', function(){
		$('.iquiz__step').hide();
		$(this).closest('.iquiz__step').next().fadeIn();
		$ths_parent = $(this).closest('.iquiz');
		$ths_val = $(this).attr('data-iquiz-val');
		$ths_id = $(this).attr('data-iquiz-id');
		if($ths_parent.find('.istform__val[name="'+$ths_id+'"]').length>0){
			$ths_parent.find('.istform__val[name="'+$ths_id+'"]').val($ths_val);
		}
	})

	$('[data-iquiz-model]').on('click', function(){
		$ths_text = $(this).text();
		$('.iquiz__form [name="model"]').val($ths_text);
	})
	$('[data-iquiz-buy]').on('click', function(){
		$ths_text = $(this).text();
		$('.iquiz__form [name="buy"]').val($ths_text);
	})
	$('[data-iquiz-tradein]').on('click', function(){
		$ths_text = $(this).text();
		$('.iquiz__form [name="tradein"]').val($ths_text);
	})
	
	$('.istform__send').on('click', function(){
		console.log('=========== start ===========');
		
		var ths_form = $(this).parents('form');
		
		ths_form.find('.invalid').removeClass('invalid');
		ths_form.find('.istform__error').hide();
		var res = [];
		var error = 0;
		
		var formtitle = ths_form.find('input[name="formname"]').val();
		res.push({val:formtitle, index:'formtitle', title:ths_form.find('input[name="formname"]').data('send-title')});
		
		var saveus = ths_form.find('input[name="saveus"]').val();
		res.push({val:saveus, index:'saveus'});
		
		
		ths_form.find('.istform__val').each(function(){
			var ths_input = $(this);
			if(ths_input.hasClass('policy__checkbox') && ths_input.is(':checked')===false){
				error = 1;
				ths_input.addClass('invalid');
				ths_input.next().next('.istform__error').fadeIn();
			}else if(ths_input.hasClass('req') && ths_input.val()==''){
				ths_input.addClass('invalid');
				ths_input.prev('.istform__label').addClass('invalid');
				ths_input.next('.istform__error').fadeIn();
				error = 1;
			}else{
				ths_input.removeClass('invalid');
			}
			if(ths_input.attr('name')=='email'){
				var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
				if(pattern.test(ths_input.val())){
					//ok
				} else {
					ths_input.addClass('invalid');
					ths_input.next('.istform__error').fadeIn();
					error = 1;
				}
			}
		})
		
		
		if(error==1){
			return false;
		}
		
		var form_data = '';
		ths_form.find('.istform__val').each(function(){
			var ths_input = $(this);
			if(ths_input.val()!='on'){
				var ths_input_name = ths_input.attr('name');
				var ths_input_title = ths_input.data('send-title');
				if(ths_input.attr('type')=='radio'){
					if(ths_input.is(':checked')){
						var ths_input_val = ths_input.val();
					}else{
						var ths_input_val = '';
					}
				}else{
					var ths_input_val = ths_input.val();
				}
				if(ths_input_val!=''){
					res.push({val:ths_input_val, index:ths_input_name, title:ths_input_title});
				}
			}
		})
		form_data = res;
		
		var formData = new FormData();
		
		
		
		if(ths_form.find("input[type='file']").lenght>0){
			$.each(ths_form.find("input[type='file']")[0].files, function(i, file) {
				formData.append('file[]', file);
				console.log(file);
			});
		}
		
		//return false;
		
		formData.append('other_data',JSON.stringify(form_data));
					
		$.ajax({
			type: "POST",
			crossDomain : true,
			url: "/local/ist_ajax/ist_widget_send.php",
			data: formData,
			processData: false,
			contentType: false,
			success: function(result){
				console.log(result);
				$('.istform__val').each(function(){
					if($(this).attr('type')!='radio'){
						$(this).val('');
					}
				})
				ths_form.find('.istform__body').hide();
				ths_form.find('.istform__result').stop().fadeIn();
				setTimeout(function(){
					Fancybox.getInstance().close();
				}, 3000);
			},
			fail: function() {
				console.log("fail");
			}
		});
		
		console.log('=========== end ===========');
		return false;
	})
})
