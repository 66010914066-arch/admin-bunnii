<?php
include_once("check_login.php");
include_once("connectdb.php");

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$sql = "SELECT * FROM member WHERE m_name LIKE '%$search%' OR m_user LIKE '%$search%' ORDER BY m_id DESC";
$result = mysqli_query($conn, $sql);
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <title>Bunnii Box - Manage Customers</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&family=Itim&display=swap" rel="stylesheet">
    <style>body { font-family: 'Sarabun', sans-serif; background: #fdf2f8; } .font-itim { font-family: 'Itim', cursive; }</style>
</head>
<body class="flex">
    <main class="flex-1 p-10">
        <header class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 font-itim">จัดการสมาชิก Bunnii 🐰</h1>
                <p class="text-pink-400 text-sm">ดูรายชื่อ ค้นหา และแก้ไขข้อมูลลูกค้า</p>
            </div>
            <form class="flex gap-2">
                <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="ค้นหาชื่อ/ไอดีสมาชิก..." class="px-5 py-3 rounded-2xl border-2 border-pink-100 outline-none focus:border-pink-400 w-80 shadow-sm">
                <button type="submit" class="bg-pink-500 text-white px-8 py-3 rounded-2xl font-bold hover:bg-pink-600 shadow-lg transition">ค้นหา</button>
            </form>
        </header>

        <div class="bg-white rounded-[2.5rem] shadow-sm overflow-hidden border border-pink-50">
            <table class="w-full text-left">
                <thead class="bg-pink-50 text-pink-600 uppercase text-xs font-bold tracking-wider">
                    <tr>
                        <th class="p-6">ID</th>
                        <th class="p-6">ชื่อ-นามสกุล</th>
                        <th class="p-6">ชื่อผู้ใช้ (Username)</th>
                        <th class="p-6 text-center">การจัดการ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-pink-50">
                    <?php while($row = mysqli_fetch_array($result)) { ?>
                    <tr class="hover:bg-pink-50/20 transition">
                        <td class="p-6 text-gray-400">#<?php echo $row['m_id']; ?></td>
                        <td class="p-6 font-bold text-gray-700"><?php echo $row['m_name']; ?></td>
                        <td class="p-6 text-gray-500"><?php echo $row['m_user']; ?></td>
                        <td class="p-6 text-center">
                            <a href="edit_member.php?id=<?php echo $row['m_id']; ?>" class="inline-block bg-cyan-50 text-cyan-600 px-6 py-2 rounded-xl text-sm font-bold hover:bg-cyan-500 hover:text-white transition">แก้ไขข้อมูล</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>