<?php
include_once("check_login.php");
include_once("connectdb.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // ลบรูปภาพออกจากโฟลเดอร์ images
    $res = mysqli_query($conn, "SELECT p_img FROM product WHERE p_id = '$id'");
    $data = mysqli_fetch_array($res);
    if($data['p_img']) { unlink("images/" . $data['p_img']); }

    $sql = "DELETE FROM product WHERE p_id = '$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: products.php");
    }
}
?>