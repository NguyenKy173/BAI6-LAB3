<!DOCTYPE html>
<html>

<head>
    <style>
        /* CSS để tạo bảng */
        table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #ddd;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        /* CSS để tạo nút Sửa và Xóa */
        .edit-btn,
        .delete-btn {
            background-color: #4CAF50;
            color: white;
            padding: 6px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border: none;
            cursor: pointer;
            margin-right: 10px;
        }

        .delete-btn {
            background-color: #f44336;
        }
    </style>
</head>

<body>

    <?php
    // Danh sách người dùng (mảng)
    $users = array(
        array('id' => 1, 'name' => 'CCTV'),
        array('id' => 2, 'name' => 'Computer Set'),
        array('id' => 3, 'name' => 'Hard Disk'),
        array('id' => 4, 'name' => 'Kryboard'),
        array('id' => 5, 'name' => 'Lapplos'),
        array('id' => 6, 'name' => 'Memony'),
        array('id' => 7, 'name' => 'Mouse')
    );

    // Xử lý sự kiện khi người dùng click vào nút "Sửa"
    if (isset($_GET['edit'])) {
        $editId = $_GET['edit'];
        $userToEdit = null;

        // Tìm người dùng cần sửa
        foreach ($users as $user) {
            if ($user['id'] == $editId) {
                $userToEdit = $user;
                break;
            }
        }

        // Hiển thị biểu mẫu sửa thông tin người dùng
        if ($userToEdit) {
            echo "<h2>Sửa</h2>";
            echo "<form method='post' action=''>";
            echo "<input type='hidden' name='edit_id' value='{$userToEdit['id']}'>";
            echo "Họ tên: <input type='text' name='edit_name' value='{$userToEdit['name']}'><br>";

            echo "<input type='submit' value='Lưu'>";
            echo "</form>";
        }
    }

    // Xử lý sự kiện khi người dùng gửi biểu mẫu sửa thông tin
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_id'])) {
        $editId = $_POST['edit_id'];
        $editName = $_POST['edit_name'];


        // Cập nhật thông tin người dùng trong danh sách
        foreach ($users as &$user) {
            if ($user['id'] == $editId) {
                $user['name'] = $editName;

                break;
            }
        }
    }

    // Xử lý sự kiện khi người dùng click vào nút "Xóa"
    if (isset($_GET['delete'])) {
        $deleteId = $_GET['delete'];

        // Tìm và xóa người dùng khỏi danh sách
        foreach ($users as $key => $user) {
            if ($user['id'] == $deleteId) {
                unset($users[$key]);
                break;
            }
        }

        // Đặt lại chỉ mục của mảng
        $users = array_values($users);
    }

    // Hiển thị danh sách người dùng với các tùy chọn Sửa và Xóa
    echo "<table>";
    echo "<tr><th>ID</th><th>NAME</th><th>ACTION</th></tr>";
    foreach ($users as $user) {
        echo "<tr>";
        echo "<td>{$user['id']}</td>";
        echo "<td>{$user['name']}</td>";

        echo "<td>";
        echo "<a class='edit-btn' href='?edit={$user['id']}'>Edit</a>";
        echo "<a class='delete-btn' href='?delete={$user['id']}'>Remove</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
</body>

</html>