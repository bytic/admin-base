!function ($) {
    $('a.jsConfirm').click(function (event) {
        event.preventDefault();
        if (confirm($(this).data('message'))) {
            window.location.href = $(this).data('href');
        }
    });

    $('.dropdown-menu .form-control').keyup(function () {
        const container = $(this).closest('.dropdown-menu');
        const noResults = container.find('.searchable-no-results');
        const items = container.find('.menu-item');
        const filterValue = $(this).val();

        noResults.hide();

        if (filterValue.length < 1) {
            items.show();
            return;
        }

        items.each(function (key, item) {
            const itemText = $(item).text().toLowerCase();
            if (itemText.indexOf(filterValue.toLowerCase()) >= 0) {
                $(item).show();
            } else {
                $(item).hide();
            }
        });
    });
}(window.jQuery);
