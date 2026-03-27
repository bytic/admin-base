import $ from 'jquery';
import ModalForms from './components/ModalForm';

import { LayoutComponent } from './components/layout';
import { SidebarComponent } from './components/sidebar';
import { TopMenuComponent } from './components/top-menu';
import { PanelComponent } from './components/panel';
import { ThemeComponent } from './components/theme';
import { AjaxComponent, applyPageOption } from './components/ajax';

/**
 * ByticAdminApp
 * ─────────────
 * Central orchestrator. Components are injected through register() — the
 * constructor holds no named component references of its own.
 *
 * Lifecycle events dispatched to every registered component:
 *   onSetup(app)       – once on first App.init()
 *   onInit(app)        – every App.init() / page navigation
 *   onBeforeCache(app) – before Turbo/Turbolinks snapshots the page
 */
class ByticAdminApp {
    constructor() {
        this._setting     = null;
        this._initialized = false;
        this._components  = [];

        // Inject built-in components through the public register() API.
        // Order matters: layout first so the page fade-in fires before sidebar
        // and panel DOM work runs.
        this
            .register(new LayoutComponent())
            .register(new SidebarComponent())
            .register(new TopMenuComponent())
            .register(new PanelComponent())
            .register(new ThemeComponent())
            .register(new AjaxComponent());
    }

    // ── component registry ────────────────────────────────────────────────────

    /**
     * Add a component to the registry.
     * If the app is already initialised onSetup is called immediately.
     * Returns `this` for fluent chaining.
     * @param {import('./components/base-component').BaseComponent} component
     * @returns {ByticAdminApp}
     */
    register(component) {
        this._components.push(component);
        if (this._initialized && typeof component.onSetup === 'function') {
            component.onSetup(this);
        }
        return this;
    }

    /**
     * Find the first registered component that is an instance of the given
     * class. Used internally so backward-compat methods can reach specific
     * component APIs without storing named properties.
     * @template T
     * @param {new (...args: any[]) => T} ComponentClass
     * @returns {T|undefined}
     */
    _find(ComponentClass) {
        return this._components.find(function (c) {
            return c instanceof ComponentClass;
        });
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
     * @param {object} [option]
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

    /** Called before Turbo/Turbolinks caches the current page. */
    beforeCache() {
        this._dispatch('onBeforeCache');
    }

    // ── public API (backward-compatible) ─────────────────────────────────────

    get setting() { return this._setting; }

    /** Re-run all per-navigation DOM tasks. */
    initComponent() {
        this._dispatch('onInit');
    }

    /** Re-run sidebar setup (idempotent via namespaced off/on). */
    initSidebar() {
        this._find(SidebarComponent).onSetup(this);
    }

    /** Clear active/expand classes on the sidebar. */
    initSidebarSelection() {
        this._find(SidebarComponent).clearSelection();
    }

    /** Remove the mobile-toggled class from the page container. */
    initSidebarMobileSelection() {
        this._find(SidebarComponent).clearMobileSelection();
    }

    /** Re-run top-menu setup and re-focus the active item. */
    initTopMenu() {
        this._find(TopMenuComponent).setup(this);
    }

    /** Trigger the page-load fade-in sequence. */
    initPageLoad() {
        this._find(LayoutComponent).onSetup(this);
    }

    /** Force re-init of theme-panel handlers. */
    initThemePanel() {
        this._find(ThemeComponent).onSetup(this);
    }

    /** Bootstrap ajax-mode navigation (requires setting.ajaxMode). */
    initAjax() {
        this._find(AjaxComponent).onSetup(this);
    }

    /**
     * Re-run localStorage restore, top-menu render and all per-navigation tasks.
     * Mirrors the legacy restartGlobalFunction() call-site.
     */
    restartGlobalFunction() {
        this._find(PanelComponent).onInit(this);
        this._find(TopMenuComponent).setup(this);
        this._dispatch('onInit');
    }

    /**
     * Apply page-structure CSS classes; schedule their removal on the next
     * ajax navigation when option.clearOptionOnLeave is set.
     * @param {object} option
     */
    setPageOption(option) {
        applyPageOption(option, true);
        if (option.clearOptionOnLeave) {
            this._find(AjaxComponent).scheduleOptionClear(option);
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

export const App = new ByticAdminApp();
export { ModalForms };
