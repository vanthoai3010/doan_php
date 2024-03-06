<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

session_start();
require_once "db_connection.php";

// Kiểm tra xem token reset password được truyền từ email có hợp lệ không
if (empty($_GET['token'])) {
    $_SESSION['status'] = "Invalid reset token.";
    header("Location: forgot_password.php");
    exit;
}

$token = $_GET['token'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE reset_token = ? AND reset_token_expire >= ?");
$stmt->execute([$token, date("Y-m-d H:i:s")]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    $_SESSION['status'] = "Invalid or expired reset token.";
    header("Location: forgot_password.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Kiểm tra mật khẩu và xác nhận mật khẩu có khớp nhau không
    if ($password !== $confirm_password) {
        $_SESSION['status'] = "mật khẩu không khớp";
        header("Location: reset_password.php?token=$token");
        exit;
    }

    // Hash mật khẩu mới và cập nhật vào cơ sở dữ liệu
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expire = NULL WHERE email = ?");
    $stmt->execute([$hashed_password, $user['email']]);

    $_SESSION['status'] = "Thay đổi mật khẩu thành công. Bây giờ bạn có thể đăng nhập bằng mật khẩu mới.";
    header("Location: login.php");
    exit;
}
?>

<!-- HTML Form -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Reset Password</title>
</head>

<body>
    <?php if (isset($_SESSION['status'])) : ?>
        <div class="alert alert-success">
            <h5><?= $_SESSION['status']; ?></h5>
        </div>
        <?php unset($_SESSION['status']); ?>
    <?php endif; ?>

    <div class="card container ">
        <div class="card-header">
            <h5>Thay đổi mật khẩu</h5>
        </div>
        <div class="card-body p-4">
            <form action="" method="POST">
                <div class="form-group mb-3">
                    <label>Mật khẩu mới</label>
                    <input type="password" name="password" class="form-control" placeholder="Mật khẩu mới">
                </div>
                <div class="form-group mb-3">
                    <label>Xác nhận mật khẩu mới</label>
                    <input type="password" name="confirm_password" class="form-control" placeholder="Xác nhận mật khẩu mới">
                </div>
                <button type="submit" class="btn btn-primary">Thay đổi mật khẩu</button>
            </form>
        </div>
    </div>
</body>

</html>