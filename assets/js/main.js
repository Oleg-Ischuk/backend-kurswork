class SportStore {
  constructor() {
    this.csrfToken = "";
    this.init();
  }

  init() {
    this.initEventListeners();
    this.initAnimations();
    this.initTooltips();
    this.initCart();
  }

  initEventListeners() {
    // Add to cart buttons
    document.addEventListener("click", (e) => {
      if (e.target.classList.contains("add-to-cart")) {
        e.preventDefault();
        this.addToCart(e.target);
      }

      // Remove from cart
      if (e.target.classList.contains("remove-from-cart")) {
        e.preventDefault();
        this.removeFromCart(e.target);
      }

      // Update quantity
      if (e.target.classList.contains("update-quantity")) {
        this.updateQuantity(e.target);
      }
    });

    // Search form
    const searchForm = document.querySelector(".search-form");
    if (searchForm) {
      searchForm.addEventListener("submit", (e) => {
        const searchInput = searchForm.querySelector('input[name="search"]');
        if (!searchInput.value.trim()) {
          e.preventDefault();
          searchInput.focus();
        }
      });
    }

    // Newsletter form
    const newsletterForm = document.querySelector(".newsletter-form");
    if (newsletterForm) {
      newsletterForm.addEventListener("submit", (e) => {
        e.preventDefault();
        this.subscribeNewsletter(newsletterForm);
      });
    }
  }

  initAnimations() {
    // Animate elements on scroll
    const observerOptions = {
      threshold: 0.1,
      rootMargin: "0px 0px -50px 0px",
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("animate-fade-in-up");
        }
      });
    }, observerOptions);

    // Observe elements
    document
      .querySelectorAll(".feature-card, .product-card, .stats-card")
      .forEach((el) => {
        observer.observe(el);
      });
  }

  initTooltips() {
    // Initialize Bootstrap tooltips
    const tooltipTriggerList = [].slice.call(
      document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  }

  initCart() {
    this.updateCartCount();

    // Quantity controls
    document.addEventListener("click", (e) => {
      if (e.target.classList.contains("qty-btn")) {
        const input = e.target.parentNode.querySelector(".qty-input");
        const isIncrement = e.target.classList.contains("qty-increment");
        let value = parseInt(input.value) || 1;

        if (isIncrement) {
          value++;
        } else if (value > 1) {
          value--;
        }

        input.value = value;

        // Trigger change event
        input.dispatchEvent(new Event("change"));
      }
    });
  }

  async addToCart(button) {
    const productId = button.dataset.productId;
    const quantity = button.dataset.quantity || 1;

    try {
      button.disabled = true;
      button.innerHTML = '<span class="loading"></span> Додавання...';

      const response = await fetch("/cart/add", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `product_id=${productId}&quantity=${quantity}&csrf_token=${this.csrfToken}`,
      });

      const data = await response.json();

      if (data.success) {
        this.showNotification("success", "Товар додано до кошика!");
        this.updateCartCount();

        // Update button
        button.innerHTML = '<i class="fas fa-check me-1"></i> Додано';
        button.classList.remove("btn-primary");
        button.classList.add("btn-success");

        setTimeout(() => {
          button.innerHTML =
            '<i class="fas fa-shopping-cart me-1"></i> До кошика';
          button.classList.remove("btn-success");
          button.classList.add("btn-primary");
          button.disabled = false;
        }, 2000);
      } else {
        throw new Error(data.message || "Помилка при додаванні товару");
      }
    } catch (error) {
      this.showNotification("error", error.message);
      button.innerHTML = '<i class="fas fa-shopping-cart me-1"></i> До кошика';
      button.disabled = false;
    }
  }

  async removeFromCart(button) {
    const productId = button.dataset.productId;

    try {
      const response = await fetch("/cart/remove", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `product_id=${productId}&csrf_token=${this.csrfToken}`,
      });

      const data = await response.json();

      if (data.success) {
        this.showNotification("success", "Товар видалено з кошика");
        this.updateCartCount();

        // Remove item from DOM
        const cartItem = button.closest(".cart-item");
        if (cartItem) {
          cartItem.style.animation = "fadeOut 0.3s ease-out";
          setTimeout(() => cartItem.remove(), 300);
        }
      } else {
        throw new Error(data.message || "Помилка при видаленні товару");
      }
    } catch (error) {
      this.showNotification("error", error.message);
    }
  }

  async updateQuantity(input) {
    const productId = input.dataset.productId;
    const quantity = parseInt(input.value) || 1;

    try {
      const response = await fetch("/cart/update", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `product_id=${productId}&quantity=${quantity}&csrf_token=${this.csrfToken}`,
      });

      const data = await response.json();

      if (data.success) {
        this.updateCartCount();

        // Update item total
        const itemTotal = input
          .closest(".cart-item")
          .querySelector(".item-total");
        if (itemTotal && data.item_total) {
          itemTotal.textContent = data.item_total + " ₴";
        }

        // Update cart total
        const cartTotal = document.querySelector(".cart-total");
        if (cartTotal && data.cart_total) {
          cartTotal.textContent = data.cart_total + " ₴";
        }
      } else {
        throw new Error(data.message || "Помилка при оновленні кількості");
      }
    } catch (error) {
      this.showNotification("error", error.message);
    }
  }

  updateCartCount() {
    fetch("/cart/count")
      .then((response) => response.json())
      .then((data) => {
        const cartCount = document.getElementById("cartCount");
        if (cartCount) {
          cartCount.textContent = data.count || 0;

          if (data.count > 0) {
            cartCount.style.display = "inline-block";
          } else {
            cartCount.style.display = "none";
          }
        }
      })
      .catch((error) => console.error("Error updating cart count:", error));
  }

  async subscribeNewsletter(form) {
    const email = form.querySelector('input[name="email"]').value;
    const submitBtn = form.querySelector('button[type="submit"]');

    try {
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span class="loading"></span> Підписка...';

      const response = await fetch("/newsletter/subscribe", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `email=${encodeURIComponent(email)}&csrf_token=${this.csrfToken}`,
      });

      const data = await response.json();

      if (data.success) {
        this.showNotification("success", "Дякуємо за підписку!");
        form.reset();
      } else {
        throw new Error(data.message || "Помилка при підписці");
      }
    } catch (error) {
      this.showNotification("error", error.message);
    } finally {
      submitBtn.disabled = false;
      submitBtn.innerHTML = "Підписатися";
    }
  }

  showNotification(type, message) {
    // Remove existing notifications
    document.querySelectorAll(".notification").forEach((n) => n.remove());

    const notification = document.createElement("div");
    notification.className = `notification alert alert-${
      type === "success" ? "success" : "danger"
    } alert-dismissible fade show position-fixed`;
    notification.style.cssText =
      "top: 20px; right: 20px; z-index: 9999; min-width: 300px;";
    notification.innerHTML = `
            <i class="fas fa-${
              type === "success" ? "check-circle" : "exclamation-circle"
            } me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

    document.body.appendChild(notification);

    // Auto remove after 5 seconds
    setTimeout(() => {
      if (notification.parentNode) {
        notification.remove();
      }
    }, 5000);
  }

  // Utility methods
  formatPrice(price) {
    return new Intl.NumberFormat("uk-UA", {
      style: "currency",
      currency: "UAH",
    }).format(price);
  }

  debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
      const later = () => {
        clearTimeout(timeout);
        func(...args);
      };
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
    };
  }
}

// Initialize when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
  window.SportStore = new SportStore();
});

// Add CSS animation for fadeOut
const style = document.createElement("style");
style.textContent = `
    @keyframes fadeOut {
        from { opacity: 1; transform: translateX(0); }
        to { opacity: 0; transform: translateX(100%); }
    }
`;
document.head.appendChild(style);
