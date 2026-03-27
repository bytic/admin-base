import $ from 'jquery';
import Cookies from 'js-cookie';
import { BaseComponent } from './base-component';
import { hasJqueryPlugin } from './shared';
import { generateSlimScroll } from './layout';

// ── private handlers ─────────────────────────────────────────────────────────

function handleThemePageStructureControl() {
    $(document).on('click', '.theme-panel [data-click="theme-selector"]', function () {
        var targetFile = $(this).attr('data-theme-file');
        var targetTheme = $(this).attr('data-theme');

        if (!$('#theme-css-link').length) {
            $('head').append('<link href="' + targetFile + '" rel="stylesheet" id="theme-css-link" />');
        } else {
            $('#theme-css-link').attr('href', targetFile);
        }
        $('.theme-panel [data-click="theme-selector"]').not(this).closest('li').removeClass('active');
        $(this).closest('li').addClass('active');
        if (Cookies) Cookies.set('page-theme', targetTheme);
    });

    $(document).on('change', '.theme-panel [name="header-inverse"]', function () {
        var checked = $(this).is(':checked');
        $('#header')
            .removeClass(checked ? 'navbar-default' : 'navbar-inverse')
            .addClass(checked ? 'navbar-inverse' : 'navbar-default');
        if (Cookies) Cookies.set('header-theme', checked ? 'navbar-inverse' : 'navbar-default');
    });

    $(document).on('change', '.theme-panel [name="sidebar-grid"]', function () {
        var on = $(this).is(':checked');
        $('#sidebar').toggleClass('sidebar-grid', on);
        if (Cookies) Cookies.set('sidebar-grid', on);
    });

    $(document).on('change', '.theme-panel [name="sidebar-gradient"]', function () {
        var on = $(this).is(':checked');
        $('#page-container').toggleClass('gradient-enabled', on);
        if (Cookies) Cookies.set('sidebar-gradient', on);
    });

    $(document).on('change', '.theme-panel [name="sidebar-fixed"]', function () {
        if ($(this).is(':checked')) {
            if (!$('.theme-panel [name="header-fixed"]').is(':checked')) {
                alert('Default Header with Fixed Sidebar option is not supported. Proceed with Fixed Header with Fixed Sidebar.');
                $('.theme-panel [name="header-fixed"]').prop('checked', true);
                $('#page-container').addClass('page-header-fixed');
            }
            $('#page-container').addClass('page-sidebar-fixed');
            if (!$('#page-container').hasClass('page-sidebar-minified')) {
                generateSlimScroll($('.sidebar [data-scrollbar="true"]'));
            }
            if (Cookies) Cookies.set('sidebar-fixed', true);
        } else {
            $('#page-container').removeClass('page-sidebar-fixed');
            if ($('.sidebar .slimScrollDiv').length && hasJqueryPlugin('slimScroll')) {
                if ($(window).width() <= 979) {
                    $('.sidebar').each(function () {
                        if (!($('#page-container').hasClass('page-with-two-sidebar') && $(this).hasClass('sidebar-right'))) {
                            $(this).find('.slimScrollBar, .slimScrollRail').remove();
                            $(this).find('[data-scrollbar="true"]').removeAttr('style');
                            var el = $(this).find('[data-scrollbar="true"]').parent();
                            el.replaceWith(el.html());
                        }
                    });
                } else {
                    $('.sidebar [data-scrollbar="true"]').slimScroll({ destroy: true }).removeAttr('style data-init');
                }
            }
            if (!$('#page-container .sidebar-bg').length) {
                $('#page-container').append('<div class="sidebar-bg"></div>');
            }
            if (Cookies) Cookies.set('sidebar-fixed', false);
        }
    });

    $(document).on('change', '.theme-panel [name="header-fixed"]', function () {
        if ($(this).is(':checked')) {
            $('#header').addClass('navbar-fixed-top');
            $('#page-container').addClass('page-header-fixed');
            if (Cookies) Cookies.set('header-fixed', true);
        } else {
            if ($('.theme-panel [name="sidebar-fixed"]').is(':checked')) {
                alert('Default Header with Fixed Sidebar option is not supported. Proceed with Default Header with Default Sidebar.');
                $('.theme-panel [name="sidebar-fixed"]').prop('checked', false).trigger('change');
                if (!$('#page-container .sidebar-bg').length) {
                    $('#page-container').append('<div class="sidebar-bg"></div>');
                }
            }
            $('#header').removeClass('navbar-fixed-top');
            $('#page-container').removeClass('page-header-fixed');
            if (Cookies) Cookies.set('header-fixed', false);
        }
    });

    if (Cookies) {
        var pageTheme    = Cookies.get('page-theme');
        var headerTheme  = Cookies.get('header-theme');
        var sidebarGrid  = Cookies.get('sidebar-grid');
        var sidebarGrad  = Cookies.get('sidebar-gradient');
        var sidebarFixed = Cookies.get('sidebar-fixed');
        var headerFixed  = Cookies.get('header-fixed');

        if (pageTheme)  $('.theme-panel [data-click="theme-selector"][data-theme="' + pageTheme + '"]').trigger('click');
        if (headerTheme === 'navbar-inverse') $('.theme-panel [name="header-inverse"]').prop('checked', true).trigger('change');
        if (sidebarGrid  === 'true')  $('.theme-panel [name="sidebar-grid"]').prop('checked', true).trigger('change');
        if (sidebarGrad  === 'true')  $('.theme-panel [name="sidebar-gradient"]').prop('checked', true).trigger('change');
        if (sidebarFixed === 'false') $('.theme-panel [name="sidebar-fixed"]').prop('checked', false).trigger('change');
        if (headerFixed  === 'false') $('.theme-panel [name="header-fixed"]').prop('checked', false).trigger('change');
    }
}

function handleThemePanelExpand() {
    $(document).on('click', '[data-click="theme-panel-expand"]', function () {
        var expanded = !$('.theme-panel').hasClass('active');
        $('.theme-panel').toggleClass('active', expanded);
        if (Cookies) Cookies.set('theme-panel-expand', expanded);
    });

    if (Cookies && Cookies.get('theme-panel-expand') === 'true') {
        $('[data-click="theme-panel-expand"]').trigger('click');
    }
}

// ── Component ─────────────────────────────────────────────────────────────────

export class ThemeComponent extends BaseComponent {
    /**
     * Register theme-panel event handlers and restore cookie preferences once.
     */
    onSetup(/* app */) {
        handleThemePageStructureControl();
        handleThemePanelExpand();
    }
}
