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
.order-container {
    padding: 2rem 0;
}

.breadcrumb {
    background: transparent;
    padding: 0;
    margin-bottom: 1.5rem;
}

.breadcrumb-item a {
    color: #0d6efd;
    text-decoration: none;
}

.breadcrumb-item.active {
    color: #6c757d;
}

.order-card {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    margin-bottom: 1.5rem;
}

.order-header {
    background: #f8f9fa;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #dee2e6;
    border-radius: 0.5rem 0.5rem 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.order-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin: 0;
    color: #2d3748;
}

.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    font-size: 1rem;
    font-weight: 600;
    color: white;
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

.order-body {
    padding: 1.5rem;
}

.order-info-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-bottom: 1rem;
}

.info-group h6 {
    font-weight: 600;
    margin-bottom: 1rem;
    color: #2d3748;
}

.info-group p {
    margin-bottom: 0.5rem;
    color: #4a5568;
}

.info-group strong {
    color: #2d3748;
}

.items-card {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.items-header {
    background: #f8f9fa;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #dee2e6;
    border-radius: 0.5rem 0.5rem 0 0;
}

.items-header h5 {
    margin: 0;
    font-weight: 600;
    color: #2d3748;
}

.items-body {
    padding: 1.5rem;
}

.order-item {
    display: grid;
    grid-template-columns: 80px 1fr auto auto auto;
    gap: 1rem;
    align-items: center;
    padding: 1rem 0;
    border-bottom: 1px solid #f1f5f9;
}

.order-item:last-child {
    border-bottom: none;
}

.item-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 0.375rem;
}

.item-info h6 {
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: #2d3748;
}

.item-info small {
    color: #718096;
}

.item-quantity {
    text-align: center;
    font-weight: 600;
    color: #2d3748;
}

.item-price {
    text-align: center;
    color: #4a5568;
}

.item-total {
    text-align: right;
    font-weight: 600;
    color: #0d6efd;
}

.order-total {
    padding-top: 1rem;
    border-top: 1px solid #e2e8f0;
    margin-top: 1rem;
}

.total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.total-amount {
    font-size: 1.25rem;
    font-weight: 700;
    color: #0d6efd;
}

.actions-card {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    margin-bottom: 1.5rem;
}

.actions-header {
    background: #f8f9fa;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #dee2e6;
    border-radius: 0.5rem 0.5rem 0 0;
}

.actions-header h5 {
    margin: 0;
    font-weight: 600;
    color: #2d3748;
}

.actions-body {
    padding: 1.5rem;
}

.action-btn {
    width: 100%;
    padding: 0.75rem 1rem;
    border-radius: 0.375rem;
    font-weight: 500;
    text-decoration: none;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
    border: none;
}

.action-btn:last-child {
    margin-bottom: 0;
}

.btn-danger {
    background: #dc3545;
    color: white;
}

.btn-danger:hover {
    background: #c82333;
    color: white;
}

.btn-success {
    background: #198754;
    color: white;
}

.btn-success:hover {
    background: #157347;
    color: white;
}

.btn-outline-primary {
    background: transparent;
    color: #0d6efd;
    border: 1px solid #0d6efd;
}

.btn-outline-primary:hover {
    background: #0d6efd;
    color: white;
}

.timeline-card {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.timeline-header {
    background: #f8f9fa;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #dee2e6;
    border-radius: 0.5rem 0.5rem 0 0;
}

.timeline-header h5 {
    margin: 0;
    font-weight: 600;
    color: #2d3748;
}

.timeline-body {
    padding: 1.5rem;
}

.timeline {
    position: relative;
    padding-left: 2rem;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e2e8f0;
}

.timeline-item {
    position: relative;
    margin-bottom: 1.5rem;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-marker {
    position: absolute;
    left: -23px;
    top: 5px;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: #e2e8f0;
    border: 3px solid #fff;
    box-shadow: 0 0 0 2px #e2e8f0;
}

.timeline-item.completed .timeline-marker {
    background: #198754;
    box-shadow: 0 0 0 2px #198754;
}

.timeline-content h6 {
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: #2d3748;
}

.timeline-content small {
    color: #718096;
}

@media (max-width: 768px) {
    .order-info-section {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .order-item {
        grid-template-columns: 1fr;
        gap: 0.5rem;
        text-align: center;
    }
    
    .item-image {
        justify-self: center;
    }
}
</style>

<div class="container order-container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= url() ?>">Головна</a></li>
            <li class="breadcrumb-item"><a href="<?= url('orders') ?>">Мої замовлення</a></li>
            <li class="breadcrumb-item active">Замовлення #<?= $order['id'] ?></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-8">
            <!-- Order Info -->
            <div class="order-card">
                <div class="order-header">
                    <h4 class="order-title">Замовлення #<?= $order['id'] ?></h4>
                    <span class="status-badge <?= getStatusColor($order['status']) ?>"><?= getStatusText($order['status']) ?></span>
                </div>
                <div class="order-body">
                    <div class="order-info-section">
                        <div class="info-group">
                            <h6>Інформація про замовлення:</h6>
                            <p><strong>Дата:</strong> <?= date('d.m.Y H:i', strtotime($order['created_at'])) ?></p>
                            <p><strong>Статус:</strong> <?= getStatusText($order['status']) ?></p>
                            <p><strong>Сума:</strong> <?= number_format($order['total_amount'], 2) ?> ₴</p>
                        </div>
                        <div class="info-group">
                            <h6>Адреса доставки:</h6>
                            <p><?= htmlspecialchars($order['shipping_address']) ?></p>
                            <p><?= htmlspecialchars($order['shipping_city']) ?></p>
                            <p><?= htmlspecialchars($order['shipping_postal_code']) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="items-card">
                <div class="items-header">
                    <h5>Товари в замовленні</h5>
                </div>
                <div class="items-body">
                    <?php foreach ($order['items'] as $item): ?>
                    <div class="order-item">
                        <img src="<?= url($item['main_image'] ?? 'assets/images/no-image.jpg') ?>" 
                             class="item-image" alt="<?= htmlspecialchars($item['product_name']) ?>">
                        
                        <div class="item-info">
                            <h6><?= htmlspecialchars($item['product_name']) ?></h6>
                            <small>Артикул: <?= htmlspecialchars($item['product_sku'] ?? 'N/A') ?></small>
                        </div>
                        
                        <div class="item-quantity"><?= $item['quantity'] ?> шт.</div>
                        
                        <div class="item-price"><?= number_format($item['price'], 2) ?> ₴</div>
                        
                        <div class="item-total"><?= number_format($item['quantity'] * $item['price'], 2) ?> ₴</div>
                    </div>
                    <?php endforeach; ?>
                    
                    <!-- Total -->
                    <div class="order-total">
                        <div class="total-row">
                            <strong>Загальна сума:</strong>
                            <strong class="total-amount"><?= number_format($order['total_amount'], 2) ?> ₴</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Actions -->
        <div class="col-lg-4">
            <div class="actions-card">
                <div class="actions-header">
                    <h5>Дії</h5>
                </div>
                <div class="actions-body">
                    <?php if ($order['status'] === 'pending'): ?>
                    <button class="action-btn btn-danger" onclick="cancelOrder(<?= $order['id'] ?>)">
                        <i class="fas fa-times"></i>Скасувати замовлення
                    </button>
                    <?php endif; ?>
                    
                    <?php if ($order['status'] === 'delivered'): ?>
                    <a href="<?= url('orders') ?>" class="action-btn btn-success">
                        <i class="fas fa-redo"></i>Замовити знову
                    </a>
                    <?php endif; ?>
                    
                    <a href="<?= url('orders') ?>" class="action-btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i>Назад до замовлень
                    </a>
                </div>
            </div>

            <!-- Order Timeline -->
            <div class="timeline-card">
                <div class="timeline-header">
                    <h5>Статус замовлення</h5>
                </div>
                <div class="timeline-body">
                    <div class="timeline">
                        <div class="timeline-item <?= in_array($order['status'], ['pending', 'processing', 'shipped', 'delivered']) ? 'completed' : '' ?>">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h6>Замовлення створено</h6>
                                <small><?= date('d.m.Y H:i', strtotime($order['created_at'])) ?></small>
                            </div>
                        </div>
                        
                        <div class="timeline-item <?= in_array($order['status'], ['processing', 'shipped', 'delivered']) ? 'completed' : '' ?>">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h6>Обробляється</h6>
                                <small>Замовлення прийнято в обробку</small>
                            </div>
                        </div>
                        
                        <div class="timeline-item <?= in_array($order['status'], ['shipped', 'delivered']) ? 'completed' : '' ?>">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h6>Відправлено</h6>
                                <small>Замовлення передано в доставку</small>
                            </div>
                        </div>
                        
                        <div class="timeline-item <?= $order['status'] === 'delivered' ? 'completed' : '' ?>">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h6>Доставлено</h6>
                                <small>Замовлення успішно доставлено</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Cancel order
// Cancel order
function cancelOrder(orderId) {
    if (!confirm('Ви впевнені, що хочете скасувати це замовлення?')) {
        return;
    }
    
    fetch('<?= url('order/cancel') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `order_id=${orderId}&csrf_token=<?= $csrf_token ?>`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Показуємо повідомлення про успіх з лічильником
            showSuccessAlert(data.message);
            
            // Перенаправляємо через 5 секунд
            setTimeout(() => {
                window.location.href = '<?= url('orders') ?>';
            }, 5000);
            
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        alert('Помилка при скасуванні замовлення');
    });
}

// Функція для показу повідомлення з лічильником
function showSuccessAlert(message) {
    // Створюємо контейнер для повідомлення
    const alertContainer = document.createElement('div');
    alertContainer.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        background: #198754;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        font-weight: 500;
        min-width: 300px;
    `;
    
    // Створюємо текст повідомлення
    const messageText = document.createElement('div');
    messageText.textContent = message;
    alertContainer.appendChild(messageText);
    
    // Створюємо лічильник
    const countdownText = document.createElement('div');
    countdownText.style.cssText = `
        margin-top: 0.5rem;
        font-size: 0.9rem;
        opacity: 0.9;
    `;
    alertContainer.appendChild(countdownText);
    
    // Додаємо до сторінки
    document.body.appendChild(alertContainer);
    
    // Запускаємо лічильник
    let seconds = 5;
    countdownText.textContent = `Перенаправлення через ${seconds} секунд...`;
    
    const countdown = setInterval(() => {
        seconds--;
        if (seconds > 0) {
            countdownText.textContent = `Перенаправлення через ${seconds} секунд...`;
        } else {
            countdownText.textContent = 'Перенаправлення...';
            clearInterval(countdown);
        }
    }, 1000);
    
    // Додаємо можливість закрити повідомлення
    const closeBtn = document.createElement('button');
    closeBtn.innerHTML = '&times;';
    closeBtn.style.cssText = `
        position: absolute;
        top: 0.5rem;
        right: 0.75rem;
        background: none;
        border: none;
        color: white;
        font-size: 1.25rem;
        cursor: pointer;
        line-height: 1;
    `;
    closeBtn.onclick = () => {
        document.body.removeChild(alertContainer);
        clearInterval(countdown);
    };
    alertContainer.appendChild(closeBtn);
}
</script>