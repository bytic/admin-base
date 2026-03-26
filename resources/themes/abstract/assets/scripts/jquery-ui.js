import $ from 'jquery';
import 'jquery-ui/ui/widget';
import 'jquery-ui/ui/widgets/menu';
import 'jquery-ui/ui/widgets/sortable';
import 'jquery-ui/ui/widgets/datepicker';
import 'jquery-ui/ui/widgets/autocomplete';

const autocompleteWidget = $.ui && $.ui.autocomplete;

// Register only when jQuery UI autocomplete is available to avoid hard runtime crashes.
if (autocompleteWidget) {
    $.widget('custom.catcomplete', autocompleteWidget, {
        _create: function () {
            this._super();
            this.widget().menu('option', 'items', '> :not(.ui-autocomplete-category)');
        },
        _renderMenu: function (ul, items) {
            var that = this,
                currentCategory = '';
            $.each(items, function (index, item) {
                var li;
                if (item.category != currentCategory) {
                    ul.append("<li class='ui-autocomplete-category' style='border-bottom:1px solid #cacaca'><strong>" + item.category + '</strong></li>');
                    currentCategory = item.category;
                }
                li = that._renderItemData(ul, item);
                if (item.category) {
                    li.attr('aria-label', item.category + ' : ' + item.label);
                }
            });
        }
    });
}
