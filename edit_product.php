<html>

<head>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

</html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "karmashop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

$product_id = $_GET['id'];

$sql = "SELECT * FROM sneaker_products WHERE id='$product_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    echo "Không tìm thấy sản phẩm";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image']; // Lấy giá trị của trường nhập liệu hình ảnh

    $sql_update = "UPDATE sneaker_products SET ten='$name', thong_tin_chi_tiet='$description', gia='$price', hinh_anh='$image' WHERE id='$product_id'";
    if ($conn->query($sql_update) === TRUE) {
        echo '<script>
    Swal.fire({
        title: "Good job!",
        text: "Cập nhật sản phẩm thành công!",
        icon: "success"
    });
</script>';
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Chỉnh sửa sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <h2 style="background-color: black; color:white;">Chỉnh sửa sản phẩm:</h2>
        <form action="edit_product.php?id=<?php echo $product_id; ?>" method="post" enctype="multipart/form-data">
            <label class="form-label" for="name">Tên sản phẩm:</label><br>
            <input class="form-control" type="text" id="name" name="name" value="<?php echo $product['ten']; ?>" required><br><br>
            <label class="form-label" for="description">Mô tả:</label><br>
            <textarea class="form-control" id="description" name="description" required><?php echo $product['thong_tin_chi_tiet']; ?></textarea><br><br>
            <label class="form-label" for="price">Giá:</label><br>
            <input class="form-control" type="number" id="price" name="price" value="<?php echo $product['gia']; ?>" required><br><br>
            <label class="form-label" for="image">Hình ảnh:</label><br>
            <input class="form-control" type="text" id="image" name="image" value="<?php echo $product['hinh_anh']; ?>"><br><br> <!-- Hiển thị giá trị hình ảnh hiện tại -->
            <input class="btn btn-primary " type="submit" value="Cập nhật">
            <a href="index.php">Về trang chủ</a>
        </form>
    </div>
</body>

</html>