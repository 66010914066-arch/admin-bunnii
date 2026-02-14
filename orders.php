<?php
include_once("check_login.php");
include_once("connectdb.php");

// ดึงข้อมูลออเดอร์พร้อมชื่อลูกค้า
$sql = "SELECT orders.*, member.m_name FROM orders 
        INNER JOIN member ON orders.m_id = member.m_id 
        ORDER BY orders.o_id DESC";
$result = mysqli_query($conn, $sql);
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <title>Bunnii Orders - Check Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&family=Itim&display=swap" rel="stylesheet">
    <style>body { font-family: 'Sarabun', sans-serif; background: #fdf2f8; } .font-itim { font-family: 'Itim', cursive; }</style>
</head>
<body class="p-10">
    <div class="max-w-5xl mx-auto">
        <header class="flex justify-between items-center mb-10">
            <h1 class="text-4xl font-bold text-pink-600 font-itim">รายการสั่งซื้อ 🛒</h1>
            <a href="index2.php" class="text-gray-400 hover:text-pink-500 transition">กลับหน้าหลัก</a>
        </header>

        <div class="space-y-4">
            <?php while($row = mysqli_fetch_array($result)) { ?>
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border-l-8 border-pink-400 flex justify-between items-center">
                <div>
                    <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest">ORDER #<?php echo $row['o_id']; ?></p>
                    <h3 class="text-xl font-bold text-gray-700">คุณ <?php echo $row['m_name']; ?></h3>
                    <p class="text-sm text-gray-400 mt-1">วันที่สั่ง: <?php echo $row['o_date']; ?></p>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-black text-pink-500 mb-2"><?php echo number_format($row['o_total'], 2); ?> ฿</p>
                    <a href="order_detail.php?id=<?php echo $row['o_id']; ?>" class="inline-block bg-pink-50 text-pink-600 px-6 py-2 rounded-xl font-bold hover:bg-pink-500 hover:text-white transition">
                        ตรวจสอบออเดอร์
                    </a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>