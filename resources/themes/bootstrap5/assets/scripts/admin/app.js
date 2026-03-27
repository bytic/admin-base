import $ from 'jquery';
import ModalForms from './ModalForm';

import {
    handleSlimScroll,
    handlePageContentView,
    handleTooltipPopoverActivation,
    handleScrollToTopButton,
    handleAfterPageLoadAddClass,
    handleIEFullHeightContent,
    handleUnlimitedTabsRender,
    handlePageScrollClass,
    handleAnimation,
} from './layout';
import {
    handleSidebarMenu,
    handleMobileSidebarToggle,
    handleSidebarMinify,
    handleSidebarMinifyFloatMenu,
    handleToggleNavProfile,
    handleSidebarScrollMemory,
    handleSidebarSearch,
    handleToggleNavbarSearch,
    handleClearSidebarSelection,
    handleClearSidebarMobileSelection,
} from './sidebar';
import {
    handleUnlimitedTopMenuRender,
    handleTopMenuSubMenu,
    handleMobileTopMenuSubMenu,
    handleTopMenuMobileToggle,
} from './top-menu';
import { handleDraggablePanel, handleLocalStorage, handlePanelAction, handleResetLocalStorage } from './panel';
import { handleThemePageStructureControl, handleThemePanelExpand } from './theme';
import { handleAjaxMode, handleClearPageOption, handleSetPageOption } from './ajax';

var App = (function () {
    var setting;
    var initialized = false;

    var appApi = {
        init: function (option) {
            if (option) {
                setting = option;
            }

            this.initLocalStorage();

            if (!initialized) {
                this.initSidebar();
                this.initTopMenu();
                this.initThemePanel();
                this.initPageLoad();

                if (setting && setting.ajaxMode) {
                    this.initAjax();
                }

                initialized = true;
            }

            this.initComponent();
        },
        settings: function (option) {
            if (option) {
                setting = option;
            }
        },
        initSidebar: function () {
            handleSidebarMenu();
            handleMobileSidebarToggle();
            handleSidebarMinify();
            handleSidebarMinifyFloatMenu();
            handleToggleNavProfile();
            handleToggleNavbarSearch();
            handleSidebarSearch();

            if (!setting || !setting.disableSidebarScrollMemory) {
                handleSidebarScrollMemory();
            }
        },
        initSidebarSelection: function () {
            handleClearSidebarSelection();
        },
        initSidebarMobileSelection: function () {
            handleClearSidebarMobileSelection();
        },
        initTopMenu: function () {
            handleUnlimitedTopMenuRender();
            handleTopMenuSubMenu();
            handleMobileTopMenuSubMenu();
            handleTopMenuMobileToggle();
        },
        initPageLoad: function () {
            handlePageContentView();
        },
        initComponent: function () {
            if (!setting || !setting.disableDraggablePanel) {
                handleDraggablePanel();
            }

            handleIEFullHeightContent();
            handleSlimScroll();
            handleUnlimitedTabsRender();
            handlePanelAction();
            handleScrollToTopButton();
            handleAfterPageLoadAddClass();
            handlePageScrollClass();
            handleAnimation();

            if ($(window).width() > 767) {
                handleTooltipPopoverActivation();
            }
        },
        initLocalStorage: function () {
            if (!setting || !setting.disableLocalStorage) {
                handleLocalStorage();
            }
        },
        initThemePanel: function () {
            handleThemePageStructureControl();
            handleThemePanelExpand();
            handleResetLocalStorage();
        },
        initAjax: function () {
            handleAjaxMode(setting, appApi);
            $.ajaxSetup({ cache: true });
        },
        setPageTitle: function (pageTitle) {
            document.title = pageTitle;
        },
        setPageOption: function (option) {
            handleSetPageOption(option);
        },
        clearPageOption: function (option) {
            handleClearPageOption(option);
        },
        restartGlobalFunction: function () {
            this.initLocalStorage();
            this.initTopMenu();
            this.initComponent();
        },
        scrollTop: function () {
            $('html, body').animate(
                {
                    scrollTop: $('body').offset().top,
                },
                0
            );
        },
        beforeCache: function () {
            this.initSidebarMobileSelection();
            $('#page-content-loader').remove();
            $('body').removeClass('page-content-loading panel-expand');
        },
    };

    return appApi;
})();

export { App, ModalForms };

