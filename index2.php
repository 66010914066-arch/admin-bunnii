<?php
include_once("check_login.php");
include_once("connectdb.php");

// ดึงค่าสถิติจริงจากฐานข้อมูล
$res_p = mysqli_query($conn, "SELECT COUNT(*) as total FROM product");
$total_p = mysqli_fetch_assoc($res_p)['total'];

$res_m = mysqli_query($conn, "SELECT COUNT(*) as total FROM member");
$total_m = mysqli_fetch_assoc($res_m)['total'];

$res_o = mysqli_query($conn, "SELECT COUNT(*) as total FROM orders WHERE DATE(o_date) = CURDATE()");
$total_o = mysqli_fetch_assoc($res_o)['total'];
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <title>Bunnii Box Admin ✨</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&family=Itim&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Sarabun', sans-serif; background: #fdf2f8; }
        .font-itim { font-family: 'Itim', cursive; }
    </style>
</head>
<body class="flex min-h-screen">

    <aside class="w-80 bg-white h-screen sticky top-0 p-8 shadow-sm">
        <div class="mb-12 text-center">
             <div class="w-20 h-20 bg-pink-500 rounded-3xl mx-auto mb-4 flex items-center justify-center text-white text-3xl font-bold shadow-lg">BU</div>
             <h2 class="text-xl font-bold text-pink-500 font-itim">Bunnii Box Admin</h2>
             <p class="text-gray-400 text-[10px] uppercase tracking-widest mt-1">Management System</p>
        </div>
        
        <nav class="space-y-2">
            <p class="text-[10px] font-bold text-gray-300 ml-4 mb-2 uppercase">Main Menu</p>
            <a href="index2.php" class="flex items-center gap-3 p-4 bg-pink-500 text-white rounded-2xl font-bold shadow-md shadow-pink-100">
                <span>🔮</span> Dashboard
            </a>
            <a href="products.php" class="flex items-center gap-3 p-4 text-gray-500 hover:bg-pink-50 rounded-2xl transition">
                <span>📦</span> จัดการสินค้า/หน้าร้าน
            </a>
            <a href="orders.php" class="flex items-center gap-3 p-4 text-gray-500 hover:bg-pink-50 rounded-2xl transition">
                <span>📊</span> เช็คออเดอร์เดอร์
            </a>
            <a href="customers.php" class="flex items-center gap-3 p-4 text-gray-500 hover:bg-pink-50 rounded-2xl transition">
                <span>🐰</span> จัดการสมาชิก/แก้ไขข้อมูล
            </a>
            
            <p class="text-[10px] font-bold text-gray-300 ml-4 mb-2 mt-8 uppercase">Shop Front</p>
            <a href="shop.php" target="_blank" class="flex items-center gap-3 p-4 text-gray-500 hover:bg-pink-50 rounded-2xl transition">
                <span>🏠</span> ดูหน้าร้านจริง
            </a>
            <a href="logout.php" class="flex items-center gap-3 p-4 text-red-400 hover:bg-red-50 rounded-2xl transition mt-10">
                <span>🚀</span> ออกจากระบบ
            </a>
        </nav>
    </aside>

    <main class="flex-1 p-12">
        <header class="mb-10 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800 font-itim">Control Panel</h1>
            <div class="bg-white px-6 py-2 rounded-full text-pink-500 font-bold shadow-sm border border-pink-50 text-sm">
                แอดมิน: <?php echo $_SESSION['aname']; ?> ✨
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border-b-8 border-purple-300">
                <p class="text-gray-300 text-[10px] font-bold uppercase mb-2">สินค้าทั้งหมด</p>
                <div class="flex items-center justify-between">
                    <h3 class="text-4xl font-black text-gray-700"><?php echo number_format($total_p); ?></h3>
                    <span class="text-2xl">📦</span>
                </div>
            </div>
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border-b-8 border-pink-400">
                <p class="text-gray-300 text-[10px] font-bold uppercase mb-2">ออร์เดอร์วันนี้</p>
                <div class="flex items-center justify-between">
                    <h3 class="text-4xl font-black text-gray-700"><?php echo $total_o; ?></h3>
                    <span class="text-2xl">❤️</span>
                </div>
            </div>
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border-b-8 border-cyan-300">
                <p class="text-gray-300 text-[10px] font-bold uppercase mb-2">สมาชิก Bunnii</p>
                <div class="flex items-center justify-between">
                    <h3 class="text-4xl font-black text-gray-700"><?php echo $total_m; ?></h3>
                    <span class="text-2xl">🐰</span>
                </div>
            </div>
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border-b-8 border-orange-300">
                <p class="text-gray-300 text-[10px] font-bold uppercase mb-2">สินค้าในตะกร้า</p>
                <div class="flex items-center justify-between">
                    <h3 class="text-4xl font-black text-gray-700">12</h3>
                    <span class="text-2xl">🛒</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-12 rounded-[3.5rem] shadow-sm">
            <h2 class="text-2xl font-bold font-itim text-gray-800 mb-8 flex items-center gap-2">
                จัดการระบบ Bunnii Box 🧸
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <a href="products.php" class="group p-10 border-2 border-dashed border-pink-100 rounded-[3rem] hover:border-pink-400 hover:bg-pink-50/50 transition duration-300">
                    <div class="w-14 h-14 bg-pink-100 rounded-2xl mb-4 flex items-center justify-center text-2xl group-hover:scale-110 transition">📦</div>
                    <h4 class="font-bold text-pink-600 text-xl mb-2">คลังสินค้า/หน้าร้าน</h4>
                    <p class="text-gray-400 text-sm leading-relaxed">คลิกเพื่อเพิ่มสินค้าใหม่ อัปเดตราคากล่องสุ่ม หรือลบรายการสินค้าที่หมดสต็อกแล้ว</p>
                </a>
                
                <a href="customers.php" class="group p-10 border-2 border-dashed border-cyan-100 rounded-[3rem] hover:border-cyan-400 hover:bg-cyan-50/50 transition duration-300">
                    <div class="w-14 h-14 bg-cyan-100 rounded-2xl mb-4 flex items-center justify-center text-2xl group-hover:scale-110 transition">🐰</div>
                    <h4 class="font-bold text-cyan-600 text-xl mb-2">ข้อมูลลูกค้าสมาชิก</h4>
                    <p class="text-gray-400 text-sm leading-relaxed">ตรวจสอบรายชื่อสมาชิกทั้งหมด ค้นหาข้อมูลลูกค้า หรือแก้ไขโปรไฟล์ของผู้ใช้งาน</p>
                </a>
            </div>
        </div>
    </main>
</body>
</html>