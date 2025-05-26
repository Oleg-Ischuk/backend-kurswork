<?php
// models/Review.php
class Review extends Model {
    protected $table = 'reviews';
    
    public function getProductReviews($productId, $limit = null) {
        $sql = "SELECT r.*, u.first_name, u.last_name
                FROM reviews r
                LEFT JOIN users u ON r.user_id = u.id
                WHERE r.product_id = ?
                ORDER BY r.created_at DESC";
        
        if ($limit) {
            $sql .= " LIMIT " . (int)$limit;
        }
        
        return $this->query($sql, [$productId]);
    }
    
    public function getUserReview($userId, $productId) {
        $sql = "SELECT * FROM reviews WHERE user_id = ? AND product_id = ?";
        return $this->queryOne($sql, [$userId, $productId]);
    }
    
    public function addReview($userId, $productId, $rating, $comment) {
        // Перевіряємо чи користувач вже залишав відгук
        $existingReview = $this->getUserReview($userId, $productId);
        
        if ($existingReview) {
            // Оновлюємо існуючий відгук
            return $this->update($existingReview['id'], [
                'rating' => $rating,
                'comment' => $comment
            ]);
        } else {
            // Створюємо новий відгук
            return $this->create([
                'user_id' => $userId,
                'product_id' => $productId,
                'rating' => $rating,
                'comment' => $comment
            ]);
        }
    }
    
    public function canUserReview($userId, $productId) {
        // Перевіряємо чи користувач купував цей товар
        $sql = "SELECT COUNT(*) as count
                FROM order_items oi
                LEFT JOIN orders o ON oi.order_id = o.id
                WHERE o.user_id = ? AND oi.product_id = ? AND o.status = 'delivered'";
        
        $result = $this->queryOne($sql, [$userId, $productId]);
        return $result['count'] > 0;
    }
    
    public function getReviewStats($productId) {
        $sql = "SELECT 
                    COUNT(*) as total_reviews,
                    AVG(rating) as avg_rating,
                    COUNT(CASE WHEN rating = 5 THEN 1 END) as five_star,
                    COUNT(CASE WHEN rating = 4 THEN 1 END) as four_star,
                    COUNT(CASE WHEN rating = 3 THEN 1 END) as three_star,
                    COUNT(CASE WHEN rating = 2 THEN 1 END) as two_star,
                    COUNT(CASE WHEN rating = 1 THEN 1 END) as one_star
                FROM reviews 
                WHERE product_id = ?";
        
        return $this->queryOne($sql, [$productId]);
    }
}
?>