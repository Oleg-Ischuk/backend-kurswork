<?php
// models/Product.php
class Product extends Model
{
    protected $table = 'products';

    public function getProductsWithDetails($limit = null, $offset = 0)
    {
        // ✅ ВИПРАВЛЕНИЙ SQL запит з правильним JOIN для зображень
        $sql = "SELECT p.*, c.name as category_name, b.name as brand_name,
                       pi.image_url as main_image,
                       AVG(r.rating) as avg_rating,
                       COUNT(DISTINCT r.id) as reviews_count
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN brands b ON p.brand_id = b.id
                LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_main = 1
                LEFT JOIN reviews r ON p.id = r.product_id
                GROUP BY p.id, c.name, b.name, pi.image_url
                ORDER BY p.id ASC";

        if ($limit) {
            $sql .= " LIMIT {$limit} OFFSET {$offset}";
        }

        return $this->query($sql);
    }

    public function getProductWithDetails($id)
    {
        // ✅ ВИПРАВЛЕНИЙ SQL запит
        $sql = "SELECT p.*, c.name as category_name, b.name as brand_name,
                       pi.image_url as main_image,
                       AVG(r.rating) as avg_rating,
                       COUNT(DISTINCT r.id) as reviews_count
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN brands b ON p.brand_id = b.id
                LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_main = 1
                LEFT JOIN reviews r ON p.id = r.product_id
                WHERE p.id = ?
                GROUP BY p.id, c.name, b.name, pi.image_url";

        return $this->queryOne($sql, [$id]);
    }

    // ✅ ДОДАНО МЕТОД FIND
    public function find($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error finding product: " . $e->getMessage());
            return false;
        }
    }

    // ✅ ДОДАНО МЕТОД DELETE
    public function delete($id)
    {
        try {
            // Спочатку видаляємо зображення товару
            $stmt = $this->db->prepare("DELETE FROM product_images WHERE product_id = ?");
            $stmt->execute([$id]);

            // Потім видаляємо сам товар
            $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Error deleting product: " . $e->getMessage());
            return false;
        }
    }

    public function getProductImages($productId)
    {
        $sql = "SELECT * FROM product_images WHERE product_id = ? ORDER BY is_main DESC, id ASC";
        return $this->query($sql, [$productId]);
    }


    public function searchProducts($query, $categoryId = null, $brandId = null, $minPrice = null, $maxPrice = null)
    {
        // ✅ ВИПРАВЛЕНИЙ SQL запит з правильним GROUP BY
        $sql = "SELECT p.*, c.name as category_name, b.name as brand_name,
                       pi.image_url as main_image,
                       AVG(r.rating) as avg_rating
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN brands b ON p.brand_id = b.id
                LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_main = 1
                LEFT JOIN reviews r ON p.id = r.product_id
                WHERE 1=1";

        $params = [];

        if ($query) {
            $sql .= " AND (p.name LIKE ? OR p.description LIKE ?)";
            $params[] = "%{$query}%";
            $params[] = "%{$query}%";
        }

        if ($categoryId) {
            $sql .= " AND p.category_id = ?";
            $params[] = $categoryId;
        }

        if ($brandId) {
            $sql .= " AND p.brand_id = ?";
            $params[] = $brandId;
        }

        if ($minPrice) {
            $sql .= " AND p.price >= ?";
            $params[] = $minPrice;
        }

        if ($maxPrice) {
            $sql .= " AND p.price <= ?";
            $params[] = $maxPrice;
        }

        $sql .= " GROUP BY p.id, c.name, b.name, pi.image_url ORDER BY p.name";

        return $this->query($sql, $params);
    }

    public function getProductsByCategory($categoryId, $limit = null)
    {
        // ✅ ВИПРАВЛЕНИЙ SQL запит
        $sql = "SELECT p.*, pi.image_url as main_image,
                       AVG(r.rating) as avg_rating
                FROM products p
                LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_main = 1
                LEFT JOIN reviews r ON p.id = r.product_id
                WHERE p.category_id = ?
                GROUP BY p.id, pi.image_url";

        if ($limit) {
            $sql .= " LIMIT " . (int)$limit;
        }

        return $this->query($sql, [$categoryId]);
    }

    public function getPopularProducts($limit = 8)
    {
        // ✅ ВИПРАВЛЕНИЙ SQL запит
        $sql = "SELECT p.*, pi.image_url as main_image,
                       AVG(r.rating) as avg_rating,
                       COUNT(DISTINCT oi.id) as order_count
                FROM products p
                LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_main = 1
                LEFT JOIN reviews r ON p.id = r.product_id
                LEFT JOIN order_items oi ON p.id = oi.product_id
                GROUP BY p.id, pi.image_url
                ORDER BY order_count DESC, avg_rating DESC
                LIMIT {$limit}";

        return $this->query($sql);
    }

    public function getNewProducts($limit = 8)
    {
        // ✅ ВИПРАВЛЕНИЙ SQL запит
        $sql = "SELECT p.*, pi.image_url as main_image,
                       AVG(r.rating) as avg_rating
                FROM products p
                LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_main = 1
                LEFT JOIN reviews r ON p.id = r.product_id
                GROUP BY p.id, pi.image_url
                ORDER BY p.created_at DESC
                LIMIT {$limit}";

        return $this->query($sql);
    }

    // ✅ МЕТОД ДЛЯ ЗМЕНШЕННЯ КІЛЬКОСТІ НА СКЛАДІ
    public function decreaseStock($productId, $quantity)
    {
        $sql = "UPDATE products SET stock = stock - ? WHERE id = ? AND stock >= ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$quantity, $productId, $quantity]);
    }

    // ✅ НОВИЙ МЕТОД ДЛЯ ЗБІЛЬШЕННЯ КІЛЬКОСТІ НА СКЛАДІ
    public function increaseStock($productId, $quantity)
    {
        $sql = "UPDATE products SET stock = stock + ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$quantity, $productId]);
    }

    public function addProductImage($productId, $imageUrl, $isMain = false)
    {
        if ($isMain) {
            // Спочатку знімаємо прапорець is_main з інших зображень
            $sql = "UPDATE product_images SET is_main = 0 WHERE product_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$productId]);
        }

        $sql = "INSERT INTO product_images (product_id, image_url, is_main) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$productId, $imageUrl, $isMain ? 1 : 0]);
    }

    // ✅ НОВИЙ МЕТОД ДЛЯ ВСТАНОВЛЕННЯ ГОЛОВНОГО ЗОБРАЖЕННЯ
    public function setMainImage($imageId, $productId)
    {
        try {
            // Спочатку знімаємо прапорець is_main з усіх зображень товару
            $sql = "UPDATE product_images SET is_main = 0 WHERE product_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$productId]);

            // Потім встановлюємо головне зображення
            $sql = "UPDATE product_images SET is_main = 1 WHERE id = ? AND product_id = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$imageId, $productId]);
        } catch (PDOException $e) {
            error_log("Error setting main image: " . $e->getMessage());
            return false;
        }
    }

    // ✅ НОВИЙ МЕТОД ДЛЯ ВИДАЛЕННЯ ЗОБРАЖЕННЯ
    public function deleteImage($imageId)
    {
        try {
            // Отримуємо інформацію про зображення перед видаленням
            $sql = "SELECT * FROM product_images WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$imageId]);
            $image = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$image) {
                return false;
            }

            // Видаляємо файл зображення
            if (!empty($image['image_url']) && file_exists($image['image_url'])) {
                unlink($image['image_url']);
            }

            // Видаляємо запис з бази даних
            $sql = "DELETE FROM product_images WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$imageId]);
        } catch (PDOException $e) {
            error_log("Error deleting image: " . $e->getMessage());
            return false;
        }
    }
}
