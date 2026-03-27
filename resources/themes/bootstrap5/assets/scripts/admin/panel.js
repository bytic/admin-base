import $ from 'jquery';
import { BaseComponent } from './base-component';
import { canUseTooltip, hasJqueryPlugin } from './shared';

// ── private handlers ─────────────────────────────────────────────────────────

function handlePanelAction() {
    function tooltipFor(el, title) {
        if (!$(el).attr('data-init') && canUseTooltip()) {
            $(el).tooltip({ title: title, placement: 'bottom', trigger: 'hover', container: 'body' });
            $(el).tooltip('show');
            $(el).attr('data-init', true);
        }
    }

    $(document).on('hover', '[data-click=panel-remove]', function () { tooltipFor(this, 'Remove'); });
    $(document).on('click', '[data-click=panel-remove]', function (e) {
        e.preventDefault();
        if (canUseTooltip()) $(this).tooltip('dispose');
        $(this).closest('.panel').remove();
    });

    $(document).on('hover', '[data-click=panel-collapse]', function () { tooltipFor(this, 'Collapse / Expand'); });
    $(document).on('click', '[data-click=panel-collapse]', function (e) {
        e.preventDefault();
        $(this).closest('.panel').find('.panel-body').slideToggle();
    });

    $(document).on('hover', '[data-click=panel-reload]', function () { tooltipFor(this, 'Reload'); });
    $(document).on('click', '[data-click=panel-reload]', function (e) {
        e.preventDefault();
        var target = $(this).closest('.panel');
        if (!$(target).hasClass('panel-loading')) {
            $(target).addClass('panel-loading').find('.panel-body').prepend('<div class="panel-loader"><span class="spinner-small"></span></div>');
            setTimeout(function () {
                $(target).removeClass('panel-loading').find('.panel-loader').remove();
            }, 2000);
        }
    });

    $(document).on('hover', '[data-click=panel-expand]', function () { tooltipFor(this, 'Expand / Compress'); });
    $(document).on('click', '[data-click=panel-expand]', function (e) {
        e.preventDefault();
        var target = $(this).closest('.panel');
        var targetBody = $(target).find('.panel-body');
        var targetTop = 40;

        if ($(targetBody).length) {
            targetTop = $(targetBody).offset().top - $(target).offset().top;
        }

        if ($('body').hasClass('panel-expand') && $(target).hasClass('panel-expand')) {
            $('body, .panel').removeClass('panel-expand');
            $('.panel').removeAttr('style');
            $(targetBody).removeAttr('style');
        } else {
            $('body').addClass('panel-expand');
            $(target).addClass('panel-expand');
            if ($(targetBody).length && targetTop !== 40) {
                var finalHeight = 40;
                $(target).find(' > *').each(function () {
                    var cls = $(this).attr('class');
                    if (cls !== 'panel-heading' && cls !== 'panel-body') finalHeight += $(this).height() + 30;
                });
                if (finalHeight !== 40) $(targetBody).css('top', finalHeight + 'px');
            }
        }
        $(window).trigger('resize');
    });
}

function savePanelPosition(element) {
    if (!$('.ui-sortable').length) return;
    var newValue = [];
    $.when(
        $('.ui-sortable').each(function () {
            var items = $(this).find('[data-sortable-id]');
            newValue.push(items.length ? items.map(function () { return { id: $(this).attr('data-sortable-id') }; }).get() : []);
        })
    ).done(function () {
        localStorage.setItem(window.location.href.split('?')[0], JSON.stringify(newValue));
        $(element).find('[data-id="title-spinner"]').delay(500).fadeOut(500, function () { $(this).remove(); });
    });
}

function handleDraggablePanel() {
    if (!hasJqueryPlugin('sortable')) return;
    var target = $('.panel:not([data-sortable="false"])').parent('[class*=col]');
    $(target).each(function () {
        if ($(this).data('ui-sortable')) $(this).sortable('destroy');
    });
    $(target).sortable({
        handle: '.panel-heading',
        connectWith: '.row > [class*=col]',
        stop: function (event, ui) {
            ui.item.find('.panel-title').append('<i class="fa fa-refresh fa-spin m-l-5" data-id="title-spinner"></i>');
            savePanelPosition(ui.item);
        },
    });
}

function handleLocalStorage() {
    try {
        if (typeof Storage === 'undefined') { alert('Your browser does not support local storage'); return; }
        var pageKey = window.location.href.split('?')[0];
        var raw = localStorage.getItem(pageKey);
        if (!raw) return;
        var data = JSON.parse(raw);
        var i = 0;
        $.when(
            $('.panel:not([data-sortable="false"])').parent('[class*="col-"]').each(function () {
                var col = $(this);
                var colData = data[i++];
                if (colData) {
                    $.each(colData, function (idx, item) {
                        var el = $('[data-sortable-id="' + item.id + '"]').not('[data-init="true"]');
                        if (el.length) {
                            col.append(el.clone());
                            el.remove();
                            $('[data-sortable-id="' + item.id + '"]').attr('data-init', 'true');
                        }
                    });
                }
            })
        ).done(function () {
            window.dispatchEvent(new CustomEvent('localstorage-position-loaded'));
        });
    } catch (err) {
        console.log(err);
    }
}

function handleResetLocalStorage() {
    $(document).on('click', '[data-click=reset-local-storage]', function (e) {
        e.preventDefault();
        var html =
            '<div class="modal fade" data-modal-id="reset-local-storage-confirmation">' +
            '  <div class="modal-dialog"><div class="modal-content">' +
            '    <div class="modal-header"><h4 class="modal-title"><i class="fa fa-redo m-r-5"></i> Reset Local Storage Confirmation</h4>' +
            '      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>' +
            '    <div class="modal-body"><div class="alert alert-info m-b-0">Would you like to RESET all saved widgets and clear Local Storage?</div></div>' +
            '    <div class="modal-footer">' +
            '      <a href="javascript:;" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i> No</a>' +
            '      <a href="javascript:;" class="btn btn-sm btn-inverse" data-click="confirm-reset-local-storage"><i class="fa fa-check"></i> Yes</a>' +
            '    </div>' +
            '  </div></div>' +
            '</div>';
        $('body').append(html);
        $('[data-modal-id="reset-local-storage-confirmation"]').modal('show');
    });
    $(document).on('hidden.bs.modal', '[data-modal-id="reset-local-storage-confirmation"]', function () {
        $(this).remove();
    });
    $(document).on('click', '[data-click=confirm-reset-local-storage]', function (e) {
        e.preventDefault();
        localStorage.removeItem(window.location.href.split('?')[0]);
        location.reload();
    });
}

// ── Component ─────────────────────────────────────────────────────────────────

export class PanelComponent extends BaseComponent {
    constructor() {
        super();
        this._panelActionBound = false;
    }

    /**
     * Register document-level event handlers once.
     * Panel actions use event delegation so they only need one binding.
     */
    onSetup(/* app */) {
        if (!this._panelActionBound) {
            handlePanelAction();
            handleResetLocalStorage();
            this._panelActionBound = true;
        }
    }

    /**
     * Re-run per-navigation DOM tasks: restore localStorage panel positions
     * and (re)initialise jQuery UI sortable on new panels.
     */
    onInit(app) {
        if (!app.setting || !app.setting.disableLocalStorage) {
            handleLocalStorage();
        }
        if (!app.setting || !app.setting.disableDraggablePanel) {
            handleDraggablePanel();
        }
    }

    onBeforeCache(/* app */) {
        $('body').removeClass('panel-expand');
        $('.panel').removeClass('panel-expand').removeAttr('style');
        $('.panel-body').removeAttr('style');
    }
}
