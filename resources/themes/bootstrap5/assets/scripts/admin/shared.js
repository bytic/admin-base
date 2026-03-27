import $ from 'jquery';

export function hasJqueryPlugin(pluginName) {
    return typeof $.fn[pluginName] === 'function';
}

export function canUseTooltip() {
    return hasJqueryPlugin('tooltip');
}

export function isMobileUserAgent() {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

export function convertNumberWithCommas(value) {
    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

export function countDecimals(value) {
    var split = value.toString().split('.');

    return split[1] ? split[1].length : 0;
}

