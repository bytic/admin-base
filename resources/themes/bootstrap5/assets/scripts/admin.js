import $ from 'jquery';
import * as bootstrap from 'bootstrap';

// Keep legacy jQuery plugins and older scripts working in module builds.
window.$ = window.jQuery = $;

function registerBootstrapJqueryBridge(name, PluginClass) {
    if (!PluginClass || $.fn[name]) {
        return;
    }

    $.fn[name] = function (option) {
        var args = Array.prototype.slice.call(arguments, 1);

        return this.each(function () {
            var config = typeof option === 'object' ? option : undefined;
            var instance = PluginClass.getOrCreateInstance(this, config);

            if (typeof option === 'string' && typeof instance[option] === 'function') {
                instance[option].apply(instance, args);
            }
        });
    };
}

registerBootstrapJqueryBridge('tooltip', bootstrap.Tooltip);
registerBootstrapJqueryBridge('popover', bootstrap.Popover);
registerBootstrapJqueryBridge('modal', bootstrap.Modal);

import '../../../abstract/assets/scripts/common.js';
import '../../../abstract/assets/scripts/jquery-ui.js';
import '../../../abstract/assets/scripts/jgrowl.js';
import '../../../abstract/assets/scripts/themes/material.js';
import '../../../abstract/assets/scripts/hotwired.js';

import { App } from './admin/app';

var colorAdminBooted = false;

function bootColorAdmin() {
    if (document.documentElement.hasAttribute('data-turbo-preview')) {
        return;
    }

    App.init();
    colorAdminBooted = true;
}

function beforeCacheColorAdmin() {
    if (typeof App.beforeCache === 'function') {
        App.beforeCache();
    }
}

document.addEventListener('DOMContentLoaded', bootColorAdmin, { once: true });
document.addEventListener('turbo:load', bootColorAdmin);
document.addEventListener('turbolinks:load', bootColorAdmin);
document.addEventListener('turbo:before-cache', beforeCacheColorAdmin);
document.addEventListener('turbolinks:before-cache', beforeCacheColorAdmin);

if (document.readyState !== 'loading' && !colorAdminBooted) {
    bootColorAdmin();
}
