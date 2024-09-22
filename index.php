<?php
// 데이터베이스 연결
$host = 'localhost';
$db = 'your_database_name'; // 데이터베이스 이름
$user = 'your_username'; // MySQL 사용자 이름
$pass = 'your_password'; // MySQL 비밀번호

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

// 여기서 로그인 처리를 추가할 수 있습니다.

$conn->close();
?>