<?php
// models/Cart.php
class Cart
{

    public static function add($productId, $quantity = 1)
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] += $quantity;
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }
    }

    public static function update($productId, $quantity)
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if ($quantity <= 0) {
            unset($_SESSION['cart'][$productId]);
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }
    }

    public static function remove($productId)
    {
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }
    }

    public static function get()
    {
        return $_SESSION['cart'] ?? [];
    }

    public static function clear()
    {
        $_SESSION['cart'] = [];
    }

    public static function getCount()
    {
        $cart = self::get();
        return array_sum($cart);
    }

    // ✅ ВИПРАВЛЕНИЙ МЕТОД - тепер враховує знижки
    public static function getTotal()
    {
        $cart = self::get();
        $total = 0;

        if (!empty($cart)) {
            $productModel = new Product();
            foreach ($cart as $productId => $quantity) {
                $product = $productModel->find($productId);
                if ($product) {
                    // Розраховуємо ціну зі знижкою
                    $price = $product['price'];
                    if ($product['discount'] > 0) {
                        $price = $product['price'] * (1 - $product['discount'] / 100);
                    }
                    $total += $price * $quantity;
                }
            }
        }

        return $total;
    }

    // ✅ ВИПРАВЛЕНИЙ МЕТОД - тепер додає розраховану ціну зі знижкою
    public static function getItems()
    {
        $cart = self::get();
        $items = [];

        if (!empty($cart)) {
            $productModel = new Product();
            foreach ($cart as $productId => $quantity) {
                // Отримуємо повну інформацію про товар з зображенням
                $sql = "SELECT p.*, c.name as category_name, b.name as brand_name,
                               pi.image_url as main_image,
                               AVG(r.rating) as avg_rating,
                               COUNT(r.id) as reviews_count
                        FROM products p
                        LEFT JOIN categories c ON p.category_id = c.id
                        LEFT JOIN brands b ON p.brand_id = b.id
                        LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_main = 1
                        LEFT JOIN reviews r ON p.id = r.product_id
                        WHERE p.id = ?
                        GROUP BY p.id";

                $product = $productModel->queryOne($sql, [$productId]);

                if ($product) {
                    // Розраховуємо ціну зі знижкою
                    $finalPrice = $product['price'];
                    if ($product['discount'] > 0) {
                        $finalPrice = $product['price'] * (1 - $product['discount'] / 100);
                    }

                    $product['quantity'] = $quantity;
                    $product['final_price'] = $finalPrice; // додаємо фінальну ціну
                    $product['subtotal'] = $finalPrice * $quantity; // використовуємо фінальну ціну
                    $items[] = $product;
                }
            }
        }

        return $items;
    }
}
