<style>
    .product-container {
        padding: 2rem 0;
    }

    .product-images {
        margin-bottom: 1.5rem;
    }

    .main-image {
        margin-bottom: 1rem;
    }

    .main-image img {
        width: 100%;
        height: 400px;
        object-fit: contain;
        border-radius: 0.5rem;
        box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
    }

    .thumbnail-images {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0.5rem;
    }

    .thumbnail-img {
        width: 100%;
        height: 80px;
        object-fit: cover;
        border-radius: 0.375rem;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.2s;
    }

    .thumbnail-img:hover {
        border-color: #0d6efd;
    }

    .thumbnail-img.active {
        border-color: #0d6efd;
        box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.25);
    }

    .product-info {
        padding-left: 1rem;
    }

    .product-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #2d3748;
        line-height: 1.3;
    }

    .product-rating {
        margin-bottom: 1rem;
    }

    .rating-display {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .rating-stars {
        color: #ffc107;
    }

    .rating-text {
        color: #718096;
    }

    .product-price {
        margin-bottom: 1.5rem;
    }

    .price-container {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .original-price {
        text-decoration: line-through;
        color: #718096;
        font-size: 1.25rem;
    }

    .current-price {
        font-weight: 700;
        color: #0d6efd;
        font-size: 2rem;
    }

    .discount-badge {
        background: #dc3545;
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .stock-status {
        margin-bottom: 1rem;
    }

    .stock-badge {
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 600;
    }

    .stock-badge.in-stock {
        background: #d1e7dd;
        color: #0f5132;
    }

    .stock-badge.out-of-stock {
        background: #f8d7da;
        color: #842029;
    }

    .product-brand {
        margin-bottom: 1.5rem;
        color: #4a5568;
    }

    .product-brand strong {
        color: #2d3748;
    }

    .add-to-cart-section {
        margin-bottom: 2rem;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .quantity-label {
        font-weight: 600;
        color: #2d3748;
    }

    .quantity-input-group {
        display: flex;
        border: 1px solid #e2e8f0;
        border-radius: 0.375rem;
        overflow: hidden;
        width: 120px;
    }

    .quantity-btn {
        background: #f7fafc;
        border: none;
        padding: 0.5rem 0.75rem;
        cursor: pointer;
        color: #4a5568;
        transition: background-color 0.2s;
    }

    .quantity-btn:hover {
        background: #edf2f7;
    }

    .quantity-input {
        border: none;
        text-align: center;
        padding: 0.5rem 0.25rem;
        width: 60px;
        font-weight: 500;
    }

    .quantity-input:focus {
        outline: none;
    }

    .add-to-cart-btn {
        background: #0d6efd;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 0.375rem;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .add-to-cart-btn:hover {
        background: #0b5ed7;
    }

    .attributes-section {
        margin-bottom: 2rem;
    }

    .attributes-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #2d3748;
    }

    .attributes-table {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .attributes-table table {
        width: 100%;
        margin: 0;
    }

    .attributes-table tr {
        border-bottom: 1px solid #f1f5f9;
    }

    .attributes-table tr:last-child {
        border-bottom: none;
    }

    .attributes-table td {
        padding: 0.75rem 1rem;
        vertical-align: top;
    }

    .attributes-table td:first-child {
        background: #f8f9fa;
        font-weight: 600;
        color: #2d3748;
        width: 30%;
    }

    .attributes-table td:last-child {
        color: #4a5568;
    }

    .product-tabs {
        margin-top: 3rem;
    }

    .nav-tabs {
        border-bottom: 2px solid #e2e8f0;
        margin-bottom: 0;
    }

    .nav-tabs .nav-link {
        border: none;
        border-bottom: 2px solid transparent;
        color: #718096;
        font-weight: 500;
        padding: 1rem 1.5rem;
        transition: all 0.2s;
    }

    .nav-tabs .nav-link:hover {
        color: #0d6efd;
        border-bottom-color: #0d6efd;
    }

    .nav-tabs .nav-link.active {
        color: #0d6efd;
        border-bottom-color: #0d6efd;
        background: none;
    }

    .tab-content {
        background: white;
        border: 1px solid #e2e8f0;
        border-top: none;
        border-radius: 0 0 0.5rem 0.5rem;
    }

    .tab-pane {
        padding: 2rem;
    }

    .description-content {
        color: #4a5568;
        line-height: 1.8;
    }

    .review-stats {
        margin-bottom: 2rem;
    }

    .rating-overview {
        text-align: center;
    }

    .rating-number {
        font-size: 3rem;
        font-weight: 700;
        color: #0d6efd;
        margin-bottom: 0.5rem;
    }

    .rating-breakdown {
        padding-left: 1rem;
    }

    .rating-bar {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
        gap: 0.5rem;
    }

    .rating-bar-label {
        min-width: 60px;
        font-size: 0.9rem;
        color: #4a5568;
    }

    .rating-progress {
        flex: 1;
        height: 8px;
        background: #f1f5f9;
        border-radius: 4px;
        overflow: hidden;
    }

    .rating-progress-fill {
        height: 100%;
        background: #ffc107;
        transition: width 0.3s;
    }

    .rating-count {
        min-width: 30px;
        font-size: 0.9rem;
        color: #718096;
        text-align: right;
    }

    .review-form-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        margin-bottom: 2rem;
    }

    .review-form-header {
        background: #f8f9fa;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #e2e8f0;
        border-radius: 0.5rem 0.5rem 0 0;
    }

    .review-form-body {
        padding: 1.5rem;
    }

    .rating-input-group {
        margin-bottom: 1rem;
    }

    .rating-input {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
        gap: 0.25rem;
    }

    .rating-input input[type="radio"] {
        display: none;
    }

    .rating-input label {
        cursor: pointer;
        color: #e2e8f0;
        font-size: 1.5rem;
        transition: color 0.2s;
    }

    .rating-input label:hover,
    .rating-input label:hover~label,
    .rating-input input[type="radio"]:checked~label {
        color: #ffc107;
    }

    .comment-group {
        margin-bottom: 1rem;
    }

    .comment-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
        color: #2d3748;
    }

    .comment-textarea {
        width: 100%;
        border: 1px solid #e2e8f0;
        border-radius: 0.375rem;
        padding: 0.75rem;
        font-size: 1rem;
        resize: vertical;
        min-height: 100px;
    }

    .comment-textarea:focus {
        border-color: #0d6efd;
        outline: none;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
    }

    .submit-review-btn {
        background: #0d6efd;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 0.375rem;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .submit-review-btn:hover {
        background: #0b5ed7;
    }

    .reviews-list {
        margin-top: 1rem;
    }

    .review-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
        padding: 1.5rem;
        position: relative;
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .reviewer-info h6 {
        font-weight: 600;
        margin-bottom: 0.25rem;
        color: #2d3748;
    }

    .reviewer-name-container {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .verified-purchase-badge {
        background: #198754;
        color: white;
        padding: 0.125rem 0.375rem;
        border-radius: 0.25rem;
        font-size: 0.7rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .review-rating {
        color: #ffc107;
    }

    .review-date {
        color: #718096;
        font-size: 0.875rem;
    }

    .review-comment {
        color: #4a5568;
        line-height: 1.6;
        margin: 0;
    }

    /* ✅ ДОДАНО: Стилі для кнопок управління відгуками */
    .review-actions {
        position: absolute;
        top: 1rem;
        right: 1rem;
        display: flex;
        gap: 0.5rem;
    }

    .review-action-btn {
        background: none;
        border: 1px solid #e2e8f0;
        border-radius: 0.25rem;
        padding: 0.25rem 0.5rem;
        cursor: pointer;
        font-size: 0.8rem;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 0.25rem;
        margin-right: 100px;
    }

    .review-action-btn.delete {
        color: #dc3545;
        border-color: #dc3545;
    }

    .review-action-btn.delete:hover {
        background: #dc3545;
        color: white;
    }

    .review-action-btn.edit {
        color: #0d6efd;
        border-color: #0d6efd;
    }

    .review-action-btn.edit:hover {
        background: #0d6efd;
        color: white;
    }

    .admin-badge {
        background: #6f42c1;
        color: white;
        padding: 0.125rem 0.375rem;
        border-radius: 0.25rem;
        font-size: 0.7rem;
        font-weight: 500;
    }

    .no-reviews {
        text-align: center;
        padding: 2rem 0;
    }

    .no-reviews-icon {
        font-size: 3rem;
        color: #cbd5e0;
        margin-bottom: 1rem;
    }

    .no-reviews h5 {
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    .no-reviews p {
        color: #718096;
    }

    .related-products {
        margin-top: 3rem;
    }

    .related-title {
        font-size: 1.75rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: #2d3748;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .related-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        overflow: hidden;
        transition: all 0.2s;
        display: flex;
        flex-direction: column;
        height: 350px;
    }

    .related-card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .related-image-container {
        height: 180px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
    }

    .related-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center;
        filter: brightness(1) contrast(1);
        mix-blend-mode: multiply;

    }

    .related-body {
        padding: 1rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .related-title-small {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #2d3748;
        font-size: 0.95rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        height: 2.8rem;
    }

    .related-footer {
        margin-top: auto;
    }

    .related-price-rating {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .related-price {
        font-weight: 600;
        color: #0d6efd;
        font-size: 1.1rem;
    }

    .related-rating {
        color: #ffc107;
        font-size: 0.85rem;
    }

    .related-btn {
        background: transparent;
        color: #0d6efd;
        border: 1px solid #0d6efd;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        text-decoration: none;
        text-align: center;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.2s;
        display: block;
        width: 100%;
    }

    .related-btn:hover {
        background: #0d6efd;
        color: white;
        text-decoration: none;
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

    .login-prompt {
        background: #f8f9fa;
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        padding: 1.5rem;
        text-align: center;
        margin-bottom: 2rem;
    }

    .login-prompt h5 {
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    .login-prompt p {
        color: #718096;
        margin-bottom: 1rem;
    }

    .login-btn {
        background: #0d6efd;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        text-decoration: none;
        font-weight: 500;
        transition: background-color 0.2s;
    }

    .login-btn:hover {
        background: #0b5ed7;
        color: white;
    }

    @media (max-width: 768px) {
        .product-title {
            font-size: 1.5rem;
        }

        .current-price {
            font-size: 1.5rem;
        }

        .quantity-controls {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .thumbnail-images {
            grid-template-columns: repeat(3, 1fr);
        }

        .related-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .related-card {
            height: 320px;
        }

        .related-image-container {
            height: 150px;
        }

        .related-title-small {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 576px) {
        .product-info {
            padding-left: 0;
            margin-top: 1rem;
        }

        .price-container {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .thumbnail-images {
            grid-template-columns: repeat(2, 1fr);
        }

        .related-grid {
            grid-template-columns: 1fr;
        }

        .related-card {
            height: 300px;
        }

        .related-image-container {
            height: 140px;
        }
    }
</style>

<div class="container product-container">

    <div class="row">
        <!-- Product Images -->
        <div class="col-lg-6 mb-4">
            <div class="product-images">
                <?php if (!empty($images)): ?>
                    <!-- Main Image -->
                    <div class="main-image">
                        <img src="<?= url($images[0]['image_url']) ?>"
                            alt="<?= htmlspecialchars($product['name']) ?>" id="mainImage">
                    </div>

                    <!-- Thumbnail Images -->
                    <?php if (count($images) > 1): ?>
                        <div class="thumbnail-images">
                            <?php foreach ($images as $index => $image): ?>
                                <img src="<?= url($image['image_url']) ?>"
                                    class="thumbnail-img <?= $index === 0 ? 'active' : '' ?>"
                                    alt="<?= htmlspecialchars($product['name']) ?>"
                                    onclick="changeMainImage('<?= url($image['image_url']) ?>', this)">
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="main-image">
                        <img src="<?= url('assets/images/no-image.jpg') ?>"
                            alt="<?= htmlspecialchars($product['name']) ?>">
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-lg-6">
            <div class="product-info">
                <h1 class="product-title"><?= htmlspecialchars($product['name']) ?></h1>

                <!-- Rating -->
                <?php if ($product['avg_rating']): ?>
                    <div class="product-rating">
                        <div class="rating-display">
                            <div class="rating-stars">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star<?= $i <= round($product['avg_rating']) ? '' : '-o' ?>"></i>
                                <?php endfor; ?>
                            </div>
                            <span class="rating-text"><?= number_format($product['avg_rating'], 1) ?> (<?= $product['reviews_count'] ?> відгуків)</span>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Price -->
                <div class="product-price">
                    <?php if ($product['discount'] > 0): ?>
                        <?php $discountedPrice = $product['price'] * (1 - $product['discount'] / 100); ?>
                        <div class="price-container">
                            <span class="original-price"><?= number_format($product['price'], 2) ?> ₴</span>
                            <span class="current-price"><?= number_format($discountedPrice, 2) ?> ₴</span>
                            <span class="discount-badge">-<?= $product['discount'] ?>%</span>
                        </div>
                    <?php else: ?>
                        <span class="current-price"><?= number_format($product['price'], 2) ?> ₴</span>
                    <?php endif; ?>
                </div>

                <!-- Stock Status -->
                <div class="stock-status">
                    <?php if ($product['stock'] > 0): ?>
                        <span class="stock-badge in-stock">В наявності: <?= $product['stock'] ?> шт.</span>
                    <?php else: ?>
                        <span class="stock-badge out-of-stock">Немає в наявності</span>
                    <?php endif; ?>
                </div>

                <!-- Brand -->
                <div class="product-brand">
                    <strong>Бренд:</strong> <?= htmlspecialchars($product['brand_name']) ?>
                </div>

                <!-- Add to Cart -->
                <?php if ($product['stock'] > 0): ?>
                    <div class="add-to-cart-section">
                        <div class="quantity-controls">
                            <span class="quantity-label">Кількість:</span>
                            <div class="quantity-input-group">
                                <button class="quantity-btn" type="button" onclick="changeQuantity(-1)">-</button>
                                <input type="number" class="quantity-input" id="quantity" value="1" min="1" max="<?= $product['stock'] ?>">
                                <button class="quantity-btn" type="button" onclick="changeQuantity(1)">+</button>
                            </div>
                            <button class="add-to-cart-btn" onclick="addToCart(<?= $product['id'] ?>)">
                                <i class="fas fa-cart-plus"></i>Додати до кошика
                            </button>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Product Attributes -->
                <?php if (!empty($attributes)): ?>
                    <div class="attributes-section">
                        <h5 class="attributes-title">Характеристики:</h5>
                        <div class="attributes-table">
                            <table>
                                <?php foreach ($attributes as $attribute): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($attribute['attribute_name']) ?>:</td>
                                        <td><?= htmlspecialchars($attribute['attribute_value']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Product Description -->
    <div class="product-tabs">
        <ul class="nav nav-tabs" id="productTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button">
                    Опис
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button">
                    Відгуки (<?= count($reviews) ?>)
                </button>
            </li>
        </ul>

        <div class="tab-content" id="productTabsContent">
            <!-- Description Tab -->
            <div class="tab-pane fade show active" id="description" role="tabpanel">
                <div class="description-content">
                    <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                </div>
            </div>

            <!-- Reviews Tab -->
            <div class="tab-pane fade" id="reviews" role="tabpanel">
                <!-- Review Stats -->
                <?php if (!empty($reviewStats) && $reviewStats['total_reviews'] > 0): ?>
                    <div class="review-stats">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="rating-overview">
                                    <div class="rating-number"><?= number_format($reviewStats['avg_rating'], 1) ?></div>
                                    <div class="rating-stars">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <i class="fas fa-star<?= $i <= round($reviewStats['avg_rating']) ? '' : '-o' ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <div class="rating-text"><?= $reviewStats['total_reviews'] ?> відгуків</div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="rating-breakdown">
                                    <?php for ($i = 5; $i >= 1; $i--): ?>
                                        <div class="rating-bar">
                                            <span class="rating-bar-label"><?= $i ?> зірок</span>
                                            <div class="rating-progress">
                                                <?php
                                                $count = $reviewStats[$i === 5 ? 'five_star' : ($i === 4 ? 'four_star' : ($i === 3 ? 'three_star' : ($i === 2 ? 'two_star' : 'one_star')))];
                                                $percentage = $reviewStats['total_reviews'] > 0 ? ($count / $reviewStats['total_reviews']) * 100 : 0;
                                                ?>
                                                <div class="rating-progress-fill" style="width: <?= $percentage ?>%"></div>
                                            </div>
                                            <span class="rating-count"><?= $count ?></span>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Add Review Form -->
                <?php if (isset($_SESSION['user_id']) && $canReview): ?>
                    <div class="review-form-card">
                        <div class="review-form-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5>
                                    <i class="fas fa-star me-2"></i>
                                    <?= $userReview ? 'Редагувати відгук' : 'Залишити відгук' ?>
                                </h5>
                                <?php if ($hasPurchased): ?>
                                    <span class="verified-purchase-badge">
                                        <i class="fas fa-check"></i>Підтверджена покупка
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="review-form-body">
                            <form method="POST" action="<?= url('review/add') ?>">
                                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

                                <div class="rating-input-group">
                                    <label class="comment-label">Оцінка:</label>
                                    <div class="rating-input">
                                        <?php for ($i = 5; $i >= 1; $i--): ?>
                                            <input type="radio" name="rating" value="<?= $i ?>" id="star<?= $i ?>"
                                                <?= $userReview && $userReview['rating'] == $i ? 'checked' : '' ?> required>
                                            <label for="star<?= $i ?>"><i class="fas fa-star"></i></label>
                                        <?php endfor; ?>
                                    </div>
                                </div>

                                <div class="comment-group">
                                    <label for="comment" class="comment-label">Коментар:</label>
                                    <textarea class="comment-textarea" id="comment" name="comment" rows="3"
                                        placeholder="Поділіться своїми враженнями про товар..."><?= $userReview ? htmlspecialchars($userReview['comment']) : '' ?></textarea>
                                </div>

                                <button type="submit" class="submit-review-btn">
                                    <i class="fas fa-<?= $userReview ? 'edit' : 'plus' ?> me-1"></i>
                                    <?= $userReview ? 'Оновити відгук' : 'Додати відгук' ?>
                                </button>
                            </form>
                        </div>
                    </div>
                <?php elseif (!isset($_SESSION['user_id'])): ?>
                    <!-- Login Prompt -->
                    <div class="login-prompt">
                        <h5><i class="fas fa-user-lock me-2"></i>Увійдіть, щоб залишити відгук</h5>
                        <p>Щоб залишити відгук про цей товар, вам потрібно увійти в свій акаунт</p>
                        <a href="<?= url('login') ?>" class="login-btn">
                            <i class="fas fa-sign-in-alt me-1"></i>Увійти
                        </a>
                    </div>
                <?php endif; ?>

                <!-- Reviews List -->
                <?php if (!empty($reviews)): ?>
                    <div class="reviews-list">
                        <?php
                        $reviewModel = new Review(); // Створюємо екземпляр для перевірки покупок
                        foreach ($reviews as $review):
                            $reviewerPurchased = $reviewModel->hasUserPurchased($review['user_id'], $product['id']);

                            // ✅ ДОДАНО: Перевіряємо права на видалення
                            $canDelete = false;
                            if (isset($_SESSION['user_id'])) {
                                $isOwner = $review['user_id'] == $_SESSION['user_id'];
                                $isAdmin = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
                                $canDelete = $isOwner || $isAdmin;
                            }
                        ?>
                            <div class="review-card" id="review-<?= $review['id'] ?>">
                                <!-- ✅ ДОДАНО: Кнопки управління відгуками -->
                                <?php if ($canDelete): ?>
                                    <div class="review-actions">
                                        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                                            <span class="admin-badge">
                                                <i class="fas fa-shield-alt"></i> Адмін
                                            </span>
                                        <?php endif; ?>
                                        <button class="review-action-btn delete" onclick="deleteReview(<?= $review['id'] ?>)" title="Видалити відгук">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                <?php endif; ?>

                                <div class="review-header">
                                    <div class="reviewer-info">
                                        <div class="reviewer-name-container">
                                            <h6><?= htmlspecialchars($review['first_name'] . ' ' . $review['last_name']) ?></h6>
                                            <?php if ($reviewerPurchased): ?>
                                                <span class="verified-purchase-badge">
                                                    <i class="fas fa-check"></i>Підтверджена покупка
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="review-rating">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <i class="fas fa-star<?= $i <= $review['rating'] ? '' : '-o' ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    <div class="review-date"><?= date('d.m.Y', strtotime($review['created_at'])) ?></div>
                                </div>
                                <?php if ($review['comment']): ?>
                                    <p class="review-comment"><?= nl2br(htmlspecialchars($review['comment'])) ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="no-reviews">
                        <i class="fas fa-comments no-reviews-icon"></i>
                        <h5>Поки що немає відгуків</h5>
                        <p>Будьте першим, хто залишить відгук про цей товар!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <?php if (!empty($relatedProducts)): ?>
        <div class="related-products">
            <h3 class="related-title">Схожі товари</h3>
            <div class="related-grid">
                <?php foreach (array_slice($relatedProducts, 0, 4) as $relatedProduct): ?>
                    <div class="related-card">
                        <div class="related-image-container">
                            <img src="<?= url($relatedProduct['main_image'] ?? 'assets/images/no-image.jpg') ?>"
                                class="related-image" alt="<?= htmlspecialchars($relatedProduct['name']) ?>">
                        </div>
                        <div class="related-body">
                            <h6 class="related-title-small"><?= htmlspecialchars($relatedProduct['name']) ?></h6>
                            <div class="related-footer">
                                <div class="related-price-rating">
                                    <span class="related-price"><?= number_format($relatedProduct['price'], 2) ?> ₴</span>
                                    <?php if ($relatedProduct['avg_rating']): ?>
                                        <div class="related-rating">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <i class="fas fa-star<?= $i <= round($relatedProduct['avg_rating']) ? '' : '-o' ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <a href="<?= url('product/' . $relatedProduct['id']) ?>" class="related-btn">Переглянути</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
    // CSRF token for AJAX requests
    window.csrfToken = '<?= $csrf_token ?? '' ?>';

    // Change main image
    function changeMainImage(imageSrc, thumbnail) {
        document.getElementById('mainImage').src = imageSrc;

        // Update active thumbnail
        document.querySelectorAll('.thumbnail-img').forEach(img => img.classList.remove('active'));
        thumbnail.classList.add('active');
    }

    // Change quantity
    function changeQuantity(change) {
        const quantityInput = document.getElementById('quantity');
        const currentValue = parseInt(quantityInput.value);
        const newValue = currentValue + change;
        const maxValue = parseInt(quantityInput.max);

        if (newValue >= 1 && newValue <= maxValue) {
            quantityInput.value = newValue;
        }
    }

    // Add to cart
    function addToCart(productId) {
        const quantity = document.getElementById('quantity').value;

        fetch('<?= url('cart/add') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `product_id=${productId}&quantity=${quantity}&csrf_token=${window.csrfToken}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update cart count
                    const cartCount = document.getElementById('cartCount');
                    if (cartCount) {
                        cartCount.textContent = data.cartCount;
                    }

                    // Show success message
                    showAlert('success', data.message);
                } else {
                    showAlert('danger', data.message);
                }
            })
            .catch(error => {
                showAlert('danger', 'Помилка при додаванні товару до кошика');
            });
    }

    // ✅ ДОДАНО: Функція видалення відгуку
    function deleteReview(reviewId) {
        if (!confirm('Ви впевнені, що хочете видалити цей відгук?')) {
            return;
        }

        fetch('<?= url('review/delete') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `review_id=${reviewId}&csrf_token=${window.csrfToken}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Видаляємо відгук з DOM
                    const reviewElement = document.getElementById(`review-${reviewId}`);
                    if (reviewElement) {
                        reviewElement.remove();
                    }

                    // Показуємо повідомлення про успіх
                    showAlert('success', data.message);

                    // Перезавантажуємо сторінку через 2 секунди для оновлення статистики
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                } else {
                    showAlert('danger', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('danger', 'Помилка при видаленні відгуку');
            });
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

    // Initialize Bootstrap tabs
    document.addEventListener('DOMContentLoaded', function() {
        const triggerTabList = [].slice.call(document.querySelectorAll('#productTabs button'));
        triggerTabList.forEach(function(triggerEl) {
            const tabTrigger = new bootstrap.Tab(triggerEl);

            triggerEl.addEventListener('click', function(event) {
                event.preventDefault();
                tabTrigger.show();
            });
        });
    });
</script>