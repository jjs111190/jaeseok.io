<?php
// register.php

// PHP 오류 표시 설정 (개발 단계에서만 사용)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 데이터베이스 연결 파일 포함
require 'db_connect.php';

// POST 요청 처리
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['userName']);
    $nickname = trim($_POST['nickname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['userPassword']);

    // 입력값 확인
    if (empty($username) || empty($nickname) || empty($email) || empty($phone) || empty($password)) {
        echo "<script>alert('All fields are required!'); window.history.back();</script>";
        exit();
    }

    // 비밀번호 유효성 검사 (중복 단어, 연속된 문자 금지)
    if (preg_match('/(.)\\1{2,}/', $password)) {
        echo "<script>alert('Password cannot contain consecutive repeating characters!'); window.history.back();</script>";
        exit();
    }

    if (preg_match('/123456|abcdef|password|qwerty|000000/', $password)) {
        echo "<script>alert('Password cannot contain common or consecutive patterns!'); window.history.back();</script>";
        exit();
    }

    // 비밀번호 해싱
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // 예외 처리를 위한 try-catch 추가
    try {
        // 사용자 등록 쿼리
        $sql = "INSERT INTO users (username, nickname, email, phone, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("sssss", $username, $nickname, $email, $phone, $hashed_password);

        // 실행 및 결과 확인
        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!'); window.location.href = '/login_system/index.html';</script>";
        }

        $stmt->close();
    } catch (mysqli_sql_exception $e) {
        // 중복된 사용자명 처리
        if ($e->getCode() == 1062) { // 중복된 사용자명 오류
            echo "<script>alert('Username already exists!'); window.location.href = 'register.html';</script>";
        } else {
            echo "<script>alert('An error occurred: " . $e->getMessage() . "'); window.history.back();</script>";
        }
    } catch (Exception $e) {
        echo "<script>alert('An unexpected error occurred: " . $e->getMessage() . "'); window.history.back();</script>";
    }
}

$conn->close();
?>