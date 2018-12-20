/* 
=========== Dialog =========== 
*/

(function($) {

"use strict";

// Version = 1.0

$.fn.dialog = function(options) {

    var settings = $.extend ({
        overlay: true,
        classes: "show",
        width: "auto",
        height: "auto"
    });

    return this.each(function() {

        var that = $(this);
        var target = that.data("target");
        var overlay = $('<div class="overlay"></div>');
        
        that.click(function() {
            var targeted = $('#' + target);
            
            openDialog(targeted);

            closeDialog(targeted);

            if(settings.overlay == true) {
                options(targeted);
            }

        });

        function openDialog(param) {
            param.addClass(settings.classes);

            if(settings.overlay == true) {
                createElement();
            }
        }

        function closeDialog(param) {
            var btnClose = param.find('[data-close]');
            btnClose.click(function() {
                param.removeClass(settings.classes);

                if(settings.overlay == true) {
                    overlay.remove();
                }
            });
        }

        function createElement() {
            $('body').prepend(overlay);
        }

        function options(param) {
            overlay.click(function() {
                param.removeClass(settings.classes);
                $(this).remove();
            });
        }

    });

}

$('[data-role="dialog"]').dialog();

})(jQuery);