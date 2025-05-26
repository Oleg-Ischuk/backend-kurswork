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
        
        // Перевіряємо чи може користувач залишити відгук
        if (!$reviewModel->canUserReview($_SESSION['user_id'], $productId)) {
            $_SESSION['error'] = 'Ви можете залишити відгук тільки на товари, які купували';
            $this->redirect('/product/' . $productId);
        }
        
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
    
    public function delete() {
        $this->requireAuth();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/');
        }
        
        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $this->json(['success' => false, 'message' => 'Невірний токен безпеки']);
        }
        
        $reviewId = (int)($_POST['review_id'] ?? 0);
        
        if ($reviewId <= 0) {
            $this->json(['success' => false, 'message' => 'Невірні дані']);
        }
        
        $reviewModel = new Review();
        $review = $reviewModel->find($reviewId);
        
        if (!$review) {
            $this->json(['success' => false, 'message' => 'Відгук не знайдено']);
        }
        
        // Перевіряємо права (власник відгуку або адмін)
        if ($review['user_id'] != $_SESSION['user_id'] && $_SESSION['user_role'] !== 'admin') {
            $this->json(['success' => false, 'message' => 'Немає прав для видалення']);
        }
        
        $result = $reviewModel->delete($reviewId);
        
        if ($result) {
            $this->json(['success' => true, 'message' => 'Відгук видалено']);
        } else {
            $this->json(['success' => false, 'message' => 'Помилка при видаленні']);
        }
    }
}
?>