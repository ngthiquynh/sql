 <?php

$dbh = mysqli_connect ('localhost', 'root','', 'meloddy');
// Kết nối tới MySQL server

if (!$dbh)
    die("Unable to connect to MySQL: " . mysqli_connect_error());
// Nếu kết nối thất bại thì đưa ra thông báo lỗi

$sql_stmt = "SELECT * FROM my_contacts";
// Câu lệnh select

$result = mysqli_query($dbh, $sql_stmt);
// Thực thi câu lệnh SQL

if (!$result)
    die("Database access failed: " . mysqli_connect_error());
// Thông báo lỗi nếu thực thi thất bại

$rows = mysqli_num_rows($result);
// Lấy số hàng trả về

if ($rows) {
    while ($row = mysqli_fetch_array($result)) {
        echo 'ID: ' . $row['id'] . '<br>';
        echo 'Full Names: ' . $row['full_names'] . '<br>';
        echo 'Gender: ' . $row['gender'] . '<br>';
        echo 'Contact No: ' . $row['contact_no'] . '<br>';
        echo 'Email: ' . $row['email'] . '<br>';
        echo 'City: ' . $row['city'] . '<br>';
        echo 'Country: ' . $row['country'] . '<br><br>';
    }
}
// Thêm dữ liệu vào bảng
$sql_stmt = "INSERT INTO my_contacts (full_names, gender, contact_no, email, city, country) 
             VALUES ('Jane Smith', 'Female', '987654321', 'jane.smith@example.com', 'Los Angeles', 'USA')";

if (mysqli_query($dbh, $sql_stmt)) {
    echo "New record created successfully";
} else {
    echo "Error: " . mysqli_error($dbh);
}
// Cập nhật dữ liệu
$sql_stmt = "UPDATE my_contacts SET contact_no = '123123123' WHERE id = 2";

if (mysqli_query($dbh, $sql_stmt)) {
    echo "Record updated successfully";
} else {
    echo "Error: " . mysqli_error($dbh);
}
// Xóa dữ liệu
$sql_stmt = "DELETE FROM my_contacts WHERE id = 3";

if (mysqli_query($dbh, $sql_stmt)) {
    echo "Record deleted successfully";
} else {
    echo "Error: " . mysqli_error($dbh);
}

mysqli_close($dbh); // Đóng kết nối CSDL