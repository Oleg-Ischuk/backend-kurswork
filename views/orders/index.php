<?php
function getStatusColor($status) {
    switch ($status) {
        case 'pending': return 'warning';
        case 'processing': return 'info';
        case 'shipped': return 'primary';
        case 'delivered': return 'success';
        case 'cancelled': return 'danger';
        default: return 'secondary';
    }
}

function getStatusText($status) {
    switch ($status) {
        case 'pending': return 'Очікує обробки';
        case 'processing': return 'Обробляється';
        case 'shipped': return 'Відправлено';
        case 'delivered': return 'Доставлено';
        case 'cancelled': return 'Скасовано';
        default: return 'Невідомо';
    }
}
?>

<style>
.orders-container {
    padding: 2rem 0;
}

.orders-header {
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.orders-title {
    font-size: 2rem;
    font-weight: 600;
    color: #2d3748;
    margin: 0;
}

.clear-orders-btn {
    background: #dc3545;
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 0.375rem;
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.clear-orders-btn:hover {
    background: #c82333;
    transform: translateY(-1px);
    box-shadow: 0 0.25rem 0.5rem rgba(220, 53, 69, 0.3);
}

.order-card {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 0.75rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    margin-bottom: 1.5rem;
    transition: all 0.2s;
}

.order-card:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.order-card-header {
    background: #f8f9fa;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #e2e8f0;
    border-radius: 0.75rem 0.75rem 0 0;
}

.order-header-row {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    gap: 1rem;
    align-items: center;
}

.order-id {
    font-weight: 600;
    color: #2d3748;
    font-size: 1.1rem;
}

.order-date {
    color: #718096;
    font-size: 0.95rem;
}

.status-badge {
    padding: 0.375rem 0.75rem;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    font-weight: 600;
    color: white;
    text-align: center;
}

.status-badge.warning {
    background-color: #ffc107;
    color: #000;
}

.status-badge.info {
    background-color: #0dcaf0;
    color: #000;
}

.status-badge.primary {
    background-color: #0d6efd;
}

.status-badge.success {
    background-color: #198754;
}

.status-badge.danger {
    background-color: #dc3545;
}

.status-badge.secondary {
    background-color: #6c757d;
}

.order-total {
    font-weight: 700;
    color: #0d6efd;
    font-size: 1.1rem;
    text-align: right;
}

.order-card-body {
    padding: 1.5rem;
}

.order-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
}

.order-items-section h6 {
    font-weight: 600;
    margin-bottom: 1rem;
    color: #2d3748;
}

.order-item {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #f1f5f9;
}

.order-item:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.item-image {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 0.375rem;
    margin-right: 1rem;
    flex-shrink: 0;
}

.item-details {
    flex: 1;
}

.item-name {
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 0.25rem;
    font-size: 0.95rem;
}

.item-quantity-price {
    color: #718096;
    font-size: 0.875rem;
}

.item-total {
    font-weight: 600;
    color: #2d3748;
    text-align: right;
}

.shipping-section h6 {
    font-weight: 600;
    margin-bottom: 1rem;
    color: #2d3748;
}

.shipping-address {
    color: #4a5568;
    line-height: 1.5;
    margin-bottom: 1.5rem;
}

.shipping-address p {
    margin-bottom: 0.25rem;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.view-details-btn {
    background: transparent;
    color: #0d6efd;
    border: 1px solid #0d6efd;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    font-size: 0.9rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    flex: 1;
    justify-content: center;
}

.view-details-btn:hover {
    background: #0d6efd;
    color: white;
}

.delete-order-btn {
    background: #dc3545;
    color: white;
    border: none;
    padding: 0.5rem;
    border-radius: 0.375rem;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
}

.delete-order-btn:hover {
    background: #c82333;
    transform: scale(1.05);
}

.empty-state {
    text-align: center;
    padding: 4rem 0;
}

.empty-state-icon {
    font-size: 5rem;
    color: #cbd5e0;
    margin-bottom: 2rem;
}

.empty-state h3 {
    color: #2d3748;
    margin-bottom: 1rem;
    font-weight: 600;
}

.empty-state p {
    color: #718096;
    margin-bottom: 2rem;
    font-size: 1.1rem;
}

.start-shopping-btn {
    background: #0d6efd;
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 0.5rem;
    font-size: 1.1rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.start-shopping-btn:hover {
    background: #0b5ed7;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(13, 110, 253, 0.3);
}

/* Анімації для видалення */
.order-card.removing {
    opacity: 0;
    transform: translateX(-100%);
    transition: all 0.3s ease-out;
}

@media (max-width: 768px) {
    .orders-header {
        flex-direction: column;
        align-items: stretch;
        gap: 1rem;
    }
    
    .order-header-row {
        grid-template-columns: 1fr;
        gap: 0.5rem;
        text-align: center;
    }
    
    .order-content {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .order-total {
        text-align: center;
    }
    
    .item-details {
        margin-right: 1rem;
    }
    
    .action-buttons {
        flex-direction: column;
    }
}

@media (max-width: 576px) {
    .orders-title {
        font-size: 1.5rem;
    }
    
    .order-item {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
    
    .item-image {
        margin-right: 0;
        margin-bottom: 0.5rem;
    }
    
    .item-details {
        margin-right: 0;
    }
}
</style>

<div class="container orders-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="orders-header">
            <i class="fas fa-box"></i>
            <span class="orders-title">Мої замовлення</span>
        </h2>
        
        <!-- ✅ КНОПКА ДЛЯ ОЧИЩЕННЯ ЗАВЕРШЕНИХ ЗАМОВЛЕНЬ -->
        <?php 
        $hasCompletedOrders = false;
        foreach ($orders as $order) {
            if (in_array($order['status'], ['delivered', 'cancelled'])) {
                $hasCompletedOrders = true;
                break;
            }
        }
        ?>
        
        <?php if ($hasCompletedOrders): ?>
        <button class="clear-orders-btn" onclick="clearCompletedOrders()">
            <i class="fas fa-trash-alt"></i> Очистити завершені
        </button>
        <?php endif; ?>
    </div>
    
    <?php if (!empty($orders)): ?>
    <div class="row">
        <?php foreach ($orders as $order): ?>
        <div class="col-12">
            <div class="order-card" data-order-id="<?= $order['id'] ?>" data-status="<?= $order['status'] ?>">
                <div class="order-card-header">
                    <div class="order-header-row">
                        <div class="order-id">Замовлення #<?= $order['id'] ?></div>
                        <div class="order-date">Дата: <?= date('d.m.Y H:i', strtotime($order['created_at'])) ?></div>
                        <div>
                            <span class="status-badge <?= getStatusColor($order['status']) ?>"><?= getStatusText($order['status']) ?></span>
                        </div>
                        <div class="order-total"><?= number_format($order['total_amount'], 2) ?> ₴</div>
                    </div>
                </div>
                <div class="order-card-body">
                    <div class="order-content">
                        <div class="order-items-section">
                            <h6>Товари:</h6>
                            <?php foreach ($order['items'] as $item): ?>
                            <div class="order-item">
                                <img src="<?= url($item['main_image'] ?? 'assets/images/no-image.jpg') ?>" 
                                     class="item-image" alt="<?= htmlspecialchars($item['product_name']) ?>">
                                <div class="item-details">
                                    <div class="item-name"><?= htmlspecialchars($item['product_name']) ?></div>
                                    <div class="item-quantity-price"><?= $item['quantity'] ?> шт. × <?= number_format($item['price'], 2) ?> ₴</div>
                                </div>
                                <div class="item-total"><?= number_format($item['quantity'] * $item['price'], 2) ?> ₴</div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="shipping-section">
                            <h6>Адреса доставки:</h6>
                            <div class="shipping-address">
                                <p><?= htmlspecialchars($order['shipping_address']) ?></p>
                                <p><?= htmlspecialchars($order['shipping_city']) ?></p>
                                <p><?= htmlspecialchars($order['shipping_postal_code']) ?></p>
                            </div>
                            
                            <div class="action-buttons">
                                <a href="<?= url('order/' . $order['id']) ?>" class="view-details-btn">
                                    <i class="fas fa-eye"></i>Детальніше
                                </a>
                                
                                <!-- ✅ КНОПКА ВИДАЛЕННЯ ДЛЯ ЗАВЕРШЕНИХ ЗАМОВЛЕНЬ -->
                                <?php if (in_array($order['status'], ['delivered', 'cancelled'])): ?>
                                <button class="delete-order-btn" onclick="deleteOrder(<?= $order['id'] ?>)" title="Видалити замовлення">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <?php else: ?>
    <!-- No orders -->
    <div class="empty-state">
        <i class="fas fa-box-open empty-state-icon"></i>
        <h3>У вас поки немає замовлень</h3>
        <p>Почніть покупки, щоб побачити свої замовлення тут</p>
        <a href="<?= url('products') ?>" class="start-shopping-btn">
            <i class="fas fa-shopping-bag"></i>Почати покупки
        </a>
    </div>
    <?php endif; ?>
</div>

<!-- ✅ JAVASCRIPT ДЛЯ ОЧИЩЕННЯ ЗАМОВЛЕНЬ -->
<script>
// CSRF token
window.csrfToken = '<?= $this->generateCsrfToken() ?>';

// Видалення одного замовлення
function deleteOrder(orderId) {
    if (!confirm('Ви впевнені, що хочете видалити це замовлення? Це дію не можна скасувати.')) {
        return;
    }
    
    fetch('<?= url('order/delete') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `order_id=${orderId}&csrf_token=${window.csrfToken}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Видаляємо картку замовлення з анімацією
            const orderCard = document.querySelector(`[data-order-id="${orderId}"]`);
            if (orderCard) {
                orderCard.classList.add('removing');
                setTimeout(() => {
                    orderCard.remove();
                    checkIfEmpty();
                    updateClearButton();
                }, 300);
            }
            
            showAlert('success', data.message);
        } else {
            showAlert('danger', data.message);
        }
    })
    .catch(error => {
        showAlert('danger', 'Помилка при видаленні замовлення');
    });
}

// Очищення всіх завершених замовлень
function clearCompletedOrders() {
    const completedOrders = document.querySelectorAll('[data-status="delivered"], [data-status="cancelled"]');
    const count = completedOrders.length;
    
    if (count === 0) {
        showAlert('info', 'Немає завершених замовлень для видалення');
        return;
    }
    
    if (!confirm(`Ви впевнені, що хочете видалити ВСІ завершені замовлення (${count} шт.)? Це дію не можна скасувати.`)) {
        return;
    }
    
    fetch('<?= url('orders/clear-completed') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `csrf_token=${window.csrfToken}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Видаляємо всі завершені замовлення з анімацією
            completedOrders.forEach((orderCard, index) => {
                setTimeout(() => {
                    orderCard.classList.add('removing');
                    setTimeout(() => {
                        orderCard.remove();
                        if (index === completedOrders.length - 1) {
                            checkIfEmpty();
                            updateClearButton();
                        }
                    }, 300);
                }, index * 100);
            });
            
            showAlert('success', `Видалено ${data.count} замовлень`);
        } else {
            showAlert('danger', data.message);
        }
    })
    .catch(error => {
        showAlert('danger', 'Помилка при очищенні замовлень');
    });
}

// Перевірка чи залишились замовлення
function checkIfEmpty() {
    const remainingOrders = document.querySelectorAll('.order-card:not(.removing)');
    if (remainingOrders.length === 0) {
        setTimeout(() => {
            location.reload();
        }, 500);
    }
}

// Оновлення видимості кнопки очищення
function updateClearButton() {
    const completedOrders = document.querySelectorAll('[data-status="delivered"]:not(.removing), [data-status="cancelled"]:not(.removing)');
    const clearBtn = document.querySelector('.clear-orders-btn');
    
    if (completedOrders.length === 0 && clearBtn) {
        clearBtn.style.display = 'none';
    }
}

// Показ повідомлень
function showAlert(type, message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        padding: 1rem;
        border-radius: 0.375rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    `;
    
    let bgColor = '#198754';
    if (type === 'danger') bgColor = '#dc3545';
    if (type === 'info') bgColor = '#0dcaf0';
    if (type === 'warning') bgColor = '#ffc107';
    
    alertDiv.style.backgroundColor = bgColor;
    alertDiv.style.color = 'white';
    
    alertDiv.innerHTML = `
        <span>${message}</span>
        <button type="button" class="btn-close btn-close-white" onclick="this.parentElement.remove()" style="margin-left: 1rem; background: none; border: none; color: white; font-size: 1.2rem; cursor: pointer;">&times;</button>
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