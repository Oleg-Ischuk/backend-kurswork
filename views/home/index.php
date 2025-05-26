<style>
/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
    color: white;
    padding: 4rem 0;
    margin-bottom: 0;
}

.hero-content {
    display: flex;
    align-items: center;
    min-height: 400px;
}

.hero-text {
    flex: 1;
    padding-right: 2rem;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    line-height: 1.2;
    margin-left: 10px
}

.hero-subtitle {
    font-size: 1.25rem;
    margin-bottom: 2rem;
    opacity: 0.9;
    line-height: 1.6;
    margin-left: 10px;
}

.hero-btn {
    background: white;
    color: #0d6efd;
    border: none;
    padding: 1rem 2rem;
    border-radius: 0.5rem;
    font-size: 1.1rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s;
    margin-left: 10px;
}

.hero-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.2);
    color: #0d6efd;
}

.hero-image {
    flex: 1;
    text-align: center;
    margin-right: 10px;
}

.hero-image img {
    max-width: 100%;
    height: auto;
    border-radius: 1rem;
    box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.2);
}

/* Categories Section */
.categories-section {
    padding: 4rem 0;
    background: white;
}

.section-title {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 3rem;
    color: #2d3748;
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
}

.category-card {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 0.75rem;
    padding: 2rem 1rem;
    text-align: center;
    transition: all 0.3s;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1);
    border-color: #0d6efd;
}

.category-icon {
    font-size: 3rem;
    color: #0d6efd;
    margin-bottom: 1rem;
}

.category-name {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #2d3748;
}

.category-count {
    color: #718096;
    margin-bottom: 1.5rem;
}

.category-btn {
    background: transparent;
    color: #0d6efd;
    border: 1px solid #0d6efd;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    font-size: 0.9rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s;
}

.category-btn:hover {
    background: #0d6efd;
    color: white;
}

/* Features Section */
.features-section {
    padding: 4rem 0;
    background: #f8f9fa;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.feature-item {
    text-align: center;
    padding: 1.5rem;
}

.feature-icon {
    font-size: 3rem;
    color: #0d6efd;
    margin-bottom: 1.5rem;
}

.feature-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #2d3748;
}

.feature-description {
    color: #718096;
    line-height: 1.6;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-content {
        flex-direction: column;
        text-align: center;
    }
    
    .hero-text {
        padding-right: 0;
        margin-bottom: 2rem;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .categories-grid {
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    }
}

@media (max-width: 576px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .section-title {
        font-size: 1.75rem;
    }
}
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">Ласкаво просимо до SportStore!</h1>
                <p class="hero-subtitle">Знайдіть найкращі спортивні товари для активного життя. Якість, надійність та доступні ціни.</p>
                <a href="<?= url('products') ?>" class="hero-btn">
                    <i class="fas fa-shopping-bag"></i>Переглянути товари
                </a>
            </div>
            <div class="hero-image">
                <img src="<?= url('assets/images/hero-sport.png') ?>" alt="Спорт">
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<?php if (!empty($categories)): ?>
<section class="categories-section">
    <div class="container">
        <h2 class="section-title">Категорії товарів</h2>
        <div class="categories-grid">
            <?php 
            // Функція для підбору іконки на основі назви категорії
            function getCategoryIcon($categoryName) {
                $name = mb_strtolower(trim($categoryName), 'UTF-8');
                
                // Точні збіги та часткові збіги
                if (strpos($name, 'футбол') !== false) return 'fas fa-futbol';
                if (strpos($name, 'баскетбол') !== false) return 'fas fa-basketball-ball';
                if (strpos($name, 'теніс') !== false) return 'fas fa-table-tennis';
                if (strpos($name, 'волейбол') !== false) return 'fas fa-volleyball-ball';
                if (strpos($name, 'плавання') !== false) return 'fas fa-swimmer';
                if (strpos($name, 'біг') !== false || strpos($name, 'легка атлетика') !== false) return 'fas fa-running';
                if (strpos($name, 'фітнес') !== false || strpos($name, 'тренажер') !== false) return 'fas fa-dumbbell';
                if (strpos($name, 'велосипед') !== false || strpos($name, 'велоспорт') !== false) return 'fas fa-bicycle';
                if (strpos($name, 'зимов') !== false || strpos($name, 'лыж') !== false) return 'fas fa-skiing';
                if (strpos($name, 'бокс') !== false || strpos($name, 'єдиноборств') !== false) return 'fas fa-fist-raised';
                if (strpos($name, 'йога') !== false) return 'fas fa-spa';
                if (strpos($name, 'одяг') !== false || strpos($name, 'форма') !== false) return 'fas fa-tshirt';
                if (strpos($name, 'взуття') !== false || strpos($name, 'кросівки') !== false) return 'fas fa-shoe-prints';
                if (strpos($name, 'аксесуар') !== false || strpos($name, 'годинник') !== false) return 'fas fa-stopwatch';
                if (strpos($name, 'харчування') !== false || strpos($name, 'добавки') !== false) return 'fas fa-pills';
                if (strpos($name, 'гольф') !== false) return 'fas fa-golf-ball';
                if (strpos($name, 'хокей') !== false) return 'fas fa-hockey-puck';
                
                // За замовчуванням
                return 'fas fa-trophy';
            }
            
            foreach (array_slice($categories, 0, 8) as $category): 
                $icon = getCategoryIcon($category['name']);
            ?>
            <div class="category-card">
                <i class="<?= $icon ?> category-icon"></i>
                <h5 class="category-name"><?= htmlspecialchars($category['name']) ?></h5>
                <p class="category-count"><?= $category['product_count'] ?? 0 ?> товарів</p>
                <a href="<?= url('products?category=' . $category['id']) ?>" class="category-btn">Переглянути</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="features-grid">
            <div class="feature-item">
                <i class="fas fa-shipping-fast feature-icon"></i>
                <h5 class="feature-title">Швидка доставка</h5>
                <p class="feature-description">Доставка по всій Україні протягом 1-3 днів</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-shield-alt feature-icon"></i>
                <h5 class="feature-title">Гарантія якості</h5>
                <p class="feature-description">Всі товари сертифіковані та мають гарантію</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-headset feature-icon"></i>
                <h5 class="feature-title">Підтримка 24/7</h5>
                <p class="feature-description">Наша команда завжди готова допомогти</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-undo feature-icon"></i>
                <h5 class="feature-title">Легкий повернення</h5>
                <p class="feature-description">14 днів на повернення товару без питань</p>
            </div>
        </div>
    </div>
</section>

<script>
// CSRF token for AJAX requests
window.csrfToken = '<?= $csrf_token ?? '' ?>';
</script>