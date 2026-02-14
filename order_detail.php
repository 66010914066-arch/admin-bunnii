<?php
include_once("check_login.php");
include_once("connectdb.php");

$oid = $_GET['id'];
// ดึงข้อมูลออเดอร์และรายละเอียดสินค้าที่สั่ง (ตาราง orders_detail)
$sql = "SELECT orders_detail.*, product.p_name, product.p_price 
        FROM orders_detail 
        INNER JOIN product ON orders_detail.p_id = product.p_id 
        WHERE orders_detail.o_id = '$oid'";
$result = mysqli_query($conn, $sql);
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <title>Order Detail - Bunnii Box</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 p-10 font-['Sarabun']">
    <div class="max-w-3xl mx-auto bg-white p-10 rounded-[3rem] shadow-xl">
        <h2 class="text-3xl font-bold text-pink-500 mb-8 font-['Itim']">รายละเอียดออเดอร์ #<?php echo $oid; ?></h2>
        
        <div class="space-y-6">
            <?php 
            $grand_total = 0;
            while($item = mysqli_fetch_array($result)) { 
                $subtotal = $item['p_price'] * $item['od_qty'];
                $grand_total += $subtotal;
            ?>
            <div class="flex justify-between items-center border-b border-pink-50 pb-4">
                <div>
                    <p class="font-bold text-gray-700"><?php echo $item['p_name']; ?></p>
                    <p class="text-sm text-gray-400">จำนวน: <?php echo $item['od_qty']; ?> ชิ้น</p>
                </div>
                <p class="font-bold text-pink-400"><?php echo number_format($subtotal, 2); ?> ฿</p>
            </div>
            <?php } ?>
            
            <div class="pt-6 flex justify-between items-center">
                <h3 class="text-2xl font-black text-gray-800">ยอดรวมทั้งสิ้น</h3>
                <p class="text-3xl font-black text-pink-500"><?php echo number_format($grand_total, 2); ?> ฿</p>
            </div>
        </div>

        <div class="mt-10 flex gap-4">
            <button onclick="window.print()" class="flex-1 bg-gray-100 text-gray-600 py-4 rounded-2xl font-bold">พิมพ์ใบเสร็จ 🖨️</button>
            <a href="orders.php" class="flex-1 bg-pink-500 text-white py-4 rounded-2xl font-bold text-center">ยืนยันตรวจสอบแล้ว</a>
        </div>
    </div>
</body>
</html>