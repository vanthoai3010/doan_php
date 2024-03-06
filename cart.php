<?php
session_start();

?>
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
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/nouislider.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    <style>
        .product-table {
            width: 100%;
            border-collapse: collapse;
        }

        .product-table th,
        .product-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .product-table th {
            background-color: white;
        }

        .total-price {
            margin-top: 50px;
            float: right;
            font-weight: bold;
            font-size: 18px;
            /* Tùy chỉnh kích thước phù hợp */

            color: #333;
            /* Tùy chỉnh màu sắc phù hợp */
        }

        .continue-shopping {
            display: inline-block;
            background-color: #009EF7;
            /* Màu nền của nút */
            color: white;
            /* Màu chữ */
            padding: 10px 20px;
            /* Kích thước lề và góc bo của nút */
            text-align: center;
            /* Căn chỉnh văn bản vào giữa */
            text-decoration: none;
            /* Loại bỏ đường kẻ dưới chữ */
            border-radius: 5px;
            /* Bo góc của nút */
            transition: background-color 0.3s;
            /* Hiệu ứng chuyển đổi màu nền */
        }

        .continue-shopping:hover {
            background-color: black;
            color: white;
            /* Màu nền khi di chuột vào */
        }
    </style>
</head>

<body>

    <!-- Start Header Area -->
    <header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="index.php"><img src="img/logo.png" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Shop</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="danh-muc-sp.php">Danh mục sản phẩm</a></li>
                                    <li class="nav-item"><a class="nav-link" href="thanh-toan.php">Thanh toán</a></li>
                                    <li class="nav-item"><a class="nav-link" href="cart.php">Giỏ hàng</a></li>
                                </ul>
                            </li>

                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Người Dùng</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="login.php">Đăng nhập</a></li>
                                    <li class="nav-item"><a class="nav-link" href="dang_ky.php">Đăng ký</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="contact.html">Liên hệ</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
							<li class="nav-item">
								<form id="searchForm" action="search.php" method="GET">
									<input class=" form-control" type="text" id="searchInput" name="keyword" class="search-input" placeholder="Tìm kiếm sản phẩm... ">
								</form>
							</li>
						</ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container">
                <form class="d-flex justify-content-between">
                    <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                    <button type="submit" class="btn"></button>
                    <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </header>
    <!-- End Header Area -->

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Trang giỏ hàng</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Cart</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>

                        </thead>
                        <tbody>
                            <?php
                            // Kiểm tra xem có sản phẩm nào được thêm vào giỏ hàng hay không
                            if (isset($_POST['add_cart'])) {
                                $product_id = $_POST['product_id'];

                                // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
                                $is_product_exist = false;
                                foreach ($_SESSION['gio_hang'] as &$product) {
                                    if ($product['id'] == $product_id) {
                                        $product['quantity']++; // Tăng số lượng sản phẩm
                                        $is_product_exist = true;
                                        break;
                                    }
                                }
                                unset($product); // Hủy tham chiếu

                                // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm sản phẩm mới vào giỏ hàng
                                if (!$is_product_exist) {
                                    $product = array(
                                        'id' => $_POST['product_id'],
                                        'name' => $_POST['product_name'],
                                        'price' => $_POST['product_price'],
                                        'img' => $_POST['product_img'],
                                        'quantity' => $_POST['product_quantity']
                                    );
                                    $_SESSION['gio_hang'][] = $product;
                                }
                            }

                            // Cập nhật số lượng sản phẩm khi nút "+" được nhấn
                            if (isset($_POST['increase_quantity'])) {
                                $product_id = $_POST['product_id'];
                                foreach ($_SESSION['gio_hang'] as &$product) {
                                    if ($product['id'] == $product_id) {
                                        $product['quantity']++;
                                        break;
                                    }
                                }
                                unset($product); // Hủy tham chiếu
                            }

                            // Cập nhật số lượng sản phẩm khi nút "-" được nhấn
                            if (isset($_POST['decrease_quantity'])) {
                                $product_id = $_POST['product_id'];
                                foreach ($_SESSION['gio_hang'] as &$product) {
                                    if ($product['id'] == $product_id) {
                                        if ($product['quantity'] > 1) {
                                            $product['quantity']--;
                                        }
                                        break;
                                    }
                                }
                                unset($product); // Hủy tham chiếu
                            }

                            // Xóa sản phẩm khỏi giỏ hàng
                            if (isset($_POST['remove_product'])) {
                                $product_id = $_POST['product_id'];
                                foreach ($_SESSION['gio_hang'] as $key => $product) {
                                    if ($product['id'] == $product_id) {
                                        unset($_SESSION['gio_hang'][$key]);
                                        break;
                                    }
                                }
                            }

                            $total = 0;

                            // Hiển thị tất cả các sản phẩm trong giỏ hàng trong một bảng
                            echo "<table class='product-table'>";
                            echo "<tr>
<th>Tên sản phẩm</th>
<th>Hình ảnh</th>
<th>Giá</th>
<th>Số lượng</th>
<th>Xóa sản phẩm</th>
</tr>";

                            foreach ($_SESSION['gio_hang'] as $product) {
                                echo "<tr>";
                                echo "<td>" . $product['name'] . "</td>";
                                echo "<td><img src='" . $product['img'] . "' alt='' style='width: 100px; height: auto;'></td>";
                                echo "<td>" . (is_numeric($product['price']) ? number_format($product['price'], 0, ',', '.') : 'Invalid Price') . "</td>";
                                echo "<td>
    <form method='post'>
    <input type='hidden' name='product_id' value='" . $product['id'] . "'>
    <input type='hidden' name='current_quantity' value='" . $product['quantity'] . "'>
    <button type='submit' name='decrease_quantity' class='btn btn-secondary'>-</button>
    " . $product['quantity'] . "
    <button type='submit' name='increase_quantity' class='btn btn-secondary'>+</button>
    </form>
    </td>";
                                echo "<td>
    <form method='post'>
    <input type='hidden' name='product_id' value='" . $product['id'] . "'>
    <button type='submit' name='remove_product' class='btn btn-danger'>Xóa sản phẩm</button>
    </form>
    </td>";
                                echo "</tr>";

                                // Kiểm tra giá sản phẩm là số hợp lệ trước khi tính toán tổng tiền
                                if (is_numeric($product['price'])) {
                                    $total += $product['price'] * $product['quantity'];
                                }
                            }
                            echo "</table>";

                            // Hiển thị tổng tiền
                            ?>


                            <div class="total-price">
                                Tổng tiền phải thanh toán: <?php echo number_format($total, 0, ',', '.') ?> VNĐ <br>
                                <a style="position: relative; left:100px;" href="thanh-toan.php" class="continue-shopping ">Thanh toán</a>
                            </div>

                            <br>
                            <div>
                                <a href="index.php" class="continue-shopping">Tiếp tục mua sắm</a>
                            </div>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->

    <!-- start footer Area -->
    <footer class="footer-area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>About Us</h6>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                            ut labore dolore
                            magna aliqua.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Newsletter</h6>
                        <p>Stay update with our latest</p>
                        <div class="" id="mc_embed_signup">

                            <form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">

                                <div class="d-flex flex-row">

                                    <input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '" required="" type="email">


                                    <button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                                    <div style="position: absolute; left: -5000px;">
                                        <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                                    </div>

                                    <!-- <div class="col-lg-4 col-md-4">
													<button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
												</div>  -->
                                </div>
                                <div class="info"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget mail-chimp">
                        <h6 class="mb-20">Instragram Feed</h6>
                        <ul class="instafeed d-flex flex-wrap">
                            <li><img src="img/i1.jpg" alt=""></li>
                            <li><img src="img/i2.jpg" alt=""></li>
                            <li><img src="img/i3.jpg" alt=""></li>
                            <li><img src="img/i4.jpg" alt=""></li>
                            <li><img src="img/i5.jpg" alt=""></li>
                            <li><img src="img/i6.jpg" alt=""></li>
                            <li><img src="img/i7.jpg" alt=""></li>
                            <li><img src="img/i8.jpg" alt=""></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Follow Us</h6>
                        <p>Let us be social</p>
                        <div class="footer-social d-flex align-items-center">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-dribbble"></i></a>
                            <a href="#"><i class="fa fa-behance"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
                <p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
        </div>
    </footer>
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


</body>

</html>