<?php
session_start();
session_destroy(); // ทำลาย Session ทั้งหมด
header("Location: login.php"); // ส่งกลับไปหน้า Login (หรือหน้าแรกที่คุณต้องการ)
exit();
?>