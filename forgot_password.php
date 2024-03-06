<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>

</html>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

session_start();
require_once "db_connection.php";

// Kiểm tra nếu người dùng đã gửi email
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = $_POST["email"];

    // Kiểm tra xem email tồn tại trong cơ sở dữ liệu hay không
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Tạo và lưu token reset password vào cơ sở dữ liệu
        $token = bin2hex(random_bytes(32));
        $expire = date("Y-m-d H:i:s", strtotime("+1 hour"));
        $stmt = $pdo->prepare("UPDATE users SET reset_token = ?, reset_token_expire = ? WHERE email = ?");
        $stmt->execute([$token, $expire, $email]);

        // Gửi email chứa liên kết reset password
        $reset_link = "http://localhost:70/PHP/php_doan/reset_password.php?token=$token";

        // Sử dụng PHPMailer để gửi email
        $mail = new PHPMailer(true);
        try {
            // Cài đặt thông tin SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Thay thế bằng SMTP server của bạn
            $mail->SMTPAuth = true;
            $mail->Username = 'bathangkhung098@gmail.com'; // Thay thế bằng username của bạn
            $mail->Password = 'mlxq ydrw byws qbmb
            '; // Thay thế bằng password của bạn
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Cài đặt thông tin email
            $mail->setFrom('your_email@example.com', 'Your Name');
            $mail->addAddress($email);

            // Cài đặt tiêu đề và nội dung email
            $mail->isHTML(true);
            $mail->Subject = 'Reset Your Password';
            $mail->Body = "Click the link below to reset your password:<br><a href='$reset_link'>$reset_link</a>";

            $mail->send();
            $_SESSION['status'] = "Liên kết đã được gửi về hòm thư của bạn. Vui lòng kiểm tra hòm thư để thay đổi mật khẩu.";
        } catch (Exception $e) {
            $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        header("Location: forgot_password.php");
        exit;
    } else {
        $_SESSION['status'] = "Không tìm thấy email trong cơ sở dữ liệu. Vui lòng kiểm tra lại.";
        header("Location: forgot_password.php");
        exit;
    }
}
?>

<!-- HTML Form -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
                    <label>Nhập vào email của bạn </label>
                    <input type="email" name="email" class="form-control" placeholder="Enter Email Address">
                </div>
                <button type="submit" class="btn btn-primary">Gửi link thay đổi</button>
            </form>
        </div>
    </div>
</body>

</html>