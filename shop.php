<?php
include_once("connectdb.php");
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$sql = "SELECT * FROM product WHERE p_name LIKE '%$search%' ORDER BY p_id DESC";
$result = mysqli_query($conn, $sql);
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <title>Bunnii Box Shop - กล่องสุ่มพาสเทล 🧸</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
</head>
<body class="bg-pink-50/20 min-h-screen">
    <nav class="bg-white p-6 shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-4xl font-bold text-pink-500 font-['Itim'] tracking-tighter cursor-pointer" onclick="location.href='shop.php'">Bunnii Box 📦</h1>
            <form class="flex-1 max-w-lg mx-10">
                <div class="relative">
                    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="ค้นหาคอลเลกชันกล่องสุ่ม..." class="w-full px-6 py-3 rounded-2xl border-2 border-pink-100 outline-none focus:border-pink-400">
                    <button class="absolute right-4 top-3 text-pink-400">🔍</button>
                </div>
            </form>
            <div class="flex items-center gap-6 font-bold text-gray-500">
                <a href="cart.php" class="relative group">
                    <span class="text-3xl">🛒</span>
                    <span class="absolute -top-2 -right-2 bg-pink-500 text-white text-[10px] w-5 h-5 flex items-center justify-center rounded-full shadow-md group-hover:scale-125 transition">0</span>
                </a>
                <a href="user_login.php" class="bg-pink-100 text-pink-600 px-6 py-2 rounded-xl hover:bg-pink-500 hover:text-white transition">เข้าสู่ระบบ</a>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto p-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            <?php while($row = mysqli_fetch_array($result)) { ?>
            <div class="bg-white p-5 rounded-[3rem] shadow-sm hover:shadow-2xl hover:translate-y-[-10px] transition-all duration-300 border border-pink-50 group">
                <div class="relative overflow-hidden rounded-[2.5rem] mb-6 aspect-square">
                    <img src="images/<?php echo $row['p_img']; ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute top-4 right-4 bg-white/90 px-3 py-1 rounded-full text-[10px] font-black text-pink-500 shadow-sm">NEW ✨</div>
                </div>
                <h3 class="font-bold text-gray-800 text-lg mb-1 px-2"><?php echo $row['p_name']; ?></h3>
                <p class="text-gray-400 text-sm px-2 mb-4">คอลเลกชันยอดฮิต!</p>
                <div class="flex justify-between items-center px-2">
                    <span class="text-pink-500 font-black text-2xl"><?php echo number_format($row['p_price'], 0); ?>.-</span>
                    <button onclick="location.href='cart.php?id=<?php echo $row['p_id']; ?>'" class="bg-pink-500 text-white p-3 rounded-2xl shadow-lg shadow-pink-200 hover:rotate-12 transition">
                        ➕
                    </button>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>