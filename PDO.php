<?php
$dsn = 'mysql:host=localhost;dbname=meloddy';
$username = 'root';
$password = '';

try {
    // Kết nối đến cơ sở dữ liệu
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Chọn thao tác cần thực hiện
    $action = isset($_GET['action']) ? $_GET['action'] : 'display';

    switch ($action) {
        case 'add':
            // Thêm dữ liệu vào bảng
            $sql = "INSERT INTO my_contacts (full_names, gender, contact_no, email, city, country) 
                    VALUES (:full_names, :gender, :contact_no, :email, :city, :country)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':full_names' => 'Jane Smith',
                ':gender' => 'Female',
                ':contact_no' => '987654321',
                ':email' => 'jane.smith@example.com',
                ':city' => 'Los Angeles',
                ':country' => 'USA'
            ]);

            echo "New record created successfully";
            break;

        case 'update':
            // Cập nhật dữ liệu trong bảng
            $sql = "UPDATE my_contacts SET contact_no = :contact_no WHERE id = :id";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':contact_no' => '123123123',
                ':id' => 2
            ]);

            echo "Record updated successfully";
            break;

        case 'delete':
            // Xóa dữ liệu từ bảng
            $sql = "DELETE FROM my_contacts WHERE id = :id";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => 3]);

            echo "Record deleted successfully";
            break;

        case 'display':
        default:
            // Hiển thị dữ liệu từ bảng
            $sql = "SELECT * FROM my_contacts";
            
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                foreach ($results as $row) {
                    echo 'ID: ' . htmlspecialchars($row['id']) . '<br>';
                    echo 'Full Names: ' . htmlspecialchars($row['full_names']) . '<br>';
                    echo 'Gender: ' . htmlspecialchars($row['gender']) . '<br>';
                    echo 'Contact No: ' . htmlspecialchars($row['contact_no']) . '<br>';
                    echo 'Email: ' . htmlspecialchars($row['email']) . '<br>';
                    echo 'City: ' . htmlspecialchars($row['city']) . '<br>';
                    echo 'Country: ' . htmlspecialchars($row['country']) . '<br><br>';
                }
            } else {
                echo "No records found.";
            }
            break;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Đóng kết nối
$pdo = null;
?>
