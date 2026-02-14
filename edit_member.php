<?php
include_once("check_login.php");
include_once("connectdb.php");

$id = $_GET['id'];
$sql = "SELECT * FROM member WHERE m_id = '$id'";
$res = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($res);

if (isset($_POST['Submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['m_name']);
    $user = mysqli_real_escape_string($conn, $_POST['m_user']);
    
    $sql_update = "UPDATE member SET m_name = '$name', m_user = '$user' WHERE m_id = '$id'";
    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('แก้ไขข้อมูลสมาชิกสำเร็จ!'); window.location='customers.php';</script>";
    }
}
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <title>Edit Member - Bunnii Box</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&family=Itim&display=swap" rel="stylesheet">
</head>
<body class="bg-pink-50 flex items-center justify-center min-h-screen font-['Sarabun']">
    <div class="bg-white p-10 rounded-[3rem] shadow-xl w-full max-w-md border border-pink-100">
        <h2 class="text-3xl font-bold text-pink-500 mb-8 font-['Itim'] text-center">🐰 แก้ไขข้อมูลสมาชิก</h2>
        <form method="post" class="space-y-6">
            <input type="text" name="m_name" value="<?php echo $data['m_name']; ?>" placeholder="ชื่อ-นามสกุล" class="w-full p-4 border-2 border-pink-50 rounded-2xl outline-none focus:border-pink-300" required>
            <input type="text" name="m_user" value="<?php echo $data['m_user']; ?>" placeholder="Username" class="w-full p-4 border-2 border-pink-50 rounded-2xl outline-none focus:border-pink-300" required>
            <div class="flex gap-4">
                <button type="submit" name="Submit" class="flex-1 bg-pink-500 text-white p-4 rounded-2xl font-bold shadow-lg hover:bg-pink-600 transition">บันทึก</button>
                <a href="customers.php" class="flex-1 bg-gray-100 text-gray-400 p-4 rounded-2xl font-bold text-center">ยกเลิก</a>
            </div>
        </form>
    </div>
</body>
</html>