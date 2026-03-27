import $ from 'jquery';
import { BaseComponent } from './base-component';
import { canUseTooltip, convertNumberWithCommas, countDecimals, hasJqueryPlugin, isMobileUserAgent } from './shared';

// ── private handlers ─────────────────────────────────────────────────────────

export function generateSlimScroll(element) {
    if ($(element).attr('data-init')) {
        return;
    }

    var dataHeight = $(element).attr('data-height');
    dataHeight = !dataHeight ? $(element).height() : dataHeight;

    var scrollBarOption = { height: dataHeight };

    if (isMobileUserAgent()) {
        $(element).css('height', dataHeight);
        $(element).css('overflow-x', 'scroll');
    } else if (hasJqueryPlugin('slimScroll')) {
        $(element).slimScroll(scrollBarOption);
    } else {
        $(element).css('height', dataHeight);
        $(element).css('overflow-y', 'auto');
    }

    $(element).attr('data-init', true);
    $('.slimScrollBar').hide();
}

function handleSlimScroll() {
    $.when(
        $('[data-scrollbar=true]').each(function () {
            generateSlimScroll($(this));
        })
    ).done(function () {
        $('[data-scrollbar="true"]').mouseover();
    });
}

function handlePageContentView() {
    var hideClass = 'd-none';
    var showClass = 'show';

    function showPage() {
        $.when($('#page-loader').addClass(hideClass)).done(function () {
            $('#page-container').addClass(showClass);
        });
    }

    if (document.readyState === 'complete') {
        showPage();
        return;
    }

    $(window).off('load.colorAdminPage').on('load.colorAdminPage', showPage);
}

function handleTooltipPopoverActivation() {
    if (hasJqueryPlugin('tooltip') && $('[data-toggle="tooltip"]').length !== 0) {
        $('[data-toggle=tooltip]').tooltip();
    }
    if (hasJqueryPlugin('popover') && $('[data-toggle="popover"]').length !== 0) {
        $('[data-toggle=popover]').popover();
    }
}

function handleScrollToTopButton() {
    var showClass = 'show';

    $(document)
        .off('scroll.colorAdminScrollTop')
        .on('scroll.colorAdminScrollTop', function () {
            if ($(document).scrollTop() >= 200) {
                $('[data-click=scroll-top]').addClass(showClass);
            } else {
                $('[data-click=scroll-top]').removeClass(showClass);
            }
        });

    $(document)
        .off('click.colorAdminScrollTop', '[data-click=scroll-top]')
        .on('click.colorAdminScrollTop', '[data-click=scroll-top]', function (e) {
            e.preventDefault();
            $('html, body').animate({ scrollTop: $('body').offset().top }, 500);
        });
}

function handleAfterPageLoadAddClass() {
    if ($('[data-pageload-addclass]').length === 0) {
        return;
    }
    $(window).off('load.colorAdminAddClass').on('load.colorAdminAddClass', function () {
        $('[data-pageload-addclass]').each(function () {
            $(this).addClass($(this).attr('data-pageload-addclass'));
        });
    });
}

function handleIEFullHeightContent() {
    var msie = window.navigator.userAgent.indexOf('MSIE ');
    if (msie > 0) {
        $('.vertical-box-row [data-scrollbar="true"][data-height="100%"]').each(function () {
            var targetRow = $(this).closest('.vertical-box-row');
            $(targetRow).find('.vertical-box-cell').height($(targetRow).height());
        });
    }
}

function handleUnlimitedTabsRender() {
    function handleTabOverflowScrollWidth(obj, animationSpeed) {
        var targetElm = 'li.active';
        if ($(obj).find('li').first().hasClass('nav-item')) {
            targetElm = $(obj).find('.nav-item .active').closest('li');
        }

        var targetCss = $('body').css('direction') === 'rtl' ? 'margin-right' : 'margin-left';
        var viewWidth = $(obj).width();
        var prevWidth = $(obj).find(targetElm).width();
        var speed = animationSpeed > -1 ? animationSpeed : 150;
        var fullWidth = 0;

        $(obj).find(targetElm).prevAll().each(function () { prevWidth += $(this).width(); });
        $(obj).find('li').each(function () { fullWidth += $(this).width(); });

        if (prevWidth >= viewWidth) {
            var finalScrollWidth = prevWidth - viewWidth + (fullWidth !== prevWidth ? 40 : 0);
            if ($('body').css('direction') === 'rtl') {
                $(obj).find('.nav.nav-tabs').animate({ marginRight: '-' + finalScrollWidth + 'px' }, speed);
            } else {
                $(obj).find('.nav.nav-tabs').animate({ marginLeft: '-' + finalScrollWidth + 'px' }, speed);
            }
        }

        $(obj).toggleClass('overflow-right', prevWidth !== fullWidth && fullWidth >= viewWidth);
        $(obj).toggleClass('overflow-left', prevWidth >= viewWidth && fullWidth >= viewWidth);
    }

    function handleTabButtonAction(element, direction) {
        var obj = $(element).closest('.tab-overflow');
        var targetCss = $('body').css('direction') === 'rtl' ? 'margin-right' : 'margin-left';
        var marginLeft = parseInt($(obj).find('.nav.nav-tabs').css(targetCss), 10);
        var containerWidth = $(obj).width();
        var totalWidth = 0;
        var finalScrollWidth = 0;

        $(obj).find('li').each(function () {
            if (!$(this).hasClass('next-button') && !$(this).hasClass('prev-button')) {
                totalWidth += $(this).width();
            }
        });

        if (direction === 'next') {
            var widthLeft = totalWidth + marginLeft - containerWidth;
            finalScrollWidth = widthLeft <= containerWidth
                ? (setTimeout(function () { $(obj).removeClass('overflow-right'); }, 150), widthLeft - marginLeft)
                : containerWidth - marginLeft - 80;

            if (finalScrollWidth !== 0) {
                var prop = $('body').css('direction') !== 'rtl' ? { marginLeft: '-' + finalScrollWidth + 'px' } : { marginRight: '-' + finalScrollWidth + 'px' };
                $(obj).find('.nav.nav-tabs').animate(prop, 150, function () { $(obj).addClass('overflow-left'); });
            }
        } else if (direction === 'prev') {
            var widthRight = -marginLeft;
            if (widthRight <= containerWidth) {
                $(obj).removeClass('overflow-left');
                finalScrollWidth = 0;
            } else {
                finalScrollWidth = widthRight - containerWidth + 80;
            }
            var propPrev = $('body').css('direction') !== 'rtl' ? { marginLeft: '-' + finalScrollWidth + 'px' } : { marginRight: '-' + finalScrollWidth + 'px' };
            $(obj).find('.nav.nav-tabs').animate(propPrev, 150, function () { $(obj).addClass('overflow-right'); });
        }
    }

    function handlePageLoadTabFocus() {
        $('.tab-overflow').each(function () { handleTabOverflowScrollWidth(this, 0); });
    }

    $(document)
        .off('click.colorAdminTabs', '[data-click="next-tab"]')
        .on('click.colorAdminTabs', '[data-click="next-tab"]', function (e) {
            e.preventDefault();
            handleTabButtonAction(this, 'next');
        });

    $(document)
        .off('click.colorAdminTabs', '[data-click="prev-tab"]')
        .on('click.colorAdminTabs', '[data-click="prev-tab"]', function (e) {
            e.preventDefault();
            handleTabButtonAction(this, 'prev');
        });

    $(window)
        .off('resize.colorAdminTabs')
        .on('resize.colorAdminTabs', function () {
            $('.tab-overflow .nav.nav-tabs').removeAttr('style');
            handlePageLoadTabFocus();
        });

    handlePageLoadTabFocus();
}

function handlePageScrollClass() {
    function check() {
        $('#page-container').toggleClass('has-scroll', $(window).scrollTop() > 0);
    }
    $(window).off('scroll.colorAdminPageClass').on('scroll.colorAdminPageClass', check);
    check();
}

function handleAnimation() {
    $('[data-animation]').each(function () {
        var targetAnimate = $(this).attr('data-animation');
        var targetValue = $(this).attr('data-value');

        switch (targetAnimate) {
            case 'width':
                $(this).css('width', targetValue);
                break;
            case 'height':
                $(this).css('height', targetValue);
                break;
            case 'number': {
                var targetElm = this;
                var decimal = countDecimals(targetValue);
                var divide = Math.pow(10, decimal);
                $({ animateNumber: 0 }).animate({ animateNumber: targetValue }, {
                    duration: 1000,
                    easing: 'swing',
                    step: function () {
                        $(targetElm).text(convertNumberWithCommas((Math.ceil(this.animateNumber * divide) / divide).toFixed(decimal)));
                    },
                    done: function () {
                        $(targetElm).text(convertNumberWithCommas(targetValue));
                    },
                });
                break;
            }
            case 'class':
                $(this).addClass(targetValue);
                break;
            default:
                break;
        }
    });
}

// ── Component ─────────────────────────────────────────────────────────────────

export class LayoutComponent extends BaseComponent {
    /**
     * Called once: bind the page-load fade-in (window 'load' listener must be
     * registered before the event fires, so it goes in onSetup).
     */
    onSetup(/* app */) {
        handlePageContentView();
    }

    /**
     * Called every navigation: re-process DOM widgets.
     */
    onInit(/* app */) {
        handleIEFullHeightContent();
        handleSlimScroll();
        handleUnlimitedTabsRender();
        handleScrollToTopButton();
        handleAfterPageLoadAddClass();
        handlePageScrollClass();
        handleAnimation();

        if ($(window).width() > 767) {
            handleTooltipPopoverActivation();
        }
    }
}
