<?php
session_start();

// Kiểm tra xem product_id và action đã được gửi lên không
if(isset($_GET['product_id']) && isset($_GET['action']) && $_GET['action'] == 'add') {
    // Thêm sản phẩm vào giỏ hàng ở đây
    $product_id = $_GET['product_id'];
    // Thực hiện các thao tác cần thiết, như thêm sản phẩm vào session giỏ hàng
    $_SESSION['cart'][$product_id] = $product_id;
}

// Sau khi thêm sản phẩm vào giỏ hàng, bạn có thể chuyển hướng người dùng đến trang cart.php hoặc bất kỳ trang nào khác bạn muốn

exit;
?>
