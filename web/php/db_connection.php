<?php
$host = 'localhost';
$dbname = 'login_system';
$user = 'root';
$pass = ''; // XAMPP 기본 설정은 비밀번호가 없습니다. 보안상 변경 권장

// 데이터베이스 연결
$conn = new mysqli($host, $user, $pass, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>