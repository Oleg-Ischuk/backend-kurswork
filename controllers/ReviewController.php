<?php
// controllers/ReviewController.php
class ReviewController extends Controller {
    
    public function add() {
        $this->requireAuth();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/');
        }
        
        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $_SESSION['error'] = 'Невірний токен безпеки';
            $this->redirect('/');
        }
        
        $productId = (int)($_POST['product_id'] ?? 0);
        $rating = (int)($_POST['rating'] ?? 0);
        $comment = $this->clean($_POST['comment'] ?? '');
        
        // Валідація
        if ($productId <= 0 || $rating < 1 || $rating > 5) {
            $_SESSION['error'] = 'Невірні дані';
            $this->redirect('/product/' . $productId);
        }
        
        $reviewModel = new Review();
        
        $result = $reviewModel->addReview($_SESSION['user_id'], $productId, $rating, $comment);
        
        if ($result) {
            $_SESSION['success'] = 'Відгук успішно додано';
        } else {
            $_SESSION['error'] = 'Помилка при додаванні відгуку';
        }
        
        $this->redirect('/product/' . $productId);
    }
    
    public function update() {
        $this->requireAuth();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/');
        }
        
        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $_SESSION['error'] = 'Невірний токен безпеки';
            $this->redirect('/');
        }
        
        $reviewId = (int)($_POST['review_id'] ?? 0);
        $rating = (int)($_POST['rating'] ?? 0);
        $comment = $this->clean($_POST['comment'] ?? '');
        
        if ($reviewId <= 0 || $rating < 1 || $rating > 5) {
            $_SESSION['error'] = 'Невірні дані';
            $this->redirect('/');
        }
        
        $reviewModel = new Review();
        $review = $reviewModel->find($reviewId);
        
        if (!$review || $review['user_id'] != $_SESSION['user_id']) {
            $_SESSION['error'] = 'Відгук не знайдено';
            $this->redirect('/');
        }
        
        $result = $reviewModel->update($reviewId, [
            'rating' => $rating,
            'comment' => $comment
        ]);
        
        if ($result) {
            $_SESSION['success'] = 'Відгук оновлено';
        } else {
            $_SESSION['error'] = 'Помилка при оновленні відгуку';
        }
        
        $this->redirect('/product/' . $review['product_id']);
    }
    
    // ✅ ОНОВЛЕНО: Додано можливість видалення для адміністратора
    public function delete() {
        $this->requireAuth();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Невірний метод запиту']);
            return;
        }
        
        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $this->json(['success' => false, 'message' => 'Невірний токен безпеки']);
            return;
        }
        
        $reviewId = (int)($_POST['review_id'] ?? 0);
        
        if ($reviewId <= 0) {
            $this->json(['success' => false, 'message' => 'Невірні дані']);
            return;
        }
        
        $reviewModel = new Review();
        $review = $reviewModel->find($reviewId);
        
        if (!$review) {
            $this->json(['success' => false, 'message' => 'Відгук не знайдено']);
            return;
        }
        
        // ✅ ЗМІНЕНО: Перевіряємо права (власник відгуку або адмін)
        $isOwner = $review['user_id'] == $_SESSION['user_id'];
        $isAdmin = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
        
        if (!$isOwner && !$isAdmin) {
            $this->json(['success' => false, 'message' => 'Немає прав для видалення']);
            return;
        }
        
        $result = $reviewModel->delete($reviewId);
        
        if ($result) {
            $this->json(['success' => true, 'message' => 'Відгук видалено']);
        } else {
            $this->json(['success' => false, 'message' => 'Помилка при видаленні']);
        }
    }
    
    // ✅ ДОДАНО: Метод для адміністрування відгуків
    public function adminIndex() {
        $this->requireAdmin();
        
        $reviewModel = new Review();
        
        // Параметри пагінації та фільтрації
        $page = (int)($_GET['page'] ?? 1);
        $limit = 20;
        $offset = ($page - 1) * $limit;
        $search = $this->clean($_GET['search'] ?? '');
        $productId = (int)($_GET['product_id'] ?? 0);
        $rating = (int)($_GET['rating'] ?? 0);
        
        // Отримуємо відгуки з фільтрацією
        $reviews = $reviewModel->getReviewsForAdmin($limit, $offset, $search, $productId, $rating);
        $totalReviews = $reviewModel->countReviewsForAdmin($search, $productId, $rating);
        $totalPages = ceil($totalReviews / $limit);
        
        $data = [
            'title' => 'Управління відгуками',
            'reviews' => $reviews,
            'search' => $search,
            'selectedProduct' => $productId,
            'selectedRating' => $rating,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'csrf_token' => $this->generateCsrfToken()
        ];
        
        $this->viewAdmin('reviews/index', $data);
    }
}
?>
