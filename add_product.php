<?php
include_once("check_login.php");
include_once("connectdb.php");

if (isset($_POST['Submit'])) {
    $p_name = mysqli_real_escape_string($conn, $_POST['p_name']);
    $p_price = $_POST['p_price'];
    
    // อัปโหลดรูปภาพ
    $ext = pathinfo(basename($_FILES['p_img']['name']), PATHINFO_EXTENSION);
    $new_img_name = 'bunnii_' . uniqid() . "." . $ext;
    move_uploaded_file($_FILES['p_img']['tmp_name'], "images/" . $new_img_name);

    $sql = "INSERT INTO product (p_name, p_price, p_img) VALUES ('$p_name', '$p_price', '$new_img_name')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('เพิ่มกล่องสุ่มใหม่เรียบร้อย!'); window.location='products.php';</script>";
    }
}
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <title>Add Product - Bunnii Box</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 p-10 font-['Sarabun'] flex justify-center">
    <div class="bg-white p-10 rounded-[3rem] shadow-xl w-full max-w-lg">
        <h2 class="text-3xl font-bold text-pink-500 mb-8 font-['Itim'] text-center">✨ เพิ่มกล่องสุ่มใหม่</h2>
        <form method="post" enctype="multipart/form-data" class="space-y-6">
            <input type="text" name="p_name" placeholder="ชื่อคอลเลกชันสินค้า" class="w-full p-4 border-2 border-pink-50 rounded-2xl outline-none focus:border-pink-300" required>
            <input type="number" name="p_price" placeholder="ราคา (บาท)" class="w-full p-4 border-2 border-pink-50 rounded-2xl outline-none focus:border-pink-300" required>
            <div class="p-6 border-2 border-dashed border-pink-100 rounded-3xl text-center">
                <p class="text-gray-400 mb-2">เลือกรูปภาพสินค้า</p>
                <input type="file" name="p_img" class="text-sm text-gray-500" required>
            </div>
            <button type="submit" name="Submit" class="w-full bg-gradient-to-r from-pink-500 to-purple-500 text-white p-4 rounded-2xl font-bold shadow-lg hover:scale-105 transition">บันทึกสินค้าลงคลัง</button>
            <a href="products.php" class="block text-center text-gray-400 mt-4">กลับไปหน้าคลังสินค้า</a>
        </form>
    </div>
</body>
</html>