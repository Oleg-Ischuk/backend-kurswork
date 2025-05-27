<style>
    .cart-container {
        padding: 2rem 0;
    }

    .cart-header {
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 2rem;
        font-weight: 600;
        color: #2d3748;
    }

    /* ✅ ПОКРАЩЕНІ СТИЛІ ДЛЯ КОШИКА */
    .cart-items-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .cart-item {
        display: grid;
        grid-template-columns: 100px 120px auto auto auto auto;
        gap: 1.5rem;
        align-items: center;
        padding: 15px;
        border-bottom: 1px solid #f1f5f9;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, white 0%, #fafafa 100%);
    }

    .cart-item:hover {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        transform: translateX(5px);
        /* box-shadow: inset 4px 0 0 #0d6efd; */
    }

    .cart-item:last-child {
        border-bottom: none;
        border-radius: 0 0 1rem 1rem;
    }

    /* Покращена картинка в кошику */
    .cart-item-image {
        width: 100px;
        height: 100px;
        object-fit: contain;
        border-radius: 0.75rem;
        padding: 0.5rem;
        background: white;
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .cart-item:hover .cart-item-image {
        border-color: #0d6efd;
        transform: scale(1.05);
        box-shadow: 0 4px 16px rgba(13, 110, 253, 0.2);
    }

    /* Інформація про товар */
    .cart-item-info {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .cart-item-name {
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: #1a202c;
        font-size: 1.1rem;
        line-height: 1.3;
    }

    .cart-item-category {
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 500;
        padding: 0.25rem 0.5rem;
        background: #f8f9fa;
        border-radius: 0.5rem;
        width: fit-content;
    }

    /* Ціна товару */
    .cart-item-price {
        font-weight: 700;
        color: #0d6efd;
        font-size: 1.2rem;
        text-align: center;
        padding: 0.5rem;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 0.5rem;
        min-width: 80px;
    }

    /* Покращені контроли кількості */
    .quantity-controls {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        border: 2px solid #e2e8f0;
        border-radius: 0.75rem;
        overflow: hidden;
        background: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .quantity-btn {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border: none;
        padding: 0.75rem;
        cursor: pointer;
        color: #495057;
        transition: all 0.2s ease;
        font-weight: 600;
        font-size: 1rem;
        width: 40px;
        height: 40px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .quantity-btn:hover {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        color: white;
        transform: scale(1.1);
    }

    .quantity-input {
        border: none;
        text-align: center;
        width: 60px;
        padding: 0.75rem 0.5rem;
        font-weight: 600;
        font-size: 1rem;
        background: white;
    }

    .quantity-input:focus {
        outline: none;
        background: #f8f9fa;
    }

    .stock-info {
        color: #6c757d;
        font-size: 0.8rem;
        margin-top: 0.5rem;
        text-align: center;
        font-weight: 500;
    }

    /* Субтотал */
    .item-subtotal {
        font-weight: 800;
        color: #0d6efd;
        font-size: 14px;
        text-align: center;
        padding: 10px;
        background: linear-gradient(135deg, rgba(13, 110, 253, 0.1), rgba(13, 110, 253, 0.05));
        border-radius: 5px;
        min-width: 100px;
        border: 2px solid rgba(13, 110, 253, 0.2);
    }

    /* Кнопка видалення */
    .remove-btn {
        background: linear-gradient(135deg, transparent, rgba(220, 53, 69, 0.1));
        border: 2px solid #dc3545;
        color: #dc3545;
        padding: 0.75rem;
        border-radius: 0.75rem;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }

    .remove-btn:hover {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
        transform: scale(1.1) rotate(-5deg);
        box-shadow: 0 6px 20px rgba(220, 53, 69, 0.3);
    }

    .continue-shopping {
        margin-top: 1.5rem;
    }

    .continue-shopping-btn {
        background: transparent;
        border: 1px solid #0d6efd;
        color: #0d6efd;
        padding: 0.75rem 1.5rem;
        border-radius: 0.375rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
    }

    .continue-shopping-btn:hover {
        background: #0d6efd;
        color: white;
    }

    /* Покращений підсумок замовлення */
    .order-summary-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.12);
        overflow: hidden;
    }

    .order-summary-header {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        padding: 1.5rem;
        border-bottom: none;
        border-radius: 1rem 1rem 0 0;
    }

    .order-summary-header h5 {
        color: white;
        margin: 0;
        font-weight: 700;
        font-size: 1.2rem;
        text-align: center;
    }

    .order-summary-body {
        padding: 2rem;
        background: linear-gradient(180deg, white 0%, #fafafa 100%);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        padding: 0.5rem 0;
        font-weight: 500;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        font-weight: 800;
        font-size: 1.4rem;
        color: #0d6efd;
        padding: 1rem;
        border: 2px solid rgba(13, 110, 253, 0.2);
        background: linear-gradient(135deg, rgba(13, 110, 253, 0.1), rgba(13, 110, 253, 0.05));
        border-radius: 0.75rem;
        margin-top: 1rem;
    }

    .checkout-form {
        margin-top: 1.5rem;
    }

    .form-section-title {
        font-weight: 600;
        margin-bottom: 1rem;
        color: #2d3748;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
        color: #2d3748;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.375rem;
        font-size: 1rem;
        transition: border-color 0.2s;
    }

    .form-control:focus {
        border-color: #0d6efd;
        outline: none;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
    }

    /* Кнопка оформлення замовлення */
    .checkout-btn {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        border: none;
        padding: 1.2rem 1.5rem;
        border-radius: 0.75rem;
        width: 100%;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
    }

    .checkout-btn:hover {
        background: linear-gradient(135deg, #20c997, #28a745);
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(40, 167, 69, 0.4);
    }

    .login-required {
        text-align: center;
        padding: 1rem 0;
    }

    .login-required p {
        color: #718096;
        margin-bottom: 1rem;
    }

    .login-btn,
    .register-btn {
        padding: 0.75rem 1.5rem;
        border-radius: 0.375rem;
        text-decoration: none;
        font-weight: 500;
        width: 100%;
        display: block;
        text-align: center;
        margin-bottom: 0.5rem;
        transition: all 0.2s;
    }

    .login-btn {
        background: #0d6efd;
        color: white;
        border: none;
    }

    .login-btn:hover {
        background: #0b5ed7;
        color: white;
    }

    .register-btn {
        background: transparent;
        color: #0d6efd;
        border: 1px solid #0d6efd;
    }

    .register-btn:hover {
        background: #0d6efd;
        color: white;
    }

    .empty-cart {
        text-align: center;
        padding: 4rem 0;
    }

    .empty-cart-icon {
        font-size: 5rem;
        color: #cbd5e0;
        margin-bottom: 2rem;
    }

    .empty-cart h3 {
        color: #2d3748;
        margin-bottom: 1rem;
    }

    .empty-cart p {
        color: #718096;
        margin-bottom: 2rem;
    }

    .start-shopping-btn {
        background: #0d6efd;
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 0.375rem;
        font-size: 1.1rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: background-color 0.2s;
    }

    .start-shopping-btn:hover {
        background: #0b5ed7;
        color: white;
    }

    .alert {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        padding: 1rem;
        border-radius: 0.375rem;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .alert.success {
        background-color: #198754;
    }

    .alert.danger {
        background-color: #dc3545;
    }

    .alert .close-btn {
        background: none;
        border: none;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
        padding: 0;
        margin-left: 1rem;
    }

    /* Адаптивність */
    @media (max-width: 768px) {
        .cart-item {
            grid-template-columns: 80px 1fr;
            gap: 1rem;
            text-align: center;
            padding: 1rem;
        }

        .cart-item-image {
            width: 80px;
            height: 80px;
        }

        .quantity-controls {
            justify-self: center;
            margin: 0.5rem 0;
        }

        .cart-item-price,
        .item-subtotal {
            justify-self: center;
            margin: 0.25rem 0;
        }

        .remove-btn {
            justify-self: center;
            margin-top: 0.5rem;
        }
    }
</style>

<div class="container cart-container">
    <h2 class="cart-header"><i class="fas fa-shopping-cart"></i>Кошик</h2>

    <?php if (!empty($cartItems)): ?>
        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="cart-items-card">
                    <div class="card-body">
                        <?php foreach ($cartItems as $item): ?>
                            <div class="cart-item" data-product-id="<?= $item['id'] ?>">
                                <img src="<?= url($item['main_image'] ?? 'assets/images/no-image.jpg') ?>"
                                    class="cart-item-image" alt="<?= htmlspecialchars($item['name']) ?>">

                                <div class="cart-item-info">
                                    <div class="cart-item-name"><?= htmlspecialchars($item['name']) ?></div>
                                    <div class="cart-item-category"><?= htmlspecialchars($item['category_name']) ?></div>
                                </div>

                                <div class="cart-item-price"><?= number_format($item['price'], 2) ?> ₴</div>

                                <div>
                                    <div class="quantity-controls">
                                        <button class="quantity-btn" type="button" onclick="updateQuantity(<?= $item['id'] ?>, <?= $item['quantity'] - 1 ?>)">-</button>
                                        <input type="number" class="quantity-input"
                                            value="<?= $item['quantity'] ?>" min="1" max="<?= $item['stock'] ?>"
                                            onchange="updateQuantity(<?= $item['id'] ?>, this.value)">
                                        <button class="quantity-btn" type="button" onclick="updateQuantity(<?= $item['id'] ?>, <?= $item['quantity'] + 1 ?>)">+</button>
                                    </div>
                                    <div class="stock-info">Макс: <?= $item['stock'] ?></div>
                                </div>

                                <div class="item-subtotal"><?= number_format($item['subtotal'], 2) ?> ₴</div>

                                <button class="remove-btn" onclick="removeFromCart(<?= $item['id'] ?>)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Continue Shopping -->
                <div class="continue-shopping">
                    <a href="<?= url('products') ?>" class="continue-shopping-btn">
                        <i class="fas fa-arrow-left"></i>Продовжити покупки
                    </a>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="order-summary-card">
                    <div class="order-summary-header">
                        <h5>Підсумок замовлення</h5>
                    </div>
                    <div class="order-summary-body">
                        <div class="summary-row">
                            <span>Товарів:</span>
                            <span id="itemsCount"><?= count($cartItems) ?></span>
                        </div>
                        <div class="summary-row">
                            <span>Сума:</span>
                            <span id="cartTotal"><?= number_format($cartTotal, 2) ?> ₴</span>
                        </div>
                        <div class="summary-total">
                            <span>До сплати:</span>
                            <span id="finalTotal"><?= number_format($cartTotal, 2) ?> ₴</span>
                        </div>

                        <?php if (isset($_SESSION['user_id'])): ?>
                            <!-- Checkout Form -->
                            <form method="POST" action="<?= url('checkout') ?>" id="checkoutForm" class="checkout-form">
                                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

                                <h6 class="form-section-title">Адреса доставки:</h6>

                                <div class="form-group">
                                    <label for="address" class="form-label">Адреса *</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                </div>

                                <div class="form-group">
                                    <label for="city" class="form-label">Місто *</label>
                                    <input type="text" class="form-control" id="city" name="city" required>
                                </div>

                                <div class="form-group">
                                    <label for="postal_code" class="form-label">Поштовий індекс *</label>
                                    <input type="text" class="form-control" id="postal_code" name="postal_code" required>
                                </div>

                                <button type="submit" class="checkout-btn">
                                    <i class="fas fa-credit-card"></i>Оформити замовлення
                                </button>
                            </form>
                        <?php else: ?>
                            <!-- Login Required -->
                            <div class="login-required">
                                <p>Для оформлення замовлення необхідно увійти в систему</p>
                                <a href="<?= url('login') ?>" class="login-btn">Увійти</a>
                                <a href="<?= url('register') ?>" class="register-btn">Зареєструватися</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>
        <!-- Empty Cart -->
        <div class="empty-cart">
            <i class="fas fa-shopping-cart empty-cart-icon"></i>
            <h3>Ваш кошик порожній</h3>
            <p>Додайте товари до кошика, щоб продовжити покупки</p>
            <a href="<?= url('products') ?>" class="start-shopping-btn">
                <i class="fas fa-shopping-bag"></i>Почати покупки
            </a>
        </div>
    <?php endif; ?>
</div>

<script>
    // CSRF token for AJAX requests
    window.csrfToken = '<?= $csrf_token ?? '' ?>';

    // Update quantity
    function updateQuantity(productId, quantity) {
        if (quantity < 1) {
            removeFromCart(productId);
            return;
        }

        const formData = new FormData();
        formData.append('product_id', productId);
        formData.append('quantity', quantity);
        formData.append('csrf_token', window.csrfToken);

        fetch('<?= url('cart/update') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    location.reload();
                } else {
                    showAlert('danger', 'Помилка при оновленні кошика');
                }
            })
            .catch(error => {
                showAlert('danger', 'Помилка при оновленні кошика');
            });
    }

    // Remove from cart
    function removeFromCart(productId) {
        if (!confirm('Видалити товар з кошика?')) {
            return;
        }

        fetch('<?= url('cart/remove') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `product_id=${productId}&csrf_token=${window.csrfToken}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove item from DOM
                    const itemRow = document.querySelector(`[data-product-id="${productId}"]`);
                    if (itemRow) {
                        itemRow.remove();
                    }

                    // Update totals
                    updateCartTotals();

                    // Update cart count in header
                    const cartCount = document.getElementById('cartCount');
                    if (cartCount) {
                        cartCount.textContent = data.cartCount;
                    }

                    showAlert('success', data.message);

                    // Reload if cart is empty
                    if (data.cartCount === 0) {
                        setTimeout(() => location.reload(), 1000);
                    }
                } else {
                    showAlert('danger', data.message);
                }
            })
            .catch(error => {
                showAlert('danger', 'Помилка при видаленні товару');
            });
    }

    // Update cart totals
    function updateCartTotals() {
        let total = 0;
        let itemsCount = 0;

        document.querySelectorAll('.item-subtotal').forEach(element => {
            const subtotal = parseFloat(element.textContent.replace(/[^\d.]/g, ''));
            total += subtotal;
            itemsCount++;
        });

        document.getElementById('itemsCount').textContent = itemsCount;
        document.getElementById('cartTotal').textContent = total.toFixed(2) + ' ₴';
        document.getElementById('finalTotal').textContent = total.toFixed(2) + ' ₴';
    }

    // Show alert
    function showAlert(type, message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert ${type}`;
        alertDiv.innerHTML = `
        <span>${message}</span>
        <button class="close-btn" onclick="this.parentElement.remove()">&times;</button>
    `;

        document.body.appendChild(alertDiv);

        // Auto remove after 5 seconds
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }
</script>