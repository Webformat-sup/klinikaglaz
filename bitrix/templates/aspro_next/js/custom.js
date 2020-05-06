/*
You can use this file with your scripts.
It will not be overwritten when you upgrade solution.
*/


$(document).ready(function () {
    var ckbox = $('#checkbox');
        if (ckbox.is(':checked')) {
            $(".bx_filter_block .limited_block").css({'display':'block' });
        }
});