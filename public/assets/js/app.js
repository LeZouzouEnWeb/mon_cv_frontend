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
      const indicators = this.container.querySelectorAll("[data-indicator]");
      indicators.forEach((i) => i.classList.remove("active"));
      const targetTab = Array.from(this.tabs).find((t) => t.dataset.tab === tabId);
      const targetPanel = Array.from(this.panels).find((p) => p.dataset.panel === tabId);
      const targetIndicator = Array.from(indicators).find((i) => i.dataset.indicator === tabId);
      if (targetTab && targetPanel) {
        targetTab.classList.add("tab-active");
        targetPanel.classList.remove("hidden");
        targetPanel.classList.add("animate-fade-in");
        if (targetIndicator) {
          targetIndicator.classList.add("active");
        }
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
  function showConfirmationModal(type, title, message) {
    const confirmModal = document.getElementById("confirmation-modal");
    const contactModal = document.getElementById("contact-modal");
    const iconDiv = document.getElementById("confirmation-icon");
    const titleDiv = document.getElementById("confirmation-title");
    const messageDiv = document.getElementById("confirmation-message");
    const closeBtn = document.getElementById("confirmation-modal-close");
    const overlay = confirmModal?.querySelector(".modal-overlay");
    if (!confirmModal)
      return;
    if (type === "success") {
      iconDiv.className = "mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10";
      iconDiv.innerHTML = '<i class="fas fa-check text-green-600 text-xl"></i>';
    } else {
      iconDiv.className = "mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10";
      iconDiv.innerHTML = '<i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>';
    }
    titleDiv.textContent = title;
    messageDiv.textContent = message;
    contactModal?.classList.add("hidden");
    confirmModal.classList.remove("hidden");
    document.body.style.overflow = "hidden";
    const closeConfirmModal = () => {
      confirmModal.classList.add("hidden");
      document.body.style.overflow = "";
    };
    closeBtn?.addEventListener("click", closeConfirmModal, { once: true });
    overlay?.addEventListener("click", closeConfirmModal, { once: true });
    const handleEscape = (e) => {
      if (e.key === "Escape" && !confirmModal.classList.contains("hidden")) {
        closeConfirmModal();
        document.removeEventListener("keydown", handleEscape);
      }
    };
    document.addEventListener("keydown", handleEscape);
  }
  function initContactModal() {
    const modal = document.getElementById("contact-modal");
    const openBtns = [
      document.getElementById("contact-modal-btn"),
      document.getElementById("contact-modal-btn-mobile")
    ];
    const closeBtn = document.getElementById("contact-modal-close");
    const overlay = modal?.querySelector(".modal-overlay");
    const form = document.getElementById("contact-form");
    if (!modal)
      return;
    openBtns.forEach((btn) => {
      btn?.addEventListener("click", (e) => {
        e.preventDefault();
        modal.classList.remove("hidden");
        document.body.style.overflow = "hidden";
      });
    });
    const closeModal = () => {
      modal.classList.add("hidden");
      document.body.style.overflow = "";
    };
    closeBtn?.addEventListener("click", closeModal);
    overlay?.addEventListener("click", closeModal);
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && !modal.classList.contains("hidden")) {
        closeModal();
      }
    });
    form?.addEventListener("submit", async (e) => {
      e.preventDefault();
      const submitBtn = form.querySelector('button[type="submit"]');
      const formData = new FormData(form);
      let turnstileResponse = document.querySelector('[name="cf-turnstile-response"]')?.value;
      if (!turnstileResponse) {
        await new Promise((resolve) => setTimeout(resolve, 500));
        turnstileResponse = document.querySelector('[name="cf-turnstile-response"]')?.value;
      }
      if (!turnstileResponse) {
        showConfirmationModal("error", "Erreur", "Veuillez patienter que la v\xE9rification de s\xE9curit\xE9 se charge, puis r\xE9essayez.");
        return;
      }
      const data = {
        name: formData.get("name"),
        email: formData.get("email"),
        message: formData.get("message"),
        "cf-turnstile-response": turnstileResponse
      };
      const originalBtnText = submitBtn.innerHTML;
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Envoi en cours...';
      try {
        const response = await fetch("/contact-send.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify(data)
        });
        const result = await response.json();
        if (result.success) {
          form.reset();
          if (window.turnstile) {
            window.turnstile.reset();
          }
          showConfirmationModal("success", "Message envoy\xE9 !", result.message);
        } else {
          let errorMsg = result.message;
          if (result.errors) {
            errorMsg += "\n\n" + Object.values(result.errors).join("\n");
          }
          if (window.turnstile) {
            window.turnstile.reset();
          }
          showConfirmationModal("error", "Erreur", errorMsg);
        }
      } catch (error) {
        console.error("Error sending message:", error);
        if (window.turnstile) {
          window.turnstile.reset();
        }
        showConfirmationModal("error", "Erreur", "Une erreur est survenue lors de l'envoi du message. Veuillez v\xE9rifier votre connexion et r\xE9essayer.");
      } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnText;
      }
    });
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
    initContactModal();
    document.body.classList.add("animate-fade-in");
  });
})();
