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
      <li><a href="my_posts.php">목록</a></li>
      <li><a href="community.php">게시판</a></li>
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
  <section class="hero2">
  <div class="form-alert ">
    <p >커뮤니티 게시판은 보안과 관련된 정보를 공유하고, 질문하고, 소통할 수 있는 공간입니다. 사용자들이 서로의 경험과 지식을 나누며, 보안 생태계에 대한 이해를 높이고 유용한 팁과 정보를 얻을 수 있습니다.</p>
  </div>
  <div class="form-alert ">
    <p>

   <h2>이용 방법</h2>
    게시물 작성: 자유롭게 질문하거나 정보를 공유하는 게시물을 작성할 수 있습니다.<br>
    댓글 기능: 다른 사용자들의 게시물에 댓글을 달아 소통하고, 더 나은 해결책을 찾아봅니다.<br>
    검색 기능: 원하는 정보를 쉽게 찾을 수 있도록 검색 기능을 활용할 수 있습니다.
</p>
  </div>
</section>
  
<br>
  <!-- 게시판 섹션 -->
  <section class="posts">
    <div class="post">
      <div class="post-title">iPhone 13 mini에 대한 사용 후기</div>
      <div class="post-meta">댓글 5개 · 1시간 전</div>
    </div>
    <div class="post">
      <div class="post-title">새로운 MacBook Pro 출시 소식</div>
      <div class="post-meta">댓글 10개 · 2시간 전</div>
    </div>
    <div class="post">
      <div class="post-title">Apple Watch Series 7 리뷰</div>
      <div class="post-meta">댓글 3개 · 3시간 전</div>
    </div>
    <div class="post">
      <div class="post-title">Apple Watch Series 7 리뷰</div>
      <div class="post-meta">댓글 3개 · 3시간 전</div>
    </div>
    <div class="post">
      <div class="post-title">Apple Watch Series 7 리뷰</div>
      <div class="post-meta">댓글 3개 · 3시간 전</div>
    </div>
  </section>
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
