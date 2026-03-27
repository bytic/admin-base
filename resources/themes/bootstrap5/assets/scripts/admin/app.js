import $ from 'jquery';
import ModalForms from './ModalForm';

import { LayoutComponent } from './layout';
import { SidebarComponent } from './sidebar';
import { TopMenuComponent } from './top-menu';
import { PanelComponent } from './panel';
import { ThemeComponent } from './theme';
import { AjaxComponent, applyPageOption } from './ajax';

/**
 * App
 * ───
 * Central orchestrator. Registers feature components in its constructor and
 * dispatches lifecycle events to each of them.
 *
 * Public lifecycle events dispatched to components:
 *   onSetup(app)       – once on first init
 *   onInit(app)        – every App.init() / page navigation
 *   onBeforeCache(app) – before Turbo/Turbolinks snapshots the page
 *
 * Backward-compatible public API is preserved so existing call-sites
 * (App.init, App.setPageOption, App.restartGlobalFunction, …) keep working.
 */
class AppClass {
    constructor() {
        this._setting     = null;
        this._initialized = false;

        // Named component references (used by backward-compat delegation below)
        this._layout   = new LayoutComponent();
        this._sidebar  = new SidebarComponent();
        this._topMenu  = new TopMenuComponent();
        this._panel    = new PanelComponent();
        this._theme    = new ThemeComponent();
        this._ajax     = new AjaxComponent();

        /** @type {import('./base-component').BaseComponent[]} */
        this._components = [
            this._layout,
            this._sidebar,
            this._topMenu,
            this._panel,
            this._theme,
            this._ajax,
        ];
    }

    // ── component registry ────────────────────────────────────────────────────

    /**
     * Register an additional component at runtime.
     * onSetup will be called immediately if the app is already initialized.
     * @param {import('./base-component').BaseComponent} component
     */
    register(component) {
        this._components.push(component);
        if (this._initialized && typeof component.onSetup === 'function') {
            component.onSetup(this);
        }
    }

    // ── lifecycle dispatch ────────────────────────────────────────────────────

    _dispatch(event) {
        var app = this;
        this._components.forEach(function (c) {
            if (typeof c[event] === 'function') {
                c[event](app);
            }
        });
    }

    // ── core lifecycle ────────────────────────────────────────────────────────

    /**
     * Boot or re-boot the app (called on every page navigation).
     * @param {object} [option]  Optional settings object (see App.settings()).
     */
    init(option) {
        if (option) this._setting = option;

        if (!this._initialized) {
            this._dispatch('onSetup');
            this._initialized = true;
        }

        this._dispatch('onInit');
    }

    /**
     * Update runtime settings without triggering a full re-init.
     * @param {object} option
     */
    settings(option) {
        if (option) this._setting = option;
    }

    /**
     * Called before Turbo/Turbolinks caches the current page.
     */
    beforeCache() {
        this._dispatch('onBeforeCache');
    }

    // ── public API (backward-compatible) ─────────────────────────────────────

    get setting() { return this._setting; }

    /** Re-init all "per-navigation" DOM tasks. */
    initComponent() {
        this._dispatch('onInit');
    }

    /** Re-run sidebar setup (idempotent via off/on namespacing). */
    initSidebar() {
        this._sidebar.onSetup(this);
    }

    /** Clear active/expand classes on the sidebar. */
    initSidebarSelection() {
        this._sidebar.clearSelection();
    }

    /** Remove the mobile-toggled class from the page container. */
    initSidebarMobileSelection() {
        this._sidebar.clearMobileSelection();
    }

    /** Re-run top-menu setup and re-focus active item. */
    initTopMenu() {
        this._topMenu.setup(this);
    }

    /** Trigger the page-load fade-in sequence. */
    initPageLoad() {
        this._layout.onSetup(this);
    }

    /** Force re-init of theme-panel handlers. */
    initThemePanel() {
        this._theme.onSetup(this);
    }

    /** Bootstrap ajax mode (requires app.setting.ajaxMode to be truthy). */
    initAjax() {
        this._ajax.onSetup(this);
    }

    /**
     * Re-run localStorage, top-menu and all "per-navigation" tasks.
     * Mirrors the legacy restartGlobalFunction() call-site.
     */
    restartGlobalFunction() {
        this._panel.onInit(this);   // localStorage + draggable
        this._topMenu.setup(this);
        this._dispatch('onInit');
    }

    /**
     * Apply a set of page-structure CSS classes and optionally schedule
     * their removal before the next ajax navigation.
     * @param {object} option
     */
    setPageOption(option) {
        applyPageOption(option, true);
        if (option.clearOptionOnLeave) {
            this._ajax.scheduleOptionClear(option);
        }
    }

    /**
     * Remove previously applied page-structure CSS classes.
     * @param {object} option
     */
    clearPageOption(option) {
        applyPageOption(option, false);
    }

    setPageTitle(title) {
        document.title = title;
    }

    scrollTop() {
        $('html, body').animate({ scrollTop: $('body').offset().top }, 0);
    }
}

export const App = new AppClass();
export { ModalForms };
