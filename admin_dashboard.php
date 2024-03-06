<html>

<head>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

</html>
<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "karmashop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Xử lý xóa sản phẩm
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = $_GET['delete'];

    // Thực hiện truy vấn SQL để xóa sản phẩm có ID tương ứng
    $sql = "DELETE FROM sneaker_products WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo '<script>
        Swal.fire({
            title: "Good job!",
            text: "Xóa sản phẩm thành công!",
            icon: "success"
        });
    </script>';
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}
// Xử lý yêu cầu xóa user
if (isset($_GET['delete_user']) && is_numeric($_GET['delete_user'])) {
    $user_id = $_GET['delete_user'];

    // Thực hiện truy vấn SQL để xóa user có ID tương ứng
    $sql = "DELETE FROM users WHERE id=$user_id";

    if ($conn->query($sql) === TRUE) {
        echo '<script>
        Swal.fire({
            title: "Good job!",
            text: "Xóa user thành công!",
            icon: "success"
        });
    </script>';
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}
// Xử lý yêu cầu cập nhật quyền của người dùng
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_admin'])) {
    $user_id = $_POST['user_id'];
    $new_role = $_POST['isAdmin'];

    // Thực hiện truy vấn SQL để cập nhật quyền của người dùng
    $sql = "UPDATE users SET isAdmin=$new_role WHERE id=$user_id";

    if ($conn->query($sql) === TRUE) {
        echo '<script>
        Swal.fire({
            title: "Good job!",
            text: "Cập nhật quyền thành công!",
            icon: "success"
        });
    </script>';
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}


// Xử lý chỉnh sửa thông tin sản phẩm
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $ten = $_POST['ten'];
    $gia = $_POST['gia'];
    $danh_muc = $_POST['danh_muc'];
    $thong_tin_chi_tiet = $_POST['thong_tin_chi_tiet'];
    $chieu_rong = $_POST['chieu_rong'];
    $chieu_cao = $_POST['chieu_cao'];
    $can_nang = $_POST['can_nang'];
    $hinh_anh = $_POST['hinh_anh'];
    $quantity = $_POST['quantity'];

    // Thực hiện truy vấn SQL để cập nhật thông tin sản phẩm
    $sql = "UPDATE sneaker_products SET 
            ten='$ten', gia='$gia', danh_muc='$danh_muc', thong_tin_chi_tiet='$thong_tin_chi_tiet', 
            chieu_rong='$chieu_rong', chieu_cao='$chieu_cao', can_nang='$can_nang', hinh_anh='$hinh_anh', 
            quantity='$quantity' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo '<script>
        Swal.fire({
            title: "Good job!",
            text: "Cập nhật thành công!",
            icon: "success"
        });
    </script>';
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

// Xử lý dữ liệu khi form thêm sản phẩm được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $ten = $_POST['ten'];
    $gia = $_POST['gia'];
    $danh_muc = $_POST['danh_muc'];
    $thong_tin_chi_tiet = $_POST['thong_tin_chi_tiet'];
    $chieu_rong = $_POST['chieu_rong'];
    $chieu_cao = $_POST['chieu_cao'];
    $can_nang = $_POST['can_nang'];
    $hinh_anh = $_POST['hinh_anh'];
    $quantity = $_POST['quantity'];

    // Thực hiện truy vấn SQL để chèn sản phẩm mới vào cơ sở dữ liệu
    $sql = "INSERT INTO sneaker_products (ten, gia, danh_muc, thong_tin_chi_tiet, chieu_rong, chieu_cao, can_nang, hinh_anh, quantity)
            VALUES ('$ten', '$gia', '$danh_muc', '$thong_tin_chi_tiet', '$chieu_rong', '$chieu_cao', '$can_nang', '$hinh_anh', '$quantity')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>
    Swal.fire({
        title: "Good job!",
        text: "Thêm sản phẩm thành công!",
        icon: "success"
    });
</script>';
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

// Lấy và hiển thị danh sách sản phẩm
$sql = "SELECT * FROM sneaker_products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .submit-btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .container {
            margin-top: 50px;
        }

        /* Màu cho các cột */
        .table th {
            background-color: #1E293B;
            /* Màu nền */
            color: white;
            /* Màu chữ */
        }

        .table td {
            background-color: #828BB2;
            color: white;
        }

        /* Màu cho hàng chẵn */
        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Màu khi di chuột qua hàng */
        .table tbody tr:hover {
            background-color: #ddd;
        }

        /* Màu cho nút Sửa */
        .btn-edit {
            background-color: #28a745;
            color: white;
        }

        /* Màu cho nút Xóa */
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>

<body>
    <h1 style="background-color: black; color:white; text-align:center;">Welcome Admin!</h1>

    <div style="width:500px;" class="container">
        <h2>Thêm sản phẩm mới</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label class=" form-label " for="ten">Tên sản phẩm:</label><br>
            <input class=" form-control " type="text" id="ten" name="ten" required><br>

            <label class=" form-label " for="gia">Giá:</label><br>
            <input class=" form-control " type="text" id="gia" name="gia" required><br>

            <label class=" form-label " for="danh_muc">Danh mục:</label><br>
            <input class=" form-control " type="text" id="danh_muc" name="danh_muc" required><br>

            <label class=" form-label " for="thong_tin_chi_tiet">Thông tin chi tiết:</label><br>
            <textarea class=" form-control " id="thong_tin_chi_tiet" name="thong_tin_chi_tiet" required></textarea><br>

            <label class=" form-label " for="chieu_rong">Chiều rộng:</label><br>
            <input class=" form-control " type="text" id="chieu_rong" name="chieu_rong" required><br>

            <label class=" form-label " for="chieu_cao">Chiều cao:</label><br>
            <input class=" form-control " type="text" id="chieu_cao" name="chieu_cao" required><br>

            <label class=" form-label " for="can_nang">Cân nặng:</label><br>
            <input class=" form-control " type="text" id="can_nang" name="can_nang" required><br>

            <label class=" form-label " for="hinh_anh">Link hình ảnh:</label><br>
            <input class=" form-control " type="text" id="hinh_anh" name="hinh_anh" required><br>

            <label class=" form-label " for="quantity">Số lượng:</label><br>
            <input class=" form-control " type="text" id="quantity" name="quantity" required><br>

            <input class="btn btn-primary " type="submit" name="submit" value="Thêm">
        </form>
    </div>

    <div class="container">
        <h2>Danh sách sản phẩm</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<th scope='row'>" . $row['id'] . "</th>";
                        echo "<td><img style='width: 100px;' src='" . $row['hinh_anh'] . "' alt='Hình ảnh'></td>";
                        echo "<td>" . $row['ten'] . "</td>";
                        echo "<td>" . $row['gia'] . "</td>";
                        echo "<td>" . $row['danh_muc'] . "</td>";
                        echo "<td>
                            <a href='edit_product.php?id=" . $row['id'] . "' class='btn btn-primary'>Sửa</a> 
                            <a href='admin_dashboard.php?delete=" . $row['id'] . "' class='btn btn-danger'>Xóa</a>
                          </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Không có sản phẩm nào trong cơ sở dữ liệu.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="container">
        <h1>Danh sách user đã đăng ký</h1>
        <?php
        $sql1 = "SELECT * FROM users";
        $result = $conn->query($sql1);

        if ($result->num_rows > 0) {
            echo "<table class='table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th scope='col'>ID</th>";
            echo "<th scope='col'>Username</th>";
            echo "<th scope='col'>Email</th>";
            echo "<th scope='col'>Quyền</th>"; // Thêm cột quyền vào tiêu đề bảng
            echo "<th scope='col'></th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>";
                echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>"; // Mở form
                echo "<input type='hidden' name='user_id' value='" . $row['id'] . "'>"; 
                echo "<select  class='btn btn-success' name='isAdmin'>"; // Dropdown quyền
                echo "<option value='0' " . ($row['isAdmin'] == 0 ? 'selected' : '') . ">Người dùng</option>"; // Lựa chọn quyền người dùng
                echo "<option value='1' " . ($row['isAdmin'] == 1 ? 'selected' : '') . ">Admin</option>"; // Lựa chọn quyền quản trị viên
                echo "</select>"; // Đóng dropdown
                echo "<input type='submit' class='btn btn-primary ' name='update_admin' value='Cập nhật'>"; // Nút cập nhật
                echo "</form>"; // Đóng form
                echo "</td>";
                echo "<td>
                <a href='admin_dashboard.php?delete_user=" . $row['id'] . "' class='btn btn-danger'>Xóa</a>
                </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "Không có user nào đã đăng ký.";
        }
        ?>
    </div>


    <a href="index.php">Về trang chủ</a>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>