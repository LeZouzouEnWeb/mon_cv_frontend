(() => {
  // resources/js/app.js
  var TabsManager = class {
    constructor(container) {
      this.container = container;
      this.tabs = container.querySelectorAll("[data-tab]");
      this.panels = container.querySelectorAll("[data-panel]");
      this.init();
    }
    init() {
      this.tabs.forEach((tab) => {
        tab.addEventListener("click", (e) => {
          e.preventDefault();
          const targetId = tab.dataset.tab;
          this.activateTab(targetId);
          const url = new URL(window.location);
          url.searchParams.set("tab", targetId);
          window.history.pushState({}, "", url);
        });
      });
      const urlParams = new URLSearchParams(window.location.search);
      const activeTab = urlParams.get("tab");
      if (activeTab) {
        this.activateTab(activeTab);
      } else if (this.tabs.length > 0) {
        this.activateTab(this.tabs[0].dataset.tab);
      }
      window.addEventListener("popstate", () => {
        const urlParams2 = new URLSearchParams(window.location.search);
        const activeTab2 = urlParams2.get("tab");
        if (activeTab2) {
          this.activateTab(activeTab2);
        }
      });
    }
    activateTab(tabId) {
      this.tabs.forEach((t) => t.classList.remove("tab-active"));
      this.panels.forEach((p) => {
        p.classList.add("hidden");
        p.classList.remove("animate-fade-in");
      });
      const targetTab = Array.from(this.tabs).find((t) => t.dataset.tab === tabId);
      const targetPanel = Array.from(this.panels).find((p) => p.dataset.panel === tabId);
      if (targetTab && targetPanel) {
        targetTab.classList.add("tab-active");
        targetPanel.classList.remove("hidden");
        targetPanel.classList.add("animate-fade-in");
      }
    }
  };
  var LoaderManager = class {
    constructor() {
      this.loader = document.getElementById("loader");
    }
    show() {
      if (this.loader) {
        this.loader.classList.remove("hidden");
      }
    }
    hide() {
      if (this.loader) {
        this.loader.classList.add("hidden");
      }
    }
  };
  function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
      anchor.addEventListener("click", function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute("href"));
        if (target) {
          target.scrollIntoView({
            behavior: "smooth",
            block: "start"
          });
        }
      });
    });
  }
  function initMobileMenu() {
    const menuToggle = document.getElementById("mobile-menu-toggle");
    const mobileMenu = document.getElementById("mobile-menu");
    if (menuToggle && mobileMenu) {
      menuToggle.addEventListener("click", () => {
        mobileMenu.classList.toggle("hidden");
      });
    }
  }
  function initPrintButton() {
    const printBtn = document.getElementById("print-btn");
    if (printBtn) {
      printBtn.addEventListener("click", () => {
        window.print();
      });
    }
  }
  function initExternalLinks() {
    document.querySelectorAll('a[href^="http"]').forEach((link) => {
      if (!link.hostname.includes(window.location.hostname)) {
        link.setAttribute("target", "_blank");
        link.setAttribute("rel", "noopener noreferrer");
      }
    });
  }
  function initLazyLoading() {
    if ("loading" in HTMLImageElement.prototype) {
      const images = document.querySelectorAll('img[loading="lazy"]');
      images.forEach((img) => {
        img.src = img.dataset.src || img.src;
      });
    } else {
      const script = document.createElement("script");
      script.src = "https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js";
      document.body.appendChild(script);
    }
  }
  document.addEventListener("DOMContentLoaded", () => {
    const tabsContainer = document.querySelector('[data-tabs-container]:not([data-tabs-container="cv-documents"])');
    if (tabsContainer) {
      new TabsManager(tabsContainer);
    }
    const cvTabsContainer = document.querySelector('[data-tabs-container="cv-documents"]');
    if (cvTabsContainer) {
      new TabsManager(cvTabsContainer);
    }
    const loader = new LoaderManager();
    loader.hide();
    initSmoothScroll();
    initMobileMenu();
    initPrintButton();
    initExternalLinks();
    initLazyLoading();
    document.body.classList.add("animate-fade-in");
  });
})();
