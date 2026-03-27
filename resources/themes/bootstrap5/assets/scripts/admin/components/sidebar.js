import $ from 'jquery';
import Cookies from 'js-cookie';
import { BaseComponent } from './base-component';
import { hasJqueryPlugin, isMobileUserAgent } from './shared';

// ── private handlers ─────────────────────────────────────────────────────────

function handleSidebarMenu() {
    var expandTime = $('.sidebar').attr('data-disable-slide-animation') ? 0 : 250;

    $(document).on('click', '.sidebar .nav > .has-sub > a', function (e) {
        e.stopPropagation();
        e.preventDefault();

        var target = $(this).next('.sub-menu');
        var otherMenu = $('.sidebar .nav > li.has-sub > .sub-menu').not(target);
        var sidebarExpanded =
            !$('#page-container').hasClass('page-sidebar-minified') ||
            $('#sidebar').hasClass('sidebar-drawer-active');

        if (!sidebarExpanded) return;

        $(otherMenu).slideUp(expandTime, function () {
            $(otherMenu).closest('li').addClass('closed').removeClass('expand closing');
        });

        if ($(target).is(':visible')) {
            $(target).closest('li').addClass('closing').removeClass('expand');
        } else {
            $(target).closest('li').addClass('expanding').removeClass('closed');
        }

        $(target).slideToggle(expandTime, function () {
            var targetLi = $(this).closest('li');
            if (!$(target).is(':visible')) {
                $(targetLi).addClass('closed').removeClass('expand');
            } else {
                $(targetLi).addClass('expand').removeClass('closed');
            }
            $(targetLi).removeClass('expanding closing');
        });
    });

    $(document).on('click', '.sidebar .nav > .has-sub .sub-menu li.has-sub > a', function (e) {
        e.stopPropagation();
        e.preventDefault();

        if (
            !$('#page-container').hasClass('page-sidebar-minified') ||
            $('#sidebar').hasClass('sidebar-drawer-active')
        ) {
            var target = $(this).next('.sub-menu');
            if ($(target).is(':visible')) {
                $(target).closest('li').addClass('closing').removeClass('expand');
            } else {
                $(target).closest('li').addClass('expanding').removeClass('closed');
            }
            $(target).slideToggle(expandTime, function () {
                var targetLi = $(this).closest('li');
                if (!$(target).is(':visible')) {
                    $(targetLi).addClass('closed').removeClass('expand');
                } else {
                    $(targetLi).addClass('expand').removeClass('closed');
                }
                $(targetLi).removeClass('expanding closing');
            });
        }
    });
}

function handleMobileSidebarToggle() {
    var sidebarProgress = false;

    $(document).on('click touchstart', '.sidebar', function (e) {
        sidebarProgress = $(e.target).closest('.sidebar').length !== 0;
        if (!sidebarProgress) e.stopPropagation();
    });

    $(document).on('click touchstart', function (e) {
        if ($(e.target).closest('.sidebar').length === 0) sidebarProgress = false;

        if (!e.isPropagationStopped() && sidebarProgress !== true) {
            if ($('#page-container').hasClass('page-sidebar-toggled')) {
                sidebarProgress = true;
                $('#page-container').removeClass('page-sidebar-toggled');
            }
            if ($(window).width() <= 767 && $('#page-container').hasClass('page-right-sidebar-toggled')) {
                sidebarProgress = true;
                $('#page-container').removeClass('page-right-sidebar-toggled');
            }
        }
    });

    $(document).on('click', '[data-click=right-sidebar-toggled]', function (e) {
        e.stopPropagation();
        var targetContainer = '#page-container';
        var targetClass = $(window).width() < 768 ? 'page-right-sidebar-toggled' : 'page-right-sidebar-collapsed';

        if ($(targetContainer).hasClass(targetClass)) {
            $(targetContainer).removeClass(targetClass);
        } else if (sidebarProgress !== true) {
            $(targetContainer).addClass(targetClass);
        } else {
            sidebarProgress = false;
        }
        if ($(window).width() < 480) $('#page-container').removeClass('page-sidebar-toggled');
        $(window).trigger('resize');
    });

    $(document).on('click', '[data-click=sidebar-toggled]', function (e) {
        e.stopPropagation();
        var targetContainer = '#page-container';
        var sidebarClass = 'page-sidebar-toggled';

        if ($(targetContainer).hasClass(sidebarClass)) {
            $(targetContainer).removeClass(sidebarClass);
        } else if (sidebarProgress !== true) {
            $(targetContainer).addClass(sidebarClass);
        } else {
            sidebarProgress = false;
        }
        if ($(window).width() < 480) $('#page-container').removeClass('page-right-sidebar-toggled');
    });
}

function handleSidebarMinify() {
    $(document).on('click', '[data-click="sidebar-minify"]', function (e) {
        e.preventDefault();
        var $btn = $(this);
        var minified = false;

        if ($('#page-container').hasClass('page-sidebar-minified')) {
            $('#page-container').removeClass('page-sidebar-minified');
            $btn.attr('aria-expanded', 'true').attr('aria-label', 'Collapse sidebar');
        } else {
            $('#page-container').addClass('page-sidebar-minified');
            if (isMobileUserAgent()) {
                $('#sidebar [data-scrollbar="true"]').css('margin-top', '0').css('overflow-x', 'scroll');
            }
            minified = true;
            $btn.attr('aria-expanded', 'false').attr('aria-label', 'Expand sidebar');
        }
        $(window).trigger('resize');
        if (Cookies) Cookies.set('sidebar-minified', minified);
    });

    if (Cookies && Cookies.get('sidebar-minified') === 'true') {
        $('#page-container').addClass('page-sidebar-minified');
        $('[data-click="sidebar-minify"]').attr('aria-expanded', 'false').attr('aria-label', 'Expand sidebar');
    }
}

function handleSidebarMinifyFloatMenu() {
    var drawerTimeout = null;

    $(document).on('mouseenter', '#sidebar', function () {
        if (!$('#page-container').hasClass('page-sidebar-minified')) return;
        clearTimeout(drawerTimeout);
        $('#sidebar').addClass('sidebar-drawer-active');
    });

    $(document).on('mouseleave', '#sidebar', function () {
        if (!$('#page-container').hasClass('page-sidebar-minified')) return;
        clearTimeout(drawerTimeout);
        drawerTimeout = setTimeout(function () {
            $('#sidebar').removeClass('sidebar-drawer-active');
        }, 150);
    });
}

function handleToggleNavProfile() {
    var expandTime = $('.sidebar').attr('data-disable-slide-animation') ? 0 : 250;

    $(document).on('click', '[data-toggle="nav-profile"]', function (e) {
        e.preventDefault();
        var targetLi = $(this).closest('li');
        var targetProfile = $('.sidebar .nav.nav-profile');

        if ($(targetProfile).is(':visible')) {
            $(targetLi).removeClass('active');
        } else {
            $(targetLi).addClass('active');
            $(targetProfile).addClass('expanding');
        }

        $(targetProfile).slideToggle(expandTime, function () {
            if (!$(targetProfile).is(':visible')) {
                $(targetProfile).addClass('closed').removeClass('expand');
            } else {
                $(targetProfile).addClass('expand').removeClass('closed');
            }
            $(targetProfile).removeClass('expanding closing');
        });
    });
}

function handleSidebarScrollMemory() {
    if (isMobileUserAgent() || !hasJqueryPlugin('slimScroll')) return;
    try {
        if (typeof Storage !== 'undefined') {
            $('.sidebar [data-scrollbar="true"]').slimScroll().bind('slimscrolling', function (e, pos) {
                localStorage.setItem('sidebarScrollPosition', pos + 'px');
            });
            var pos = localStorage.getItem('sidebarScrollPosition');
            if (pos) $('.sidebar [data-scrollbar="true"]').slimScroll({ scrollTo: pos });
        }
    } catch (err) {
        console.log(err);
    }
}

function handleToggleNavbarSearch() {
    $('[data-toggle="navbar-search"]')
        .off('click.colorAdminNavbarSearch')
        .on('click.colorAdminNavbarSearch', function (e) {
            e.preventDefault();
            $('.header').addClass('header-search-toggled');
        });
    $('[data-dismiss="navbar-search"]')
        .off('click.colorAdminNavbarSearch')
        .on('click.colorAdminNavbarSearch', function (e) {
            e.preventDefault();
            $('.header').removeClass('header-search-toggled');
        });
}

function handleSidebarSearch() {
    $(document).on('keyup', '[data-sidebar-search="true"]', function () {
        var $input = $(this);
        var $clearBtn = $input.closest('.sidebar-search-input').find('.sidebar-search-clear');
        var val = ($input.val() || '').toLowerCase();

        if (val) {
            $clearBtn.removeClass('d-none');
            $('.sidebar:not(.sidebar-right) .nav > li:not(.nav-profile):not(.nav-header):not(.nav-search), .sidebar:not(.sidebar-right) .sub-menu > li').addClass('d-none');
            $('.sidebar:not(.sidebar-right) .has-text').removeClass('has-text');
            $('.sidebar:not(.sidebar-right) .expand').removeClass('expand');

            $('.sidebar:not(.sidebar-right) .nav > li:not(.nav-profile):not(.nav-header):not(.nav-search) > a, .sidebar .sub-menu > li > a').each(function () {
                if (($(this).text() || '').toLowerCase().indexOf(val) > -1) {
                    $(this).closest('li').removeClass('d-none').addClass('has-text');
                    if ($(this).closest('li.has-sub').length) {
                        $(this).closest('li.has-sub').find('.sub-menu li.d-none').removeClass('d-none');
                    }
                    if ($(this).closest('.sub-menu').length) {
                        $(this).closest('.sub-menu').css('display', 'block');
                        $(this).closest('.has-sub').removeClass('d-none').addClass('expand');
                        $(this).closest('.sub-menu').find('li:not(.has-text)').addClass('d-none');
                    }
                }
            });
        } else {
            $clearBtn.addClass('d-none');
            $('.sidebar:not(.sidebar-right) .nav > li:not(.nav-profile):not(.nav-header):not(.nav-search).has-sub .sub-menu').removeAttr('style');
            $('.sidebar:not(.sidebar-right) .nav > li:not(.nav-profile):not(.nav-header):not(.nav-search), .sidebar:not(.sidebar-right) .sub-menu > li').removeClass('d-none');
            $('.sidebar:not(.sidebar-right) .expand').removeClass('expand');
        }
    });

    $(document).on('click', '.sidebar-search-clear', function () {
        var $input = $(this).closest('.sidebar-search-input').find('[data-sidebar-search="true"]');
        $input.val('').trigger('keyup').focus();
        $(this).addClass('d-none');
    });

    $(document).on('click', '#sidebar-overlay', function () {
        $('#page-container').removeClass('page-sidebar-toggled');
    });
}

// ── Component ─────────────────────────────────────────────────────────────────

export class SidebarComponent extends BaseComponent {
    /**
     * Register all sidebar event handlers once.
     */
    onSetup(app) {
        handleSidebarMenu();
        handleMobileSidebarToggle();
        handleSidebarMinify();
        handleSidebarMinifyFloatMenu();
        handleToggleNavProfile();
        handleToggleNavbarSearch();
        handleSidebarSearch();

        if (!app.setting || !app.setting.disableSidebarScrollMemory) {
            handleSidebarScrollMemory();
        }
    }

    onBeforeCache(/* app */) {
        this.clearMobileSelection();
    }

    // ── public helpers (used by App backward-compat API) ──────────────────────

    clearSelection() {
        $('.sidebar .nav > li, .sidebar .nav .sub-menu').removeClass('expand').removeAttr('style');
    }

    clearMobileSelection() {
        $('#page-container').removeClass('page-sidebar-toggled');
    }
}
