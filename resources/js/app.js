// Main JavaScript Application

/**
 * Tabs Management
 */
class TabsManager {
  constructor(container) {
    this.container = container;
    this.tabs = container.querySelectorAll('[data-tab]');
    this.panels = container.querySelectorAll('[data-panel]');
    this.init();
  }

  init() {
    this.tabs.forEach(tab => {
      tab.addEventListener('click', (e) => {
        e.preventDefault();
        const targetId = tab.dataset.tab;
        this.activateTab(targetId);

        // Update URL
        const url = new URL(window.location);
        url.searchParams.set('tab', targetId);
        window.history.pushState({}, '', url);
      });
    });

    // Activate tab from URL
    const urlParams = new URLSearchParams(window.location.search);
    const activeTab = urlParams.get('tab');
    if (activeTab) {
      this.activateTab(activeTab);
    } else if (this.tabs.length > 0) {
      this.activateTab(this.tabs[0].dataset.tab);
    }

    // Handle browser back/forward
    window.addEventListener('popstate', () => {
      const urlParams = new URLSearchParams(window.location.search);
      const activeTab = urlParams.get('tab');
      if (activeTab) {
        this.activateTab(activeTab);
      }
    });
  }

  activateTab(tabId) {
    // Deactivate all tabs and panels
    this.tabs.forEach(t => t.classList.remove('tab-active'));
    this.panels.forEach(p => {
      p.classList.add('hidden');
      p.classList.remove('animate-fade-in');
    });

    // Activate target tab and panel
    const targetTab = Array.from(this.tabs).find(t => t.dataset.tab === tabId);
    const targetPanel = Array.from(this.panels).find(p => p.dataset.panel === tabId);

    if (targetTab && targetPanel) {
      targetTab.classList.add('tab-active');
      targetPanel.classList.remove('hidden');
      targetPanel.classList.add('animate-fade-in');
    }
  }
}

/**
 * Loader Management
 */
class LoaderManager {
  constructor() {
    this.loader = document.getElementById('loader');
  }

  show() {
    if (this.loader) {
      this.loader.classList.remove('hidden');
    }
  }

  hide() {
    if (this.loader) {
      this.loader.classList.add('hidden');
    }
  }
}

/**
 * Smooth Scroll
 */
function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });
}

/**
 * Mobile Menu Toggle
 */
function initMobileMenu() {
  const menuToggle = document.getElementById('mobile-menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');

  if (menuToggle && mobileMenu) {
    menuToggle.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  }
}

/**
 * Print Button
 */
function initPrintButton() {
  const printBtn = document.getElementById('print-btn');
  if (printBtn) {
    printBtn.addEventListener('click', () => {
      window.print();
    });
  }
}

/**
 * External Links
 */
function initExternalLinks() {
  document.querySelectorAll('a[href^="http"]').forEach(link => {
    if (!link.hostname.includes(window.location.hostname)) {
      link.setAttribute('target', '_blank');
      link.setAttribute('rel', 'noopener noreferrer');
    }
  });
}

/**
 * Lazy Loading Images
 */
function initLazyLoading() {
  if ('loading' in HTMLImageElement.prototype) {
    const images = document.querySelectorAll('img[loading="lazy"]');
    images.forEach(img => {
      img.src = img.dataset.src || img.src;
    });
  } else {
    // Fallback for browsers that don't support lazy loading
    const script = document.createElement('script');
    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
    document.body.appendChild(script);
  }
}

/**
 * Contact Modal Management
 */
/**
 * Show confirmation modal
 */
function showConfirmationModal(type, title, message) {
  const confirmModal = document.getElementById('confirmation-modal');
  const contactModal = document.getElementById('contact-modal');
  const iconDiv = document.getElementById('confirmation-icon');
  const titleDiv = document.getElementById('confirmation-title');
  const messageDiv = document.getElementById('confirmation-message');
  const closeBtn = document.getElementById('confirmation-modal-close');
  const overlay = confirmModal?.querySelector('.modal-overlay');

  if (!confirmModal) return;

  // Configure icon and colors based on type
  if (type === 'success') {
    iconDiv.className = 'mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10';
    iconDiv.innerHTML = '<i class="fas fa-check text-green-600 text-xl"></i>';
  } else {
    iconDiv.className = 'mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10';
    iconDiv.innerHTML = '<i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>';
  }

  // Set content
  titleDiv.textContent = title;
  messageDiv.textContent = message;

  // Close contact modal and open confirmation modal
  contactModal?.classList.add('hidden');
  confirmModal.classList.remove('hidden');
  document.body.style.overflow = 'hidden';

  // Close confirmation modal
  const closeConfirmModal = () => {
    confirmModal.classList.add('hidden');
    document.body.style.overflow = '';
  };

  closeBtn?.addEventListener('click', closeConfirmModal, { once: true });
  overlay?.addEventListener('click', closeConfirmModal, { once: true });

  // Close on Escape key
  const handleEscape = (e) => {
    if (e.key === 'Escape' && !confirmModal.classList.contains('hidden')) {
      closeConfirmModal();
      document.removeEventListener('keydown', handleEscape);
    }
  };
  document.addEventListener('keydown', handleEscape);
}

/**
 * Initialize Contact Modal
 */
function initContactModal() {
  const modal = document.getElementById('contact-modal');
  const openBtns = [
    document.getElementById('contact-modal-btn'),
    document.getElementById('contact-modal-btn-mobile')
  ];
  const closeBtn = document.getElementById('contact-modal-close');
  const overlay = modal?.querySelector('.modal-overlay');
  const form = document.getElementById('contact-form');

  if (!modal) return;

  // Open modal
  openBtns.forEach(btn => {
    btn?.addEventListener('click', (e) => {
      e.preventDefault();
      modal.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    });
  });

  // Close modal
  const closeModal = () => {
    modal.classList.add('hidden');
    document.body.style.overflow = '';
  };

  closeBtn?.addEventListener('click', closeModal);
  overlay?.addEventListener('click', closeModal);

  // Close on Escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
      closeModal();
    }
  });

  // Handle form submission
  form?.addEventListener('submit', async (e) => {
    e.preventDefault();

    const submitBtn = form.querySelector('button[type="submit"]');
    const formData = new FormData(form);
    const data = {
      name: formData.get('name'),
      email: formData.get('email'),
      message: formData.get('message')
    };

    // Disable submit button
    const originalBtnText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Envoi en cours...';

    try {
      const response = await fetch('/contact-send.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
      });

      const result = await response.json();

      if (result.success) {
      // Success - show confirmation modal
        form.reset();
        showConfirmationModal('success', 'Message envoyé !', result.message);
      } else {
        // Error - show error modal
        let errorMsg = result.message;
        if (result.errors) {
          errorMsg += '\n\n' + Object.values(result.errors).join('\n');
        }
        showConfirmationModal('error', 'Erreur', errorMsg);
      }
    } catch (error) {
      console.error('Error sending message:', error);
      showConfirmationModal('error', 'Erreur', 'Une erreur est survenue lors de l\'envoi du message. Veuillez vérifier votre connexion et réessayer.');
    } finally {
      // Re-enable submit button
      submitBtn.disabled = false;
      submitBtn.innerHTML = originalBtnText;
    }
  });
}

/**
 * Initialize Application
 */
document.addEventListener('DOMContentLoaded', () => {
  // Initialize main Tabs
  const tabsContainer = document.querySelector('[data-tabs-container]:not([data-tabs-container="cv-documents"])');
  if (tabsContainer) {
    new TabsManager(tabsContainer);
  }

  // Initialize CV documents tabs
  const cvTabsContainer = document.querySelector('[data-tabs-container="cv-documents"]');
  if (cvTabsContainer) {
    new TabsManager(cvTabsContainer);
  }

  // Initialize Loader
  const loader = new LoaderManager();
  loader.hide(); // Hide loader when page is ready

  // Initialize features
  initSmoothScroll();
  initMobileMenu();
  initPrintButton();
  initExternalLinks();
  initLazyLoading();
  initContactModal();

  // Add fade-in animation to page
  document.body.classList.add('animate-fade-in');
});

// Export for use in other modules
export { TabsManager, LoaderManager };
