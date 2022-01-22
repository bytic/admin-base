!function ($) {
    $('a.jsConfirm').click(function (event) {
        event.preventDefault();
        if (confirm($(this).data('message'))) {
            window.location.href = $(this).data('href');
        }
    });
}(window.jQuery);