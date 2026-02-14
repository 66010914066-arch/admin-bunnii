<?php
include_once("check_login.php");
include_once("connectdb.php");

if (isset($_POST['Submit'])) {
    $p_name = mysqli_real_escape_string($conn, $_POST['p_name']);
    $p_price = $_POST['p_price'];
    
    // จัดการอัปโหลดรูปภาพ
    $ext = pathinfo(basename($_FILES['p_img']['name']), PATHINFO_EXTENSION);
    $new_img_name = 'bunnii_' . uniqid() . "." . $ext;
    $target_path = "images/" . $new_img_name;

    if (move_uploaded_file($_FILES['p_img']['tmp_name'], $target_path)) {
        $sql = "INSERT INTO product (p_name, p_price, p_img) VALUES ('$p_name', '$p_price', '$new_img_name')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('เย้! เพิ่มกล่องสุ่มใหม่สำเร็จแล้ว'); window.location='products.php';</script>";
        }
    } else {
        echo "<script>alert('อุ๊ย! อัปโหลดรูปภาพไม่สำเร็จ ตรวจสอบสิทธิ์โฟลเดอร์ images นะ');</script>";
    }
}
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <title>Add New Product - Bunnii Box</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&family=Itim&display=swap" rel="stylesheet">
    <style>body { font-family: 'Sarabun', sans-serif; background: #fdf2f8; } .font-itim { font-family: 'Itim', cursive; }</style>
</head>
<body class="flex items-center justify-center min-h-screen p-6">
    <div class="bg-white p-10 rounded-[3rem] shadow-xl w-full max-w-lg border border-pink-50">
        <h2 class="text-3xl font-bold text-pink-500 mb-8 text-center font-itim">✨ เพิ่มกล่องสุ่มชิ้นใหม่</h2>
        
        <form method="post" enctype="multipart/form-data" class="space-y-6">
            <div>
                <label class="block text-gray-400 mb-2 ml-2 text-sm">ชื่อคอลเลกชัน / สินค้า</label>
                <input type="text" name="p_name" placeholder="เช่น Labubu Macaron..." class="w-full p-4 border-2 border-pink-50 rounded-2xl outline-none focus:border-pink-300 transition" required>
            </div>
            
            <div>
                <label class="block text-gray-400 mb-2 ml-2 text-sm">ราคาขาย (บาท)</label>
                <input type="number" name="p_price" placeholder="0.00" class="w-full p-4 border-2 border-pink-50 rounded-2xl outline-none focus:border-pink-300 transition" required>
            </div>
            
            <div class="bg-pink-50/50 p-6 rounded-3xl border-2 border-dashed border-pink-200">
                <label class="block text-pink-500 mb-2 font-bold text-center">📸 เลือกรูปภาพสินค้า</label>
                <input type="file" name="p_img" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100" required>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" name="Submit" class="flex-1 bg-gradient-to-r from-pink-500 to-purple-500 text-white p-4 rounded-2xl font-bold shadow-lg hover:scale-105 transition-transform">
                    บันทึกสินค้า
                </button>
                <a href="products.php" class="flex-1 bg-gray-100 text-gray-400 p-4 rounded-2xl font-bold text-center hover:bg-gray-200 transition">
                    ยกเลิก
                </a>
            </div>
        </form>
    </div>
</body>
</html>