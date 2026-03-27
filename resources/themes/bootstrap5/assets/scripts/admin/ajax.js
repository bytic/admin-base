import $ from 'jquery';

var clearOption = '';

export function handleAjaxMode(setting, appApi) {
    var emptyHtml = setting.emptyHtml
        ? setting.emptyHtml
        : '<div class="p-t-40 p-b-40 text-center f-s-20 content"><i class="fa fa-warning fa-lg text-muted m-r-5"></i> <span class="f-w-600 text-inverse">Error 404! Page not found.</span></div>';
    var defaultUrl = setting.ajaxDefaultUrl ? setting.ajaxDefaultUrl : '';
    defaultUrl = window.location.hash ? window.location.hash : defaultUrl;

    if (defaultUrl === '') {
        $('#content').html(emptyHtml);
    } else {
        renderAjax(defaultUrl, '', true);
    }

    function clearElement() {
        $('.jvectormap-label, .jvector-label, .AutoFill_border ,#gritter-notice-wrapper, .ui-autocomplete, .colorpicker, .FixedHeader_Header, .FixedHeader_Cloned .lightboxOverlay, .lightbox, .introjs-hints, .nvtooltip').remove();
        if ($.fn.DataTable) {
            $('.dataTable').DataTable().destroy();
        }
        if ($('#page-container').hasClass('page-sidebar-toggled')) {
            $('#page-container').removeClass('page-sidebar-toggled');
        }
    }

    function checkSidebarActive(url) {
        var targetElm = '#sidebar [data-toggle="ajax"][href="' + url + '"]';
        if ($(targetElm).length !== 0) {
            $('#sidebar li').removeClass('active');
            $(targetElm).closest('li').addClass('active');
            $(targetElm).parents().addClass('active');
        }
    }

    function checkPushState(url) {
        var targetUrl = url.replace('#', '');
        var targetUserAgent = window.navigator.userAgent;
        var isIE = targetUserAgent.indexOf('MSIE ');

        if (isIE && isIE > 0 && isIE < 9) {
            window.location.href = targetUrl;
        } else {
            history.pushState('', '', '#' + targetUrl);
        }
    }

    function checkClearOption() {
        if (clearOption) {
            appApi.clearPageOption(clearOption);
            clearOption = '';
        }
    }

    function checkLoading(load) {
        if (!load) {
            if ($('#page-content-loader').length === 0) {
                $('body').addClass('page-content-loading');
                $('#content').append('<div id="page-content-loader"><span class="spinner"></span></div>');
            }
            return;
        }

        $('#page-content-loader').remove();
        $('body').removeClass('page-content-loading');
    }

    function renderAjax(url, elm, disablePushState) {
        if (typeof window.Pace !== 'undefined' && typeof window.Pace.restart === 'function') {
            window.Pace.restart();
        }

        checkLoading(false);
        clearElement();
        checkSidebarActive(url);
        checkClearOption();
        if (!disablePushState) {
            checkPushState(url);
        }

        var targetContainer = '#content';
        var targetUrl = url.replace('#', '');
        var targetType = setting.ajaxType ? setting.ajaxType : 'GET';
        var targetDataType = setting.ajaxDataType ? setting.ajaxDataType : 'html';

        if (elm) {
            targetDataType = $(elm).attr('data-type') ? $(elm).attr('data-type') : targetDataType;
        }

        $.ajax({
            url: targetUrl,
            type: targetType,
            dataType: targetDataType,
            success: function (data) {
                $(targetContainer).html(data);
            },
            error: function () {
                $(targetContainer).html(emptyHtml);
            },
        }).done(function () {
            checkLoading(true);
            $('html, body').animate({ scrollTop: 0 }, 0);
            appApi.initComponent();
        });
    }

    $(window)
        .off('hashchange.colorAdminAjax')
        .on('hashchange.colorAdminAjax', function () {
            if (window.location.hash) {
                renderAjax(window.location.hash, '', true);
            }
        });

    $(document)
        .off('click.colorAdminAjax', '[data-toggle="ajax"]')
        .on('click.colorAdminAjax', '[data-toggle="ajax"]', function (e) {
            e.preventDefault();
            renderAjax($(this).attr('href'), this);
        });
}

export function handleSetPageOption(option) {
    if (option.pageContentFullHeight) {
        $('#page-container').addClass('page-content-full-height');
    }
    if (option.pageSidebarLight) {
        $('#page-container').addClass('page-with-light-sidebar');
    }
    if (option.pageSidebarRight) {
        $('#page-container').addClass('page-with-right-sidebar');
    }
    if (option.pageSidebarWide) {
        $('#page-container').addClass('page-with-wide-sidebar');
    }
    if (option.pageSidebarMinified) {
        $('#page-container').addClass('page-sidebar-minified');
    }
    if (option.pageSidebarTransparent) {
        $('#sidebar').addClass('sidebar-transparent');
    }
    if (option.pageContentFullWidth) {
        $('#content').addClass('content-full-width');
    }
    if (option.pageContentInverseMode) {
        $('#content').addClass('content-inverse-mode');
    }
    if (option.pageBoxedLayout) {
        $('body').addClass('boxed-layout');
    }
    if (option.clearOptionOnLeave) {
        clearOption = option;
    }
}

export function handleClearPageOption(option) {
    if (option.pageContentFullHeight) {
        $('#page-container').removeClass('page-content-full-height');
    }
    if (option.pageSidebarLight) {
        $('#page-container').removeClass('page-with-light-sidebar');
    }
    if (option.pageSidebarRight) {
        $('#page-container').removeClass('page-with-right-sidebar');
    }
    if (option.pageSidebarWide) {
        $('#page-container').removeClass('page-with-wide-sidebar');
    }
    if (option.pageSidebarMinified) {
        $('#page-container').removeClass('page-sidebar-minified');
    }
    if (option.pageSidebarTransparent) {
        $('#sidebar').removeClass('sidebar-transparent');
    }
    if (option.pageContentFullWidth) {
        $('#content').removeClass('content-full-width');
    }
    if (option.pageContentInverseMode) {
        $('#content').removeClass('content-inverse-mode');
    }
    if (option.pageBoxedLayout) {
        $('body').removeClass('boxed-layout');
    }
}

