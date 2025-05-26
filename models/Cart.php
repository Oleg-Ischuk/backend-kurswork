<?php
// models/Cart.php
class Cart {
    
    public static function add($productId, $quantity = 1) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] += $quantity;
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }
    }
    
    public static function update($productId, $quantity) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
        if ($quantity <= 0) {
            unset($_SESSION['cart'][$productId]);
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }
    }
    
    public static function remove($productId) {
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }
    }
    
    public static function get() {
        return $_SESSION['cart'] ?? [];
    }
    
    public static function clear() {
        $_SESSION['cart'] = [];
    }
    
    public static function getCount() {
        $cart = self::get();
        return array_sum($cart);
    }
    
    public static function getTotal() {
        $cart = self::get();
        $total = 0;
        
        if (!empty($cart)) {
            $productModel = new Product();
            foreach ($cart as $productId => $quantity) {
                $product = $productModel->find($productId);
                if ($product) {
                    $total += $product['price'] * $quantity;
                }
            }
        }
        
        return $total;
    }
    
    public static function getItems() {
        $cart = self::get();
        $items = [];
        
        if (!empty($cart)) {
            $productModel = new Product();
            foreach ($cart as $productId => $quantity) {
                $product = $productModel->getProductWithDetails($productId);
                if ($product) {
                    $product['quantity'] = $quantity;
                    $product['subtotal'] = $product['price'] * $quantity;
                    $items[] = $product;
                }
            }
        }
        
        return $items;
    }
}
?>