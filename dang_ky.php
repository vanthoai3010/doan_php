<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Site Title -->
    <title>Karma Shop</title>

    <!--
		CSS
		============================================= -->
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/nouislider.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>


    <!-- End Header Area -->

    <!-- Start Banner Area -->

    <!-- End Banner Area -->
    <section class="vh-100 bg-image" style="background-image: url('https://moc247.com/wp-content/uploads/2023/12/hinh-nen-den-trang_2.jpg');">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px; background-color:black;">
                            <div class="card-body p-5">
                                <h2 style="color: white;" class="text-uppercase text-center mb-5">Create an account</h2>

                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                                    <label style="color: white;" class="form-label" for="form3Example1cg" for="username">Tên người dùng:</label>
                                    <input class="form-control form-control-lg" type="text" name="username" required><br><br>

                                    <label style="color: white;" class="form-label" for="form3Example1cg" for="email">Email:</label>
                                    <input class="form-control form-control-lg" type="email" name="email" required><br><br>

                                    <label style="color: white;" class="form-label" for="form3Example1cg" for="password">Mật khẩu:</label>
                                    <input class="form-control form-control-lg" type="password" name="password" required><br><br>
                                    <div class="form-outline mb-4">
                                        <label style="color: white;" class="form-label" for="form3Example4cdg">Nhập lại mật khẩu</label>
                                        <input type="password" id="form3Example4cdg" class="form-control form-control-lg" />
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                                    </div>

                                    <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="login.php" class="fw-bold text-body"><u>Login here</u></a></p>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Login Box Area =================-->
    <!--================End Login Box Area =================-->

    <!-- start footer Area -->

    <!-- End footer Area -->


    <script src="js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/nouislider.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="js/gmaps.min.js"></script>
    <script src="js/main.js"></script>
    <?php
    // Kết nối đến cơ sở dữ liệu
    $servername = "localhost";
    $username = "root"; // Thay username bằng tên người dùng MySQL của bạn
    $password = ""; // Thay password bằng mật khẩu của bạn
    $dbname = "karmashop"; // Thay mydatabase bằng tên cơ sở dữ liệu của bạn

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối không thành công: " . $conn->connect_error);
    }

    // Xử lý dữ liệu khi form được gửi đi
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Mã hóa mật khẩu
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Chèn dữ liệu vào bảng
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>
                Swal.fire({
                  title: "Good job!",
                  text: "Đăng ký thành công!",
                  icon: "success"
                }).then(function() {
                    window.location = "login.php";
                });
              </script>';
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
    ?>

</body>

</html>