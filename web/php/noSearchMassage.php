<?php
// main.php
session_start();

// 로그인 확인
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = htmlspecialchars($_SESSION['username']);
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

  <!-- 헤더 -->
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

  <!-- 메인 배너 -->
  <section class="hero1">
  <h1><font size=100px>커뮤니티 게시판</font></h1>
    <h2>글 찾기 질문하기 소통해 보세요.</h2>
<br>
<div class="search-bar">
  <div class="search-container">
    <input type="text" id="search-input" placeholder="검색 또는 질문하기">
    <img src="../image/search.png" alt="Search Icon" id="search-icon" style="cursor: pointer;">
  </div>
  <p id="search-message" style="color: red; display: none;"></p> <!-- 경고 메시지 표시 -->
</div>

  </section>
</section>
<center>
<img src="../image/cat.png">
  <h3>결과가 없습니다. 찾는 내용을 설명할 다른 용어를 사용해 보십시요</h3>
</center>
<br>
  <!-- 푸터 -->
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
    // 페이지가 로드될 때 년도 업데이트
    window.onload = updateYear;
    document.getElementById('search-icon').addEventListener('click', function() {
        const searchInput = document.getElementById('search-input').value.trim(); // 입력값 가져오기

        if (searchInput === '') {
            // 입력값이 없으면 nosearchmessage.php로 이동
            window.location.href = 'noSearchMassage.php';
        } else {
            // 검색 수행 로직 추가 (필요에 따라 구현)
            console.log('검색:', searchInput); // 예시로 콘솔에 출력
        }
    });
</script>
</body>
</html>
