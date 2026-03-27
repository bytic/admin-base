import $ from 'jquery';
import { canUseTooltip, hasJqueryPlugin } from './shared';

var panelActionRunning = false;

export function handlePanelAction() {
    if (panelActionRunning) {
        return false;
    }
    panelActionRunning = true;

    $(document).on('hover', '[data-click=panel-remove]', function () {
        if (!$(this).attr('data-init') && canUseTooltip()) {
            $(this).tooltip({
                title: 'Remove',
                placement: 'bottom',
                trigger: 'hover',
                container: 'body',
            });
            $(this).tooltip('show');
            $(this).attr('data-init', true);
        }
    });

    $(document).on('click', '[data-click=panel-remove]', function (e) {
        e.preventDefault();
        if (canUseTooltip()) {
            $(this).tooltip('dispose');
        }
        $(this).closest('.panel').remove();
    });

    $(document).on('hover', '[data-click=panel-collapse]', function () {
        if (!$(this).attr('data-init') && canUseTooltip()) {
            $(this).tooltip({
                title: 'Collapse / Expand',
                placement: 'bottom',
                trigger: 'hover',
                container: 'body',
            });
            $(this).tooltip('show');
            $(this).attr('data-init', true);
        }
    });

    $(document).on('click', '[data-click=panel-collapse]', function (e) {
        e.preventDefault();
        $(this).closest('.panel').find('.panel-body').slideToggle();
    });

    $(document).on('hover', '[data-click=panel-reload]', function () {
        if (!$(this).attr('data-init') && canUseTooltip()) {
            $(this).tooltip({
                title: 'Reload',
                placement: 'bottom',
                trigger: 'hover',
                container: 'body',
            });
            $(this).tooltip('show');
            $(this).attr('data-init', true);
        }
    });

    $(document).on('click', '[data-click=panel-reload]', function (e) {
        e.preventDefault();
        var target = $(this).closest('.panel');

        if (!$(target).hasClass('panel-loading')) {
            var targetBody = $(target).find('.panel-body');
            var spinnerHtml = '<div class="panel-loader"><span class="spinner-small"></span></div>';
            $(target).addClass('panel-loading');
            $(targetBody).prepend(spinnerHtml);
            setTimeout(function () {
                $(target).removeClass('panel-loading');
                $(target).find('.panel-loader').remove();
            }, 2000);
        }
    });

    $(document).on('hover', '[data-click=panel-expand]', function () {
        if (!$(this).attr('data-init') && canUseTooltip()) {
            $(this).tooltip({
                title: 'Expand / Compress',
                placement: 'bottom',
                trigger: 'hover',
                container: 'body',
            });
            $(this).tooltip('show');
            $(this).attr('data-init', true);
        }
    });

    $(document).on('click', '[data-click=panel-expand]', function (e) {
        e.preventDefault();
        var target = $(this).closest('.panel');
        var targetBody = $(target).find('.panel-body');
        var targetTop = 40;

        if ($(targetBody).length !== 0) {
            var targetOffsetTop = $(target).offset().top;
            var targetBodyOffsetTop = $(targetBody).offset().top;
            targetTop = targetBodyOffsetTop - targetOffsetTop;
        }

        if ($('body').hasClass('panel-expand') && $(target).hasClass('panel-expand')) {
            $('body, .panel').removeClass('panel-expand');
            $('.panel').removeAttr('style');
            $(targetBody).removeAttr('style');
        } else {
            $('body').addClass('panel-expand');
            $(target).addClass('panel-expand');

            if ($(targetBody).length !== 0 && targetTop !== 40) {
                var finalHeight = 40;
                $(target)
                    .find(' > *')
                    .each(function () {
                        var targetClass = $(this).attr('class');
                        if (targetClass !== 'panel-heading' && targetClass !== 'panel-body') {
                            finalHeight += $(this).height() + 30;
                        }
                    });

                if (finalHeight !== 40) {
                    $(targetBody).css('top', finalHeight + 'px');
                }
            }
        }

        $(window).trigger('resize');
    });

    return true;
}

export function handleSavePanelPosition(element) {
    if ($('.ui-sortable').length === 0) {
        return;
    }

    var newValue = [];

    $.when(
        $('.ui-sortable').each(function () {
            var panelSortableElement = $(this).find('[data-sortable-id]');
            if (panelSortableElement.length !== 0) {
                var columnValue = [];
                $(panelSortableElement).each(function () {
                    var targetSortId = $(this).attr('data-sortable-id');
                    columnValue.push({ id: targetSortId });
                });
                newValue.push(columnValue);
            } else {
                newValue.push([]);
            }
        })
    ).done(function () {
        var targetPage = window.location.href.split('?')[0];
        localStorage.setItem(targetPage, JSON.stringify(newValue));
        $(element)
            .find('[data-id="title-spinner"]')
            .delay(500)
            .fadeOut(500, function () {
                $(this).remove();
            });
    });
}

export function handleDraggablePanel() {
    if (!hasJqueryPlugin('sortable')) {
        return;
    }

    var target = $('.panel:not([data-sortable="false"])').parent('[class*=col]');
    var targetHandle = '.panel-heading';
    var connectedTarget = '.row > [class*=col]';

    $(target).each(function () {
        if ($(this).data('ui-sortable')) {
            $(this).sortable('destroy');
        }
    });

    $(target).sortable({
        handle: targetHandle,
        connectWith: connectedTarget,
        stop: function (event, ui) {
            ui.item.find('.panel-title').append('<i class="fa fa-refresh fa-spin m-l-5" data-id="title-spinner"></i>');
            handleSavePanelPosition(ui.item);
        },
    });
}

export function handleLocalStorage() {
    try {
        if (typeof Storage === 'undefined' || typeof localStorage === 'undefined') {
            alert('Your browser is not supported with the local storage');
            return;
        }

        var targetPage = window.location.href.split('?')[0];
        var panelPositionData = localStorage.getItem(targetPage);

        if (!panelPositionData) {
            return;
        }

        panelPositionData = JSON.parse(panelPositionData);
        var i = 0;

        $.when(
            $('.panel:not([data-sortable="false"])')
                .parent('[class*="col-"]')
                .each(function () {
                    var storageData = panelPositionData[i];
                    var targetColumn = $(this);
                    if (storageData) {
                        $.each(storageData, function (index, data) {
                            var targetId = $('[data-sortable-id="' + data.id + '"]').not('[data-init="true"]');
                            if ($(targetId).length !== 0) {
                                var targetHtml = $(targetId).clone();
                                $(targetId).remove();
                                $(targetColumn).append(targetHtml);
                                $('[data-sortable-id="' + data.id + '"]').attr('data-init', 'true');
                            }
                        });
                    }
                    i++;
                })
        ).done(function () {
            window.dispatchEvent(new CustomEvent('localstorage-position-loaded'));
        });
    } catch (error) {
        console.log(error);
    }
}

export function handleResetLocalStorage() {
    $(document).on('click', '[data-click=reset-local-storage]', function (e) {
        e.preventDefault();

        var targetModalHtml =
            '' +
            '<div class="modal fade" data-modal-id="reset-local-storage-confirmation">' +
            '    <div class="modal-dialog">' +
            '        <div class="modal-content">' +
            '            <div class="modal-header">' +
            '                <h4 class="modal-title"><i class="fa fa-redo m-r-5"></i> Reset Local Storage Confirmation</h4>' +
            '                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>' +
            '            </div>' +
            '            <div class="modal-body">' +
            '                <div class="alert alert-info m-b-0">Would you like to RESET all your saved widgets and clear Local Storage?</div>' +
            '            </div>' +
            '            <div class="modal-footer">' +
            '                <a href="javascript:;" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i> No</a>' +
            '                <a href="javascript:;" class="btn btn-sm btn-inverse" data-click="confirm-reset-local-storage"><i class="fa fa-check"></i> Yes</a>' +
            '            </div>' +
            '        </div>' +
            '    </div>' +
            '</div>';

        $('body').append(targetModalHtml);
        $('[data-modal-id="reset-local-storage-confirmation"]').modal('show');
    });

    $(document).on('hidden.bs.modal', '[data-modal-id="reset-local-storage-confirmation"]', function () {
        $('[data-modal-id="reset-local-storage-confirmation"]').remove();
    });

    $(document).on('click', '[data-click=confirm-reset-local-storage]', function (e) {
        e.preventDefault();
        var localStorageName = window.location.href.split('?')[0];
        localStorage.removeItem(localStorageName);
        location.reload();
    });
}

