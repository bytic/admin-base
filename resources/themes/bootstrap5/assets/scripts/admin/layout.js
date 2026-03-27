import $ from 'jquery';
import { canUseTooltip, convertNumberWithCommas, countDecimals, hasJqueryPlugin, isMobileUserAgent } from './shared';

export function generateSlimScroll(element) {
    if ($(element).attr('data-init')) {
        return;
    }

    var dataHeight = $(element).attr('data-height');
    dataHeight = !dataHeight ? $(element).height() : dataHeight;

    var scrollBarOption = {
        height: dataHeight,
    };

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

export function handleSlimScroll() {
    $.when(
        $('[data-scrollbar=true]').each(function () {
            generateSlimScroll($(this));
        })
    ).done(function () {
        $('[data-scrollbar="true"]').mouseover();
    });
}

export function handlePageContentView() {
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

export function handleTooltipPopoverActivation() {
    if (hasJqueryPlugin('tooltip') && $('[data-toggle="tooltip"]').length !== 0) {
        $('[data-toggle=tooltip]').tooltip();
    }

    if (hasJqueryPlugin('popover') && $('[data-toggle="popover"]').length !== 0) {
        $('[data-toggle=popover]').popover();
    }
}

export function handleScrollToTopButton() {
    var showClass = 'show';

    $(document)
        .off('scroll.colorAdminScrollTop')
        .on('scroll.colorAdminScrollTop', function () {
            var totalScroll = $(document).scrollTop();

            if (totalScroll >= 200) {
                $('[data-click=scroll-top]').addClass(showClass);
            } else {
                $('[data-click=scroll-top]').removeClass(showClass);
            }
        });

    $(document)
        .off('click.colorAdminScrollTop', '[data-click=scroll-top]')
        .on('click.colorAdminScrollTop', '[data-click=scroll-top]', function (e) {
            e.preventDefault();
            $('html, body').animate(
                {
                    scrollTop: $('body').offset().top,
                },
                500
            );
        });
}

export function handleAfterPageLoadAddClass() {
    if ($('[data-pageload-addclass]').length === 0) {
        return;
    }

    $(window).off('load.colorAdminAddClass').on('load.colorAdminAddClass', function () {
        $('[data-pageload-addclass]').each(function () {
            var targetClass = $(this).attr('data-pageload-addclass');
            $(this).addClass(targetClass);
        });
    });
}

export function handleIEFullHeightContent() {
    var userAgent = window.navigator.userAgent;
    var msie = userAgent.indexOf('MSIE ');

    if (msie > 0) {
        $('.vertical-box-row [data-scrollbar="true"][data-height="100%"]').each(function () {
            var targetRow = $(this).closest('.vertical-box-row');
            var targetHeight = $(targetRow).height();
            $(targetRow).find('.vertical-box-cell').height(targetHeight);
        });
    }
}

export function handleUnlimitedTabsRender() {
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

        $(obj)
            .find(targetElm)
            .prevAll()
            .each(function () {
                prevWidth += $(this).width();
            });

        $(obj)
            .find('li')
            .each(function () {
                fullWidth += $(this).width();
            });

        if (prevWidth >= viewWidth) {
            var finalScrollWidth = prevWidth - viewWidth;
            if (fullWidth !== prevWidth) {
                finalScrollWidth += 40;
            }

            if ($('body').css('direction') === 'rtl') {
                $(obj).find('.nav.nav-tabs').animate({ marginRight: '-' + finalScrollWidth + 'px' }, speed);
            } else {
                $(obj).find('.nav.nav-tabs').animate({ marginLeft: '-' + finalScrollWidth + 'px' }, speed);
            }
        }

        if (prevWidth !== fullWidth && fullWidth >= viewWidth) {
            $(obj).addClass('overflow-right');
        } else {
            $(obj).removeClass('overflow-right');
        }

        if (prevWidth >= viewWidth && fullWidth >= viewWidth) {
            $(obj).addClass('overflow-left');
        } else {
            $(obj).removeClass('overflow-left');
        }
    }

    function handleTabButtonAction(element, direction) {
        var obj = $(element).closest('.tab-overflow');
        var targetCss = $('body').css('direction') === 'rtl' ? 'margin-right' : 'margin-left';
        var marginLeft = parseInt($(obj).find('.nav.nav-tabs').css(targetCss), 10);
        var containerWidth = $(obj).width();
        var totalWidth = 0;
        var finalScrollWidth = 0;

        $(obj)
            .find('li')
            .each(function () {
                if (!$(this).hasClass('next-button') && !$(this).hasClass('prev-button')) {
                    totalWidth += $(this).width();
                }
            });

        switch (direction) {
            case 'next': {
                var widthLeft = totalWidth + marginLeft - containerWidth;
                if (widthLeft <= containerWidth) {
                    finalScrollWidth = widthLeft - marginLeft;
                    setTimeout(function () {
                        $(obj).removeClass('overflow-right');
                    }, 150);
                } else {
                    finalScrollWidth = containerWidth - marginLeft - 80;
                }

                if (finalScrollWidth !== 0) {
                    if ($('body').css('direction') !== 'rtl') {
                        $(obj)
                            .find('.nav.nav-tabs')
                            .animate({ marginLeft: '-' + finalScrollWidth + 'px' }, 150, function () {
                                $(obj).addClass('overflow-left');
                            });
                    } else {
                        $(obj)
                            .find('.nav.nav-tabs')
                            .animate({ marginRight: '-' + finalScrollWidth + 'px' }, 150, function () {
                                $(obj).addClass('overflow-left');
                            });
                    }
                }
                break;
            }
            case 'prev': {
                var widthRight = -marginLeft;

                if (widthRight <= containerWidth) {
                    $(obj).removeClass('overflow-left');
                    finalScrollWidth = 0;
                } else {
                    finalScrollWidth = widthRight - containerWidth + 80;
                }

                if ($('body').css('direction') !== 'rtl') {
                    $(obj)
                        .find('.nav.nav-tabs')
                        .animate({ marginLeft: '-' + finalScrollWidth + 'px' }, 150, function () {
                            $(obj).addClass('overflow-right');
                        });
                } else {
                    $(obj)
                        .find('.nav.nav-tabs')
                        .animate({ marginRight: '-' + finalScrollWidth + 'px' }, 150, function () {
                            $(obj).addClass('overflow-right');
                        });
                }
                break;
            }
            default:
                break;
        }
    }

    function handlePageLoadTabFocus() {
        $('.tab-overflow').each(function () {
            handleTabOverflowScrollWidth(this, 0);
        });
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

    $(window).off('resize.colorAdminTabs').on('resize.colorAdminTabs', function () {
        $('.tab-overflow .nav.nav-tabs').removeAttr('style');
        handlePageLoadTabFocus();
    });

    handlePageLoadTabFocus();
}

export function handleCheckScrollClass() {
    if ($(window).scrollTop() > 0) {
        $('#page-container').addClass('has-scroll');
    } else {
        $('#page-container').removeClass('has-scroll');
    }
}

export function handlePageScrollClass() {
    $(window).off('scroll.colorAdminPageClass').on('scroll.colorAdminPageClass', function () {
        handleCheckScrollClass();
    });

    handleCheckScrollClass();
}

export function handleAnimation() {
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
                var divide = 1;
                var x = decimal;
                while (x > 0) {
                    divide *= 10;
                    x--;
                }

                $({ animateNumber: 0 }).animate(
                    { animateNumber: targetValue },
                    {
                        duration: 1000,
                        easing: 'swing',
                        step: function () {
                            var number = (Math.ceil(this.animateNumber * divide) / divide).toFixed(decimal);
                            number = convertNumberWithCommas(number);
                            $(targetElm).text(number);
                        },
                        done: function () {
                            $(targetElm).text(convertNumberWithCommas(targetValue));
                        },
                    }
                );
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

