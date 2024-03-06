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
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>

<body>


	<!-- End Banner Area -->

	<!--================Login Box Area =================-->
	<section class="login_box_area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<img class="img-fluid" src="img/login.jpg" alt="">
						<div class="hover">
							<h4>New to our website?</h4>
							<p>There are advances being made in science and technology everyday, and a good example of
								this is the</p>
							<a class="primary-btn" href="dang_ky.php">Create an Account</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Log in to enter</h3>
						<form class="row login_form" action="login.php" method="post" id="loginForm">
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="username" name="username" placeholder="Tên người dùng" required>
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" required>
							</div>
							<div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" id="f-option2" name="selector">
									<label for="f-option2">Ghi nhớ tôi</label>
								</div>
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" class="primary-btn">Đăng nhập</button>
								<a href="forgot_password.php">Quên mật khẩu?</a>
								<a style="background-color: #22d3ee; border-radius: 10px; color:white;" href="index.php">Trở về trang chủ</a>

							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

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
	session_start();

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "karmashop";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Kết nối không thành công: " . $conn->connect_error);
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM users WHERE username='$username'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			if (password_verify($password, $row['password'])) {
				$_SESSION['username'] = $username;
				if ($row['isAdmin'] == 1) {
					$_SESSION['isAdmin'] = true;
					echo '<script>
                Swal.fire({
                  title: "Good job!",
                  text: "Đăng nhập thành công!",
                  icon: "success"
                }).then(function() {
                    window.location = " admin_dashboard.php";
                });
              </script>';
				} else {
					$_SESSION['isAdmin'] = false;
					echo '<script>
                Swal.fire({
                  title: "Good job!",
                  text: "Đăng nhập thành công!",
                  icon: "success"
                }).then(function() {
                    window.location = " index.php";
                });
              </script>';
				}
				exit();
			} else {
				echo '<script>
                Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "Sai tài khoản hoặc mật khẩu"
				  });
              </script>';
			}
		} else {
			echo '<script>
                Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "Tài khoản không tồn tại."
				  });
              </script>';
		}
	}

	$conn->close();
	?>


</body>

</html>