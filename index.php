<?php
session_start();
include_once("connectdb.php");
$error_msg = "";
if (isset($_POST['Submit'])) {
    $user = $_POST['auser'];
    $pwd = $_POST['apwd'];
    $stmt = mysqli_prepare($conn, "SELECT a_id, a_name, a_password FROM admin WHERE a_username = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($data = mysqli_fetch_array($result)) {
        if (password_verify($pwd, $data['a_password'])) {
            $_SESSION['aid'] = $data['a_id'];
            $_SESSION['aname'] = $data['a_name'];
            header("Location: index2.php");
            exit;
        } else { $error_msg = "รหัสผ่านไม่ถูกต้อง ลองสุ่มใหม่อีกครั้งนะ!"; }
    } else { $error_msg = "ไม่พบชื่อผู้ใช้นี้ในระบบ Bunnii"; }
}
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <title>Bunnii Box - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;700&family=Itim&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Sarabun', sans-serif; background: linear-gradient(135deg, #fce7f3 0%, #e0e7ff 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .brand-font { font-family: 'Itim', cursive; }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(20px); border-radius: 2.5rem; border: 2px solid #ffffff; box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1); padding: 2.5rem; width: 100%; max-width: 400px; }
        .floating { animation: floating 3s ease-in-out infinite; }
        @keyframes floating { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-10px); } }
    </style>
</head>
<body>
    <div class="glass-card">
        <div class="text-center mb-8">
            <div class="floating inline-flex items-center justify-center w-20 h-20 bg-white rounded-3xl mb-4 shadow-lg text-4xl">📦</div>
            <h1 class="brand-font text-4xl font-bold text-purple-600">Bunnii Box</h1>
            <p class="text-gray-500 text-sm mt-2">ยินดีต้อนรับสู่ระบบจัดการกล่องสุ่ม</p>
        </div>
        <?php if ($error_msg): ?>
            <div class="bg-red-50 text-red-500 p-3 rounded-xl mb-4 text-sm text-center">⚠️ <?php echo $error_msg; ?></div>
        <?php endif; ?>
        <form method="post" class="space-y-4">
            <input type="text" name="auser" required placeholder="Username" class="w-full px-5 py-3 rounded-2xl border-2 border-purple-50 outline-none focus:border-purple-300">
            <input type="password" name="apwd" required placeholder="Password" class="w-full px-5 py-3 rounded-2xl border-2 border-purple-50 outline-none focus:border-purple-300">
            <button type="submit" name="Submit" class="w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white font-bold py-3 rounded-2xl shadow-lg hover:scale-[1.02] transition-transform">เข้าสู่ระบบ</button>
        </form>
    </div>
</body>
</html>