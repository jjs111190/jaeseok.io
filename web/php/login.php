<?php
// login.php
session_start();

// PHP 오류 표시 설정 (개발 단계에서만 사용)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 데이터베이스 연결 설정
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

// POST 요청 처리
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['userName']);
    $password = trim($_POST['userPassword']);

    // 입력값 확인
    if (empty($username) || empty($password)) {
        echo "Username and password cannot be empty!";
        exit();
    }

    // 사용자 확인 쿼리
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // 사용자 존재 여부 확인
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // 비밀번호 검증
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username']; // username 저장
            $_SESSION['user_id'] = $user['id']; // user_id 저장
            
            // admin 계정 확인
            if ($user['username'] === 'admin') {
                header("Location: admin.php"); // admin 페이지로 리다이렉션
            } else {
                header("Location: main.php"); // 일반 사용자 페이지로 리다이렉션
            }
            exit();
        } else {
            echo "Invalid password! <a href='/login_system/index.html'>Try Again</a>";
        }
    } else {
        echo "User does not exist! <a href='../register.html'>Register</a>";
    }

    $stmt->close();
}

$conn->close();
?>