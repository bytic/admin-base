import $ from 'jquery';
import { BaseComponent } from './base-component';

const FIELD_SELECTOR = '[data-autocomplete-create-field="true"]';

function toInt(value, fallback) {
    var parsed = parseInt(value, 10);
    return Number.isNaN(parsed) ? fallback : parsed;
}

function toBool(value) {
    return value === true || value === 'true' || value === 1 || value === '1';
}

function getConfig($field) {
    var dataset = $field.data();

    return {
        searchUrl: dataset.searchUrl || '',
        searchMethod: (dataset.searchMethod || 'GET').toUpperCase(),
        createUrl: dataset.createUrl || '',
        createMethod: (dataset.createMethod || 'POST').toUpperCase(),
        queryParam: dataset.queryParam || 'q',
        limitParam: dataset.limitParam || 'limit',
        nameParam: dataset.nameParam || 'name',
        minChars: toInt(dataset.minChars, 2),
        limit: toInt(dataset.limit, 10),
        messageEmpty: dataset.messageEmpty || 'No matches found',
        messageCreate: dataset.messageCreate || 'Create',
        messageLoading: dataset.messageLoading || 'Loading',
        messageError: dataset.messageError || 'Something went wrong',
        readonly: toBool(dataset.readonly),
        disabled: toBool(dataset.disabled),
    };
}

function getState($field) {
    var state = $field.data('btcAutocompleteCreateState');
    if (!state) {
        state = {
            debounceTimer: null,
            activeXhr: null,
            activeIndex: -1,
            items: [],
        };
        $field.data('btcAutocompleteCreateState', state);
    }
    return state;
}

function getElements($field) {
    return {
        input: $field.find('.btc-autocomplete-create-input'),
        idInput: $field.find('.btc-autocomplete-create-id'),
        resetBtn: $field.find('.btc-autocomplete-create-reset'),
        menu: $field.find('.btc-autocomplete-create-menu'),
        feedback: $field.find('.btc-autocomplete-create-feedback'),
    };
}

function clearFeedback($elements) {
    $elements.feedback.text('').addClass('d-none');
}

function showFeedback($elements, message) {
    $elements.feedback.text(message).removeClass('d-none');
}

function openMenu($elements) {
    $elements.menu.addClass('show');
}

function closeMenu($elements) {
    $elements.menu.removeClass('show').empty();
}

function normalizeItems(response) {
    if (!response || response.success !== true || !Array.isArray(response.data)) {
        return [];
    }

    return response.data
        .map(function (item) {
            if (!item) {
                return null;
            }
            return {
                id: item.id,
                label: item.label || item.name || item.title || '',
            };
        })
        .filter(function (item) {
            return item && item.label !== '';
        });
}

function setSelected($field, selectedId, selectedLabel) {
    var $elements = getElements($field);

    $elements.idInput.val(selectedId || '');
    $elements.input.val(selectedLabel || '');
    $elements.resetBtn.toggleClass('d-none', !(selectedLabel || selectedId));

    clearFeedback($elements);
    closeMenu($elements);
}

function setLoading($field, loading) {
    var $elements = getElements($field);
    $field.toggleClass('is-loading', loading);
    $elements.input.attr('aria-busy', loading ? 'true' : 'false');
}

function renderMenu($field, items, query) {
    var config = getConfig($field);
    var state = getState($field);
    var $elements = getElements($field);

    state.items = items;
    state.activeIndex = -1;

    if (items.length > 0) {
        var rows = items.map(function (item, index) {
            return (
                '<button type="button" class="dropdown-item btc-autocomplete-create-option" ' +
                'data-index="' + index + '" data-id="' + String(item.id) + '">' +
                $('<div/>').text(item.label).html() +
                '</button>'
            );
        });
        $elements.menu.html(rows.join(''));
        openMenu($elements);
        return;
    }

    var html = '<span class="dropdown-item-text text-muted">' + $('<div/>').text(config.messageEmpty).html() + '</span>';
    if (config.createUrl) {
        html += (
            '<button type="button" class="dropdown-item btc-autocomplete-create-new" data-name="' + $('<div/>').text(query).html() + '">' +
            '<i class="fa fa-plus me-1"></i>' + $('<div/>').text(config.messageCreate + ' "' + query + '"').html() +
            '</button>'
        );
    }
    $elements.menu.html(html);
    openMenu($elements);
}

function searchRecords($field, query) {
    var config = getConfig($field);
    var state = getState($field);
    var $elements = getElements($field);

    if (!config.searchUrl) {
        showFeedback($elements, config.messageError);
        return;
    }

    if (state.activeXhr && typeof state.activeXhr.abort === 'function') {
        state.activeXhr.abort();
    }

    setLoading($field, true);
    clearFeedback($elements);

    var data = {};
    data[config.queryParam] = query;
    data[config.limitParam] = config.limit;

    state.activeXhr = $.ajax({
        url: config.searchUrl,
        type: config.searchMethod,
        dataType: 'json',
        data: data,
    })
        .done(function (response) {
            var items = normalizeItems(response);
            renderMenu($field, items, query);
        })
        .fail(function () {
            showFeedback($elements, config.messageError);
            closeMenu($elements);
        })
        .always(function () {
            state.activeXhr = null;
            setLoading($field, false);
        });
}

function createRecord($field, name) {
    var config = getConfig($field);
    var state = getState($field);
    var $elements = getElements($field);

    if (!config.createUrl) {
        return;
    }

    if (state.activeXhr && typeof state.activeXhr.abort === 'function') {
        state.activeXhr.abort();
    }

    setLoading($field, true);
    clearFeedback($elements);

    var data = {};
    data[config.nameParam] = name;

    state.activeXhr = $.ajax({
        url: config.createUrl,
        type: config.createMethod,
        dataType: 'json',
        data: data,
    })
        .done(function (response) {
            if (!response || response.success !== true || !response.data) {
                showFeedback($elements, config.messageError);
                return;
            }

            var item = {
                id: response.data.id,
                label: response.data.label || name,
            };
            setSelected($field, item.id, item.label);
        })
        .fail(function (xhr) {
            var message = config.messageError;
            if (xhr && xhr.responseJSON && xhr.responseJSON.error && xhr.responseJSON.error.message) {
                message = xhr.responseJSON.error.message;
            }
            showFeedback($elements, message);
        })
        .always(function () {
            state.activeXhr = null;
            setLoading($field, false);
        });
}

function highlightOption($field, nextIndex) {
    var state = getState($field);
    var $elements = getElements($field);
    var $options = $elements.menu.find('.btc-autocomplete-create-option');

    if ($options.length === 0) {
        return;
    }

    if (nextIndex < 0) {
        nextIndex = $options.length - 1;
    }
    if (nextIndex >= $options.length) {
        nextIndex = 0;
    }

    state.activeIndex = nextIndex;
    $options.removeClass('active');
    $options.eq(nextIndex).addClass('active');
}

export class AutocompleteCreateComponent extends BaseComponent {
    constructor() {
        super();
        this._mounted = false;
    }

    onSetup(/* app */) {
        if (this._mounted) {
            return;
        }

        this._bindHandlers();
        this._mounted = true;
    }

    onInit(/* app */) {
        $(FIELD_SELECTOR).each(function () {
            var $field = $(this);
            var $elements = getElements($field);
            $elements.resetBtn.toggleClass('d-none', !$elements.input.val() && !$elements.idInput.val());
        });
    }

    onBeforeCache(/* app */) {
        $(FIELD_SELECTOR).each(function () {
            var $field = $(this);
            var state = getState($field);
            var $elements = getElements($field);

            if (state.debounceTimer) {
                clearTimeout(state.debounceTimer);
                state.debounceTimer = null;
            }
            if (state.activeXhr && typeof state.activeXhr.abort === 'function') {
                state.activeXhr.abort();
            }

            closeMenu($elements);
            clearFeedback($elements);
            setLoading($field, false);
        });
    }

    _bindHandlers() {
        var self = this;

        $(document)
            .off('input.colorAdminAutocompleteCreate', FIELD_SELECTOR + ' .btc-autocomplete-create-input')
            .on('input.colorAdminAutocompleteCreate', FIELD_SELECTOR + ' .btc-autocomplete-create-input', function () {
                var $input = $(this);
                var $field = $input.closest(FIELD_SELECTOR);
                var config = getConfig($field);
                var state = getState($field);
                var $elements = getElements($field);
                var query = ($input.val() || '').toString().trim();

                if (config.readonly || config.disabled) {
                    return;
                }

                $elements.idInput.val('');
                $elements.resetBtn.toggleClass('d-none', query.length < 1);

                if (state.debounceTimer) {
                    clearTimeout(state.debounceTimer);
                }

                if (query.length < config.minChars) {
                    closeMenu($elements);
                    clearFeedback($elements);
                    return;
                }

                state.debounceTimer = setTimeout(function () {
                    searchRecords($field, query);
                }, 250);
            });

        $(document)
            .off('keydown.colorAdminAutocompleteCreate', FIELD_SELECTOR + ' .btc-autocomplete-create-input')
            .on('keydown.colorAdminAutocompleteCreate', FIELD_SELECTOR + ' .btc-autocomplete-create-input', function (event) {
                var $field = $(this).closest(FIELD_SELECTOR);
                var state = getState($field);
                var $elements = getElements($field);

                if (!$elements.menu.hasClass('show')) {
                    return;
                }

                if (event.key === 'ArrowDown') {
                    event.preventDefault();
                    highlightOption($field, state.activeIndex + 1);
                    return;
                }
                if (event.key === 'ArrowUp') {
                    event.preventDefault();
                    highlightOption($field, state.activeIndex - 1);
                    return;
                }
                if (event.key === 'Enter' && state.activeIndex > -1) {
                    event.preventDefault();
                    $elements.menu.find('.btc-autocomplete-create-option').eq(state.activeIndex).trigger('click');
                    return;
                }
                if (event.key === 'Escape') {
                    closeMenu($elements);
                }
            });

        $(document)
            .off('click.colorAdminAutocompleteCreate', FIELD_SELECTOR + ' .btc-autocomplete-create-option')
            .on('click.colorAdminAutocompleteCreate', FIELD_SELECTOR + ' .btc-autocomplete-create-option', function () {
                var $option = $(this);
                var $field = $option.closest(FIELD_SELECTOR);
                var index = toInt($option.data('index'), -1);
                var state = getState($field);
                var item = state.items[index];

                if (!item) {
                    return;
                }

                setSelected($field, item.id, item.label);
            });

        $(document)
            .off('click.colorAdminAutocompleteCreate', FIELD_SELECTOR + ' .btc-autocomplete-create-new')
            .on('click.colorAdminAutocompleteCreate', FIELD_SELECTOR + ' .btc-autocomplete-create-new', function () {
                var $action = $(this);
                var $field = $action.closest(FIELD_SELECTOR);
                var $elements = getElements($field);
                var name = ($action.data('name') || $elements.input.val() || '').toString().trim();
                if (!name) {
                    return;
                }
                createRecord($field, name);
            });

        $(document)
            .off('click.colorAdminAutocompleteCreate', FIELD_SELECTOR + ' .btc-autocomplete-create-reset')
            .on('click.colorAdminAutocompleteCreate', FIELD_SELECTOR + ' .btc-autocomplete-create-reset', function () {
                var $field = $(this).closest(FIELD_SELECTOR);
                setSelected($field, '', '');
            });

        $(document)
            .off('click.colorAdminAutocompleteCreateOutside')
            .on('click.colorAdminAutocompleteCreateOutside', function (event) {
                $(FIELD_SELECTOR).each(function () {
                    var $field = $(this);
                    var $elements = getElements($field);
                    if (!$(event.target).closest($field).length) {
                        closeMenu($elements);
                    }
                });
            });

        $(document)
            .off('blur.colorAdminAutocompleteCreate', FIELD_SELECTOR + ' .btc-autocomplete-create-input')
            .on('blur.colorAdminAutocompleteCreate', FIELD_SELECTOR + ' .btc-autocomplete-create-input', function () {
                var $field = $(this).closest(FIELD_SELECTOR);
                window.setTimeout(function () {
                    closeMenu(getElements($field));
                }, 200);
            });
    }
}

export default AutocompleteCreateComponent;
