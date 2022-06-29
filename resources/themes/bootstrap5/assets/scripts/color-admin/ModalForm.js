/**
 * --------------------------------------------
 * Bytic Admin ModalForm.js
 * License MIT
 * --------------------------------------------
 */

import $ from 'jquery';
import {Modal} from 'bootstrap';

/**
 * Constants
 * ====================================================
 */

const NAME = 'ModalForm';
const DATA_KEY = 'btc.modalform'
const JQUERY_NO_CONFLICT = $.fn[NAME]

const SELECTOR_DATA_TOGGLE = '[data-bs-toggle=modalForm]'

const HTML_LOADING = '' + '' + '<div style="text-align:center">' + '<h3>Loading content</h3>' + '        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin:auto;background:#fff;display:block;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">\n' + '<g transform="rotate(0 50 50)">\n' + '  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#335eea">\n' + '    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.9166666666666666s" repeatCount="indefinite"></animate>\n' + '  </rect>\n' + '</g><g transform="rotate(30 50 50)">\n' + '  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#335eea">\n' + '    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.8333333333333334s" repeatCount="indefinite"></animate>\n' + '  </rect>\n' + '</g><g transform="rotate(60 50 50)">\n' + '  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#335eea">\n' + '    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.75s" repeatCount="indefinite"></animate>\n' + '  </rect>\n' + '</g><g transform="rotate(90 50 50)">\n' + '  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#335eea">\n' + '    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.6666666666666666s" repeatCount="indefinite"></animate>\n' + '  </rect>\n' + '</g><g transform="rotate(120 50 50)">\n' + '  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#335eea">\n' + '    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5833333333333334s" repeatCount="indefinite"></animate>\n' + '  </rect>\n' + '</g><g transform="rotate(150 50 50)">\n' + '  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#335eea">\n' + '    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5s" repeatCount="indefinite"></animate>\n' + '  </rect>\n' + '</g><g transform="rotate(180 50 50)">\n' + '  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#335eea">\n' + '    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.4166666666666667s" repeatCount="indefinite"></animate>\n' + '  </rect>\n' + '</g><g transform="rotate(210 50 50)">\n' + '  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#335eea">\n' + '    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.3333333333333333s" repeatCount="indefinite"></animate>\n' + '  </rect>\n' + '</g><g transform="rotate(240 50 50)">\n' + '  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#335eea">\n' + '    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.25s" repeatCount="indefinite"></animate>\n' + '  </rect>\n' + '</g><g transform="rotate(270 50 50)">\n' + '  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#335eea">\n' + '    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.16666666666666666s" repeatCount="indefinite"></animate>\n' + '  </rect>\n' + '</g><g transform="rotate(300 50 50)">\n' + '  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#335eea">\n' + '    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.08333333333333333s" repeatCount="indefinite"></animate>\n' + '  </rect>\n' + '</g><g transform="rotate(330 50 50)">\n' + '  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#335eea">\n' + '    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animate>\n' + '  </rect>\n' + '</g>\n' + '</svg>' + '</div>';

const Default = {
    source: '', source_method: 'GET', source_params: [], modalTarget: '', modalTitle: '',
}

class ModalForm {
    constructor(element, settings) {
        this._element = element;
        this._parseSettings(settings);
        this._init();
    }

    load() {
        this.modal.show();
        this._updateModal();

        this._makeRequest();
    }

    // Private
    _init() {
        this._bindModal();
    }

    _makeRequest() {
        let type = typeof this._settings.source_method !== 'undefined' ? this._settings.source_method : 'GET';
        let params = typeof this._settings.source_params !== 'undefined' ? this._settings.source_params : [];

        let url = new URL(this._settings.source);
        url.searchParams.set('_format', "modal");

        $.ajax({
            type: type,
            url: url,
            data: params,
            beforeSend: function () {
                this._modalLoading();
            }.bind(this),
            success: function (data) {
                if (data === 'REFRESH') {
                    this._modalLoading();
                    location.reload();
                } else {
                    this.modalBody.html(data);
                    var form = this.modalBody.find("form");
                    form.submit(function () {
                        (new ModalForm(form)).load();
                        return false;
                    });
                }
            }.bind(this),
            error: function () {
                alert("failure");
            }
        });
    }

    _modalLoading() {
        this.modalBody.html(HTML_LOADING);
    }

    _parseSettings(settings) {
        settings.modalTarget = this._element.data('bs-target');

        // if element is a form
        if (this._element.attr('action')) {
            settings.source = this._element.attr('action');
            settings.source_method = this._element.attr('method');
            settings.source_params = $(this._element).serializeArray();
        }

        if (this._element.attr('href')) {
            settings.source = this._element.attr('href');
        }

        if (this._element.attr('data-href')) {
            settings.source = this._element.attr('data-href');
        }
        this._settings = $.extend({}, Default, settings)
    }

    _updateModal() {
        this.modalTitle.textContent = this._settings.modalTitle;
    }

    _bindModal() {
        this.modalContainer = $(this._settings.modalTarget);

        console.log(this.modalContainer);
        console.log(this);

        this.modalTitle = this.modalContainer.find('.modal-title')
        this.modalBody = this.modalContainer.find('.modal-body')

        this.modal = new Modal(this.modalContainer);

        this.modalContainer.on('hidden.bs.modal', function () {
            location.reload();
        });
    }

    // Static
    static _jQueryInterface(config) {
        let element = $(this);

        let data = element.data(DATA_KEY)
        const _options = $.extend({}, Default, element.data())

        if (!data) {
            data = new ModalForm(element, _options)
            element.data(DATA_KEY, typeof config === 'string' ? data : config)
        }

        if (typeof config === 'string' && /load/.test(config)) {
            data[config]()
        }
    }
}

/**
 * Data API
 * ====================================================
 */
$(document).on('click submit', SELECTOR_DATA_TOGGLE, function (event) {
    if (event) {
        event.preventDefault()
    }

    ModalForm._jQueryInterface.call($(this), 'load')
});

/**
 * jQuery API
 * ====================================================
 */
$.fn[NAME] = ModalForm._jQueryInterface
$.fn[NAME].Constructor = ModalForm
$.fn[NAME].noConflict = function () {
    $.fn[NAME] = JQUERY_NO_CONFLICT
    return ModalForm._jQueryInterface
}

export default ModalForm
