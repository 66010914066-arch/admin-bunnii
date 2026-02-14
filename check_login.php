<?php
session_start();
if (empty($_SESSION['aid'])) {
    echo "<div style='font-family:sans-serif; text-align:center; margin-top:100px;'>";
    echo "<h2 style='color:#8b5cf6;'>🔮 Oops! กรุณาล็อกอินเข้าสู่ Bunnii Box ก่อนนะ</h2>";
    echo "<meta http-equiv='refresh' content='2; url=login.php'>";
    echo "</div>";
    exit;
}
?>