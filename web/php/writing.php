<?php
session_start();
include 'db_connection.php'; // 데이터베이스 연결 포함

error_reporting(E_ALL);
ini_set('display_errors', 1);

// 로그인 확인
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

// 사용자 ID 설정
$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
    echo "로그인 정보가 없습니다.";
    exit();
}

// 게시물 작성 처리
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_content']) && isset($_POST['post_title']) && isset($_POST['post_author'])) {
    $title = $conn->real_escape_string($_POST['post_title']);
    $author = $conn->real_escape_string($_POST['post_author']);
    $content = $conn->real_escape_string($_POST['post_content']);
    
    if ($userId && $title && $author && $content) {
        if ($conn->query("INSERT INTO posts (user_id, title, author, content) VALUES ('$userId', '$title', '$author', '$content')") === TRUE) {
            header("Location: my_posts.php"); // 성공적으로 작성된 후 목록으로 이동
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "유효한 사용자 ID, 제목, 작성자 또는 게시물 내용을 입력해 주세요.";
    }
}

// 게시물 가져오기
$posts = $conn->query("SELECT p.*, u.username FROM posts p JOIN users u ON p.user_id = u.id ORDER BY created_at DESC");

if (!$posts) {
    die("쿼리 실패: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Security community</title>
  <link rel="stylesheet" href="../style/style.css">
  <script src="../javascript/script.js"></script>
</head>
<body>
<header>
  <nav>
    <ul class="nav-links">
      <li><a href="main.php"><b>SE<span class="custom-color">CU</span>RITY</b></a></li>
      <li><a href="#">디지털 포랜식</a></li>
      <li><a href="#">Mac</a></li>
      <li><a href="#">iPad</a></li>
      <li><a href="#">iPhone</a></li>
      <li><a href="#">Watch</a></li>
      <li><a href="writing.php">글쓰기</a></li>
      <li><a href="my_posts.php">게시판</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
    <div class="hamburger">
      <div class="bar"></div>
      <div class="bar"></div>
      <div class="bar"></div>
    </div>
  </nav>
</header>

<section class="hero3" style="margin-top: 200px;">
<h1 style="font-size: 36px;">글쓰기</h1>
<p style="font-size: 24px;">자신만의 글을 작성하세요!</p>
<br>
<form method="POST" style="display: flex; flex-direction: column; align-items: left; margin-top: 20px;">
    <h1 style="font-size: 40px;">1.내용이 압축적으로 설명된 제목으로 시작합니다.</h1>
    <br>
    <div style="display: flex; align-items: center; width: 800px; margin-bottom: 10px;">
        <input type="text" name="post_title" placeholder="제목을 입력하세요" style="text-align: left; padding-left: 10px; margin-right: 10px; flex: 1; height: 50px; border-radius: 5px;" required />
        
        <div style="display: flex; align-items: center; margin-right: 10px;">
            <input type="text" name="post_author" placeholder="닉네임을 입력하세요" style="text-align: left; height: 50px; border-radius: 5px; width: 150px; padding-left:10px;" required />
        </div>
    </div>
    <br>
    <h1 style="font-size: 40px;">2.보다 자세한 정보를 제공합니다.</h1>
    <br>
    <textarea name="post_content" placeholder="예) 안녕하세요! 오늘은 제가 처음으로 블로그에 글을 남기게 된 날입니다. 이 공간을 통해 저의 생각과 경험을 공유하고, 다양한 사람들과 소통할 수 있기를 기대합니다." 
      style="width: 800px; height: 500px; resize: none; font-size: 16px; text-align: left; border-radius: 25px; padding-left: 15px; padding-top:10px;" 
      required></textarea>
    <div style="display: flex; margin-top: 10px;">
        <button type="submit" style="margin-right: 10px;">글쓰기</button>
        <button type="button" onclick="window.location.href='my_posts.php'">취소</button>
    </div>
</form>
</section>

<footer>
    <p>© <span id="current-year"></span> Jangjaeseok 보유.</p>
    <p>고객지원 | 연락처 | 소셜 미디어</p>
</footer>

<script>
    function updateYear() {
        const yearElement = document.getElementById('current-year');
        const currentYear = new Date().getFullYear(); // 현재 년도 가져오기
        yearElement.textContent = currentYear; // 년도 업데이트
    }

    window.onload = updateYear;
    let currentSlide = 0; // 현재 슬라이드 인덱스
    const slides = document.querySelectorAll('.slide'); // 모든 슬라이드 요소를 선택
    const totalSlides = slides.length; // 슬라이드의 총 개수
  
    // 다음 슬라이드 보여주기
    function showNextSlide() {
      // 현재 슬라이드에서 'active' 클래스를 제거하여 숨김 처리
      slides[currentSlide].classList.remove('active');
  
      // 현재 슬라이드 인덱스를 다음 슬라이드로 업데이트
      currentSlide = (currentSlide + 1) % totalSlides; // 마지막 슬라이드 이후 다시 첫 번째로 돌아옴
  
      // 다음 슬라이드에 'active' 클래스를 추가하여 표시
      slides[currentSlide].classList.add('active');
    }
  
    // 일정 시간 간격으로 슬라이드를 자동으로 넘기도록 설정 (3초마다 슬라이드 변경)
    setInterval(showNextSlide, 1000000);
  
    // 첫 번째 슬라이드에 'active' 클래스를 추가하여 초기 상태에서 표시
    slides[currentSlide].classList.add('active');
    document.addEventListener('DOMContentLoaded', function() {
      const myElement = document.querySelector('.my-element');
      if (myElement) {
          myElement.classList.add('new-class');
      } else {
          console.error('요소를 찾을 수 없습니다!');
      }
  });
  let lastScrollTop = 0;
const header = document.querySelector('header');
const menu = document.getElementById('menu');

// 햄버거 메뉴 토글 기능
// 햄버거 메뉴 클릭 시 내비게이션 메뉴 토글
document.addEventListener('DOMContentLoaded', function() {
  const hamburger = document.querySelector('.hamburger');
  const navLinks = document.querySelector('.nav-links');

  hamburger.addEventListener('click', () => {
    navLinks.classList.toggle('active');
    hamburger.classList.toggle('active');
  });

  // 스크롤 시 햄버거 메뉴가 열려 있으면 닫기
  window.addEventListener('scroll', function() {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    
    // 스크롤을 내리면 헤더를 숨기고, 스크롤을 올리면 헤더를 다시 보여줌
    if (scrollTop > lastScrollTop) {
      header.classList.add('hide-header');
    } else {
      header.classList.remove('hide-header');
    }

    // 햄버거 메뉴가 열려 있으면 스크롤 시 닫음
    if (navLinks.classList.contains('active')) {
      navLinks.classList.remove('active');
      hamburger.classList.remove('active');
    }

    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // scrollTop 값이 음수가 되지 않도록 처리
  });
});

</script>
</body>
</html>