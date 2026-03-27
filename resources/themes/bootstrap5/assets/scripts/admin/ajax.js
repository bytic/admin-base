import $ from 'jquery';
import { BaseComponent } from './base-component';

// ── page-option helpers (standalone, used by App public API) ──────────────────

export function applyPageOption(option, add) {
    var method = add ? 'addClass' : 'removeClass';
    var map = {
        pageContentFullHeight:  ['#page-container', 'page-content-full-height'],
        pageSidebarLight:       ['#page-container', 'page-with-light-sidebar'],
        pageSidebarRight:       ['#page-container', 'page-with-right-sidebar'],
        pageSidebarWide:        ['#page-container', 'page-with-wide-sidebar'],
        pageSidebarMinified:    ['#page-container', 'page-sidebar-minified'],
        pageSidebarTransparent: ['#sidebar',        'sidebar-transparent'],
        pageContentFullWidth:   ['#content',        'content-full-width'],
        pageContentInverseMode: ['#content',        'content-inverse-mode'],
        pageBoxedLayout:        ['body',            'boxed-layout'],
    };

    Object.keys(map).forEach(function (key) {
        if (option[key]) {
            var target = map[key][0];
            var cls    = map[key][1];
            $(target)[method](cls);
        }
    });
}

// ── Component ─────────────────────────────────────────────────────────────────

export class AjaxComponent extends BaseComponent {
    constructor() {
        super();
        this._clearOption = null;
    }

    /**
     * Set up ajax-mode navigation if app.setting.ajaxMode is truthy.
     */
    onSetup(app) {
        if (!app.setting || !app.setting.ajaxMode) return;

        this._initAjaxMode(app);
        $.ajaxSetup({ cache: true });
    }

    /** Track a page-option that should be cleared on next ajax navigation. */
    scheduleOptionClear(option) {
        this._clearOption = option;
    }

    // ── private ───────────────────────────────────────────────────────────────

    _initAjaxMode(app) {
        var self = this;
        var setting = app.setting;
        var emptyHtml = setting.emptyHtml ||
            '<div class="p-t-40 p-b-40 text-center f-s-20 content">' +
            '<i class="fa fa-warning fa-lg text-muted m-r-5"></i> ' +
            '<span class="f-w-600 text-inverse">Error 404! Page not found.</span></div>';

        var defaultUrl = setting.ajaxDefaultUrl || '';
        defaultUrl = window.location.hash || defaultUrl;

        if (!defaultUrl) {
            $('#content').html(emptyHtml);
        } else {
            renderAjax(defaultUrl, null, true);
        }

        function clearElement() {
            $('.jvectormap-label, .jvector-label, .AutoFill_border, #gritter-notice-wrapper, ' +
              '.ui-autocomplete, .colorpicker, .FixedHeader_Header, .FixedHeader_Cloned, ' +
              '.lightboxOverlay, .lightbox, .introjs-hints, .nvtooltip').remove();
            if ($.fn.DataTable) $('.dataTable').DataTable().destroy();
            $('#page-container').removeClass('page-sidebar-toggled');
        }

        function checkSidebarActive(url) {
            var $el = $('#sidebar [data-toggle="ajax"][href="' + url + '"]');
            if ($el.length) {
                $('#sidebar li').removeClass('active');
                $el.closest('li').addClass('active');
                $el.parents().addClass('active');
            }
        }

        function checkPushState(url) {
            var targetUrl = url.replace('#', '');
            if (window.navigator.userAgent.indexOf('MSIE ') > 0) {
                window.location.href = targetUrl;
            } else {
                history.pushState('', '', '#' + targetUrl);
            }
        }

        function checkLoading(done) {
            if (!done) {
                if (!$('#page-content-loader').length) {
                    $('body').addClass('page-content-loading');
                    $('#content').append('<div id="page-content-loader"><span class="spinner"></span></div>');
                }
            } else {
                $('#page-content-loader').remove();
                $('body').removeClass('page-content-loading');
            }
        }

        function renderAjax(url, elm, disablePushState) {
            if (typeof window.Pace !== 'undefined' && typeof window.Pace.restart === 'function') {
                window.Pace.restart();
            }

            checkLoading(false);
            clearElement();
            checkSidebarActive(url);

            // clear any deferred page-option
            if (self._clearOption) {
                app.clearPageOption(self._clearOption);
                self._clearOption = null;
            }

            if (!disablePushState) checkPushState(url);

            var targetUrl = url.replace('#', '');
            var type      = setting.ajaxType     || 'GET';
            var dataType  = setting.ajaxDataType || 'html';
            if (elm) dataType = $(elm).attr('data-type') || dataType;

            $.ajax({ url: targetUrl, type: type, dataType: dataType,
                success: function (data) { $('#content').html(data); },
                error:   function ()     { $('#content').html(emptyHtml); },
            }).done(function () {
                checkLoading(true);
                $('html, body').animate({ scrollTop: 0 }, 0);
                app.initComponent();
            });
        }

        $(window)
            .off('hashchange.colorAdminAjax')
            .on('hashchange.colorAdminAjax', function () {
                if (window.location.hash) renderAjax(window.location.hash, null, true);
            });

        $(document)
            .off('click.colorAdminAjax', '[data-toggle="ajax"]')
            .on('click.colorAdminAjax', '[data-toggle="ajax"]', function (e) {
                e.preventDefault();
                renderAjax($(this).attr('href'), this);
            });
    }

    onBeforeCache(/* app */) {
        $('#page-content-loader').remove();
        $('body').removeClass('page-content-loading');
    }
}
