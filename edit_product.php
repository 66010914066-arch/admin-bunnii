<?php
include_once("check_login.php");
include_once("connectdb.php");

$id = $_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM product WHERE p_id = '$id'");
$row = mysqli_fetch_array($res);

if (isset($_POST['Submit'])) {
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    
    // เช็คว่ามีการเปลี่ยนรูปไหม
    if ($_FILES['p_img']['name'] != "") {
        $ext = pathinfo(basename($_FILES['p_img']['name']), PATHINFO_EXTENSION);
        $new_img_name = 'img_' . uniqid() . "." . $ext;
        move_uploaded_file($_FILES['p_img']['tmp_name'], "images/" . $new_img_name);
        $img_update = ", p_img = '$new_img_name'";
    } else {
        $img_update = "";
    }

    $sql = "UPDATE product SET p_name = '$p_name', p_price = '$p_price' $img_update WHERE p_id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('แก้ไขข้อมูลเรียบร้อย!'); window.location='products.php';</script>";
    }
}
?>