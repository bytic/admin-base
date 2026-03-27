/**
 * BaseComponent
 * ─────────────
 * Extend this class for every feature area.
 *
 * Lifecycle hooks (each receives the App instance as its sole argument):
 *
 *  onSetup(app)
 *    Called ONCE on the very first App.init().
 *    Register persistent event handlers here; they are not duplicated on
 *    subsequent navigations because they use jQuery event namespacing.
 *
 *  onInit(app)
 *    Called on EVERY App.init() / page navigation.
 *    Re-process the current DOM: activate slimscroll, tooltips, animations…
 *
 *  onBeforeCache(app)
 *    Called before Turbo / Turbolinks snapshots the page.
 *    Remove transient DOM state (loaders, open panels, mobile menus…).
 */
export class BaseComponent {
    // eslint-disable-next-line no-unused-vars
    onSetup(app) {}

    // eslint-disable-next-line no-unused-vars
    onInit(app) {}

    // eslint-disable-next-line no-unused-vars
    onBeforeCache(app) {}
}

