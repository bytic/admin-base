import $ from 'jquery';

export function handleUnlimitedTopMenuRender() {
    function handleMenuButtonAction(element, direction) {
        var obj = $(element).closest('.nav');
        var targetCss = $('body').css('direction') === 'rtl' ? 'margin-right' : 'margin-left';
        var marginLeft = parseInt($(obj).css(targetCss), 10);
        var containerWidth = $('.top-menu').width() - 88;
        var totalWidth = 0;
        var finalScrollWidth = 0;

        $(obj)
            .find('li')
            .each(function () {
                if (!$(this).hasClass('menu-control')) {
                    totalWidth += $(this).width();
                }
            });

        switch (direction) {
            case 'next': {
                var widthLeft = totalWidth + marginLeft - containerWidth;
                if (widthLeft <= containerWidth) {
                    finalScrollWidth = widthLeft - marginLeft + 128;
                    setTimeout(function () {
                        $(obj).find('.menu-control.menu-control-right').removeClass('show');
                    }, 150);
                } else {
                    finalScrollWidth = containerWidth - marginLeft - 128;
                }

                if (finalScrollWidth !== 0) {
                    if ($('body').css('direction') !== 'rtl') {
                        $(obj).animate({ marginLeft: '-' + finalScrollWidth + 'px' }, 150, function () {
                            $(obj).find('.menu-control.menu-control-left').addClass('show');
                        });
                    } else {
                        $(obj).animate({ marginRight: '-' + finalScrollWidth + 'px' }, 150, function () {
                            $(obj).find('.menu-control.menu-control-left').addClass('show');
                        });
                    }
                }
                break;
            }
            case 'prev': {
                var widthRight = -marginLeft;

                if (widthRight <= containerWidth) {
                    $(obj).find('.menu-control.menu-control-left').removeClass('show');
                    finalScrollWidth = 0;
                } else {
                    finalScrollWidth = widthRight - containerWidth + 88;
                }

                if ($('body').css('direction') !== 'rtl') {
                    $(obj).animate({ marginLeft: '-' + finalScrollWidth + 'px' }, 150, function () {
                        $(obj).find('.menu-control.menu-control-right').addClass('show');
                    });
                } else {
                    $(obj).animate({ marginRight: '-' + finalScrollWidth + 'px' }, 150, function () {
                        $(obj).find('.menu-control.menu-control-right').addClass('show');
                    });
                }
                break;
            }
            default:
                break;
        }
    }

    function handlePageLoadMenuFocus() {
        var targetMenu = $('.top-menu .nav');
        var targetList = $('.top-menu .nav > li');
        var targetActiveList = $('.top-menu .nav > li.active');
        var targetContainer = $('.top-menu');
        var viewWidth = $(targetContainer).width() - 128;
        var prevWidth = $('.top-menu .nav > li.active').width();
        var fullWidth = 0;

        $(targetActiveList).prevAll().each(function () {
            prevWidth += $(this).width();
        });

        $(targetList).each(function () {
            if (!$(this).hasClass('menu-control')) {
                fullWidth += $(this).width();
            }
        });

        if (prevWidth >= viewWidth) {
            var finalScrollWidth = prevWidth - viewWidth + 128;
            if ($('body').css('direction') !== 'rtl') {
                $(targetMenu).animate({ marginLeft: '-' + finalScrollWidth + 'px' }, 0);
            } else {
                $(targetMenu).animate({ marginRight: '-' + finalScrollWidth + 'px' }, 0);
            }
        }

        if (prevWidth !== fullWidth && fullWidth >= viewWidth) {
            $(targetMenu).find('.menu-control.menu-control-right').addClass('show');
        } else {
            $(targetMenu).find('.menu-control.menu-control-right').removeClass('show');
        }

        if (prevWidth >= viewWidth && fullWidth >= viewWidth) {
            $(targetMenu).find('.menu-control.menu-control-left').addClass('show');
        } else {
            $(targetMenu).find('.menu-control.menu-control-left').removeClass('show');
        }
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

    $(window).off('resize.colorAdminTopMenu').on('resize.colorAdminTopMenu', function () {
        $('.top-menu .nav').removeAttr('style');
        handlePageLoadMenuFocus();
    });

    handlePageLoadMenuFocus();
}

export function handleTopMenuSubMenu() {
    $(document).on('click', '.top-menu .sub-menu .has-sub > a', function () {
        var target = $(this).closest('li').find('.sub-menu').first();
        var otherMenu = $(this).closest('ul').find('.sub-menu').not(target);
        $(otherMenu)
            .not(target)
            .slideUp(250, function () {
                $(this).closest('li').removeClass('expand');
            });
        $(target).slideToggle(250, function () {
            var targetLi = $(this).closest('li');
            if ($(targetLi).hasClass('expand')) {
                $(targetLi).removeClass('expand');
            } else {
                $(targetLi).addClass('expand');
            }
        });
    });
}

export function handleMobileTopMenuSubMenu() {
    $(document).on('click', '.top-menu .nav > li.has-sub > a', function () {
        if ($(window).width() <= 767) {
            var target = $(this).closest('li').find('.sub-menu').first();
            var otherMenu = $(this).closest('ul').find('.sub-menu').not(target);
            $(otherMenu)
                .not(target)
                .slideUp(250, function () {
                    $(this).closest('li').removeClass('expand');
                });
            $(target).slideToggle(250, function () {
                var targetLi = $(this).closest('li');
                if ($(targetLi).hasClass('expand')) {
                    $(targetLi).removeClass('expand');
                } else {
                    $(targetLi).addClass('expand');
                }
            });
        }
    });
}

export function handleTopMenuMobileToggle() {
    $(document).on('click', '[data-click="top-menu-toggled"]', function () {
        $('.top-menu').slideToggle(250);
    });
}

