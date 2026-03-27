import $ from 'jquery';
import Cookies from 'js-cookie';
import { hasJqueryPlugin } from './shared';
import { generateSlimScroll } from './layout';

export function handleThemePageStructureControl() {
    $(document).on('click', '.theme-panel [data-click="theme-selector"]', function () {
        var targetFile = $(this).attr('data-theme-file');
        var targetTheme = $(this).attr('data-theme');

        if ($('#theme-css-link').length === 0) {
            $('head').append('<link href="' + targetFile + '" rel="stylesheet" id="theme-css-link" />');
        } else {
            $('#theme-css-link').attr('href', targetFile);
        }

        $('.theme-panel [data-click="theme-selector"]').not(this).closest('li').removeClass('active');
        $(this).closest('li').addClass('active');

        if (Cookies) {
            Cookies.set('page-theme', targetTheme);
        }
    });

    $(document).on('change', '.theme-panel [name="header-inverse"]', function () {
        var targetValue = $(this).is(':checked');
        var targetClassAdd = !targetValue ? 'navbar-default' : 'navbar-inverse';
        var targetClassRemove = !targetValue ? 'navbar-inverse' : 'navbar-default';
        $('#header').removeClass(targetClassRemove).addClass(targetClassAdd);

        if (Cookies) {
            Cookies.set('header-theme', targetClassAdd);
        }
    });

    $(document).on('change', '.theme-panel [name="sidebar-grid"]', function () {
        var sidebarGrid = false;
        if ($(this).is(':checked')) {
            $('#sidebar').addClass('sidebar-grid');
            sidebarGrid = true;
        } else {
            $('#sidebar').removeClass('sidebar-grid');
        }

        if (Cookies) {
            Cookies.set('sidebar-grid', sidebarGrid);
        }
    });

    $(document).on('change', '.theme-panel [name="sidebar-gradient"]', function () {
        var sidebarGradient = false;
        if ($(this).is(':checked')) {
            $('#page-container').addClass('gradient-enabled');
            sidebarGradient = true;
        } else {
            $('#page-container').removeClass('gradient-enabled');
        }

        if (Cookies) {
            Cookies.set('sidebar-gradient', sidebarGradient);
        }
    });

    $(document).on('change', '.theme-panel [name="sidebar-fixed"]', function () {
        var sidebarFixed = false;

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
            sidebarFixed = true;
        } else {
            $('#page-container').removeClass('page-sidebar-fixed');

            if ($('.sidebar .slimScrollDiv').length !== 0 && hasJqueryPlugin('slimScroll')) {
                if ($(window).width() <= 979) {
                    $('.sidebar').each(function () {
                        if (!($('#page-container').hasClass('page-with-two-sidebar') && $(this).hasClass('sidebar-right'))) {
                            $(this).find('.slimScrollBar').remove();
                            $(this).find('.slimScrollRail').remove();
                            $(this).find('[data-scrollbar="true"]').removeAttr('style');
                            var targetElement = $(this).find('[data-scrollbar="true"]').parent();
                            var targetHtml = $(targetElement).html();
                            $(targetElement).replaceWith(targetHtml);
                        }
                    });
                } else if ($(window).width() > 979) {
                    $('.sidebar [data-scrollbar="true"]').slimScroll({ destroy: true });
                    $('.sidebar [data-scrollbar="true"]').removeAttr('style').removeAttr('data-init');
                }
            }

            if ($('#page-container .sidebar-bg').length === 0) {
                $('#page-container').append('<div class="sidebar-bg"></div>');
            }
        }

        if (Cookies) {
            Cookies.set('sidebar-fixed', sidebarFixed);
        }
    });

    $(document).on('change', '.theme-panel [name="header-fixed"]', function () {
        var headerFixed = false;

        if ($(this).is(':checked')) {
            $('#header').addClass('navbar-fixed-top');
            $('#page-container').addClass('page-header-fixed');
            headerFixed = true;
        } else {
            if ($('.theme-panel [name="sidebar-fixed"]').is(':checked')) {
                alert('Default Header with Fixed Sidebar option is not supported. Proceed with Default Header with Default Sidebar.');
                $('.theme-panel [name="sidebar-fixed"]').prop('checked', false);
                $('.theme-panel [name="sidebar-fixed"]').trigger('change');
                if ($('#page-container .sidebar-bg').length === 0) {
                    $('#page-container').append('<div class="sidebar-bg"></div>');
                }
            }

            $('#header').removeClass('navbar-fixed-top');
            $('#page-container').removeClass('page-header-fixed');
        }

        if (Cookies) {
            Cookies.set('header-fixed', headerFixed);
        }
    });

    if (Cookies) {
        var pageTheme = Cookies.get('page-theme');
        var headerTheme = Cookies.get('header-theme');
        var sidebarGrid = Cookies.get('sidebar-grid');
        var sidebarGradient = Cookies.get('sidebar-gradient');
        var sidebarFixed = Cookies.get('sidebar-fixed');
        var headerFixed = Cookies.get('header-fixed');

        if (pageTheme) {
            $('.theme-panel [data-click="theme-selector"][data-theme="' + pageTheme + '"]').trigger('click');
        }
        if (headerTheme === 'navbar-inverse') {
            $('.theme-panel [name="header-inverse"]').prop('checked', true).trigger('change');
        }
        if (sidebarGrid === 'true') {
            $('.theme-panel [name="sidebar-grid"]').prop('checked', true).trigger('change');
        }
        if (sidebarGradient === 'true') {
            $('.theme-panel [name="sidebar-gradient"]').prop('checked', true).trigger('change');
        }
        if (sidebarFixed === 'false') {
            $('.theme-panel [name="sidebar-fixed"]').prop('checked', false).trigger('change');
        }
        if (headerFixed === 'false') {
            $('.theme-panel [name="header-fixed"]').prop('checked', false).trigger('change');
        }
    }
}

export function handleThemePanelExpand() {
    $(document).on('click', '[data-click="theme-panel-expand"]', function () {
        var targetContainer = '.theme-panel';
        var targetClass = 'active';
        var targetExpand = false;

        if ($(targetContainer).hasClass(targetClass)) {
            $(targetContainer).removeClass(targetClass);
        } else {
            $(targetContainer).addClass(targetClass);
            targetExpand = true;
        }

        if (Cookies) {
            Cookies.set('theme-panel-expand', targetExpand);
        }
    });

    if (Cookies) {
        var themePanelExpand = Cookies.get('theme-panel-expand');
        if (themePanelExpand === 'true') {
            $('[data-click="theme-panel-expand"]').trigger('click');
        }
    }
}

