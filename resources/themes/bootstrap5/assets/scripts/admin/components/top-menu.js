import $ from 'jquery';
import { BaseComponent } from './base-component';

// ── private handlers ─────────────────────────────────────────────────────────

function handleUnlimitedTopMenuRender() {
    function handleMenuButtonAction(element, direction) {
        var obj = $(element).closest('.nav');
        var targetCss = $('body').css('direction') === 'rtl' ? 'margin-right' : 'margin-left';
        var marginLeft = parseInt($(obj).css(targetCss), 10);
        var containerWidth = $('.top-menu').width() - 88;
        var totalWidth = 0;
        var finalScrollWidth = 0;

        $(obj).find('li').each(function () {
            if (!$(this).hasClass('menu-control')) totalWidth += $(this).width();
        });

        if (direction === 'next') {
            var widthLeft = totalWidth + marginLeft - containerWidth;
            if (widthLeft <= containerWidth) {
                finalScrollWidth = widthLeft - marginLeft + 128;
                setTimeout(function () { $(obj).find('.menu-control.menu-control-right').removeClass('show'); }, 150);
            } else {
                finalScrollWidth = containerWidth - marginLeft - 128;
            }
            if (finalScrollWidth !== 0) {
                var prop = $('body').css('direction') !== 'rtl'
                    ? { marginLeft: '-' + finalScrollWidth + 'px' }
                    : { marginRight: '-' + finalScrollWidth + 'px' };
                $(obj).animate(prop, 150, function () { $(obj).find('.menu-control.menu-control-left').addClass('show'); });
            }
        } else if (direction === 'prev') {
            var widthRight = -marginLeft;
            if (widthRight <= containerWidth) {
                $(obj).find('.menu-control.menu-control-left').removeClass('show');
                finalScrollWidth = 0;
            } else {
                finalScrollWidth = widthRight - containerWidth + 88;
            }
            var propPrev = $('body').css('direction') !== 'rtl'
                ? { marginLeft: '-' + finalScrollWidth + 'px' }
                : { marginRight: '-' + finalScrollWidth + 'px' };
            $(obj).animate(propPrev, 150, function () { $(obj).find('.menu-control.menu-control-right').addClass('show'); });
        }
    }

    function handlePageLoadMenuFocus() {
        var targetMenu = $('.top-menu .nav');
        var targetList = $('.top-menu .nav > li');
        var targetActiveList = $('.top-menu .nav > li.active');
        var targetContainer = $('.top-menu');
        var viewWidth = $(targetContainer).width() - 128;
        var prevWidth = targetActiveList.width() || 0;
        var fullWidth = 0;

        targetActiveList.prevAll().each(function () { prevWidth += $(this).width(); });
        targetList.each(function () {
            if (!$(this).hasClass('menu-control')) fullWidth += $(this).width();
        });

        if (prevWidth >= viewWidth) {
            var finalScrollWidth = prevWidth - viewWidth + 128;
            if ($('body').css('direction') !== 'rtl') {
                $(targetMenu).animate({ marginLeft: '-' + finalScrollWidth + 'px' }, 0);
            } else {
                $(targetMenu).animate({ marginRight: '-' + finalScrollWidth + 'px' }, 0);
            }
        }

        $(targetMenu).find('.menu-control.menu-control-right').toggleClass('show', prevWidth !== fullWidth && fullWidth >= viewWidth);
        $(targetMenu).find('.menu-control.menu-control-left').toggleClass('show', prevWidth >= viewWidth && fullWidth >= viewWidth);
    }

    $(document)
        .off('click.colorAdminTopMenu', '[data-click="next-menu"]')
        .on('click.colorAdminTopMenu', '[data-click="next-menu"]', function (e) {
            e.preventDefault();
            handleMenuButtonAction(this, 'next');
        });

    $(document)
        .off('click.colorAdminTopMenu', '[data-click="prev-menu"]')
        .on('click.colorAdminTopMenu', '[data-click="prev-menu"]', function (e) {
            e.preventDefault();
            handleMenuButtonAction(this, 'prev');
        });

    $(window)
        .off('resize.colorAdminTopMenu')
        .on('resize.colorAdminTopMenu', function () {
            $('.top-menu .nav').removeAttr('style');
            handlePageLoadMenuFocus();
        });

    handlePageLoadMenuFocus();
}

function handleTopMenuSubMenu() {
    $(document).on('click', '.top-menu .sub-menu .has-sub > a', function () {
        var target = $(this).closest('li').find('.sub-menu').first();
        var otherMenu = $(this).closest('ul').find('.sub-menu').not(target);
        $(otherMenu).not(target).slideUp(250, function () { $(this).closest('li').removeClass('expand'); });
        $(target).slideToggle(250, function () {
            $(this).closest('li').toggleClass('expand', $(target).is(':visible'));
        });
    });
}

function handleMobileTopMenuSubMenu() {
    $(document).on('click', '.top-menu .nav > li.has-sub > a', function () {
        if ($(window).width() > 767) return;
        var target = $(this).closest('li').find('.sub-menu').first();
        var otherMenu = $(this).closest('ul').find('.sub-menu').not(target);
        $(otherMenu).not(target).slideUp(250, function () { $(this).closest('li').removeClass('expand'); });
        $(target).slideToggle(250, function () {
            $(this).closest('li').toggleClass('expand', $(target).is(':visible'));
        });
    });
}

function handleTopMenuMobileToggle() {
    $(document).on('click', '[data-click="top-menu-toggled"]', function () {
        $('.top-menu').slideToggle(250);
    });
}

// ── Component ─────────────────────────────────────────────────────────────────

export class TopMenuComponent extends BaseComponent {
    /**
     * Register all top-menu handlers once.
     * handleUnlimitedTopMenuRender() already uses off/on so it is safe to
     * re-call via the public setup() method when restartGlobalFunction() runs.
     */
    onSetup(/* app */) {
        this._mount();
    }
    onInit(app) {
        this._mount();
    }
    /** Called by App.restartGlobalFunction() for explicit top-menu refresh. */
    setup(/* app */) {
        this._mount();
    }

    _mount() {
        handleUnlimitedTopMenuRender();
        handleTopMenuSubMenu();
        handleMobileTopMenuSubMenu();
        handleTopMenuMobileToggle();
    }
}
