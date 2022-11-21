(function($) {
    "use strict";
    $(document).ready(function() {
        "use strict";
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        });
        $('.scrollup').click(function() {
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
    });

    $(document).ready(function() {
        $('select').niceSelect();
    });

    // $('.textarea').wysihtml5();

    $('.extra-field-box').each(function() {
        var $wrapp = $('.multi-box', this);
        $(".add-field", $(this)).on('click', function() {
            $('.dublicat-box:first-child', $wrapp).clone(true).appendTo($wrapp).find('input').val('').focus();
        });
        $('.dublicat-box .remove-field', $wrapp).on('click', function() {
            if ($('.dublicat-box', $wrapp).length > 1)
                $(this).parent('.dublicat-box').remove();
        });
    });

})(jQuery);