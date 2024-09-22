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

// 페이지네이션 설정
$limit = 6; // 페이지당 게시물 수
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// 게시물 삭제 처리
if (isset($_GET['delete_post_id'])) {
    $postId = $_GET['delete_post_id'];
    $conn->query("DELETE FROM posts WHERE id = '$postId' AND user_id = '$userId'");
    header("Location: my_posts.php"); // 삭제 후 페이지 새로 고침
    exit();
}

// 사용자 작성 게시물 가져오기
$posts = $conn->query("SELECT p.*, u.username, COUNT(c.id) AS comment_count 
                        FROM posts p 
                        LEFT JOIN users u ON p.user_id = u.id 
                        LEFT JOIN comments c ON p.id = c.post_id 
                        WHERE p.user_id = '$userId' 
                        GROUP BY p.id 
                        ORDER BY created_at DESC 
                        LIMIT $limit OFFSET $offset");

$total_posts = $conn->query("SELECT COUNT(*) AS count FROM posts WHERE user_id = '$userId'")->fetch_assoc()['count'];
$total_pages = ceil($total_posts / $limit);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>내 게시물 보기</title>
  <link rel="stylesheet" href="../style/style.css">
  <style>
    .pagination {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 20px;
    }
    .pagination a {
      margin: 0 5px;
      padding: 10px 15px;
      text-decoration: none;
      color: #333;
      border: 1px solid #ddd;
      border-radius: 5px;
    }
    .pagination a:hover {
      background-color: #f1f1f1;
    }
    .pagination .current-page {
      font-weight: bold;
      color: #333;
    }
  </style>
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
<section class="hero1">
  <h1><font size=100px>커뮤니티 게시판</font></h1>
  <h2>글 찾기 질문하기 소통해 보세요.</h2>
  <br>
  <div class="search-bar">
    <div class="search-container">
      <input type="text" id="search-input" placeholder="검색 또는 질문하기">
      <img src="../image/search.png" alt="Search Icon" id="search-icon" style="cursor: pointer;" onclick="handleSearch()">
    </div>
    <p id="search-message" style="color: red; display: none;"></p> <!-- 경고 메시지 표시 -->
  </div>
</section>
<section class="hero2">
  <div class="form-alert">
    <p>커뮤니티 게시판은 보안과 관련된 정보를 공유하고, 질문하고, 소통할 수 있는 공간입니다. 사용자들이 서로의 경험과 지식을 나누며, 보안 생태계에 대한 이해를 높이고 유용한 팁과 정보를 얻을 수 있습니다.</p>
  </div>
  <div class="form-alert">
    <h2>이용 방법</h2>
    <p>
      게시물 작성: 자유롭게 질문하거나 정보를 공유하는 게시물을 작성할 수 있습니다.<br>
      댓글 기능: 다른 사용자들의 게시물에 댓글을 달아 소통하고, 더 나은 해결책을 찾아봅니다.<br>
      검색 기능: 원하는 정보를 쉽게 찾을 수 있도록 검색 기능을 활용할 수 있습니다.
    </p>
  </div>
</section>

<section class="hero7" style="margin-top: 50px;"> <!-- 여기에 마진 조정 -->
  


  <?php if ($posts->num_rows > 0): ?>
    <section class="posts">
    <h1 style="font-size: 2.5em; text-align: center; position: relative; margin-bottom: 20px;">
    게시물
</h1>
<hr style="border: none; border-top: 2px solid #ccc; margin-bottom: 20px; width: 100%;">

      <?php while ($post = $posts->fetch_assoc()): ?>
        <div class="post">
        <div class="post-title" style="margin-bottom: 10px;">
    <h2 style="font-size: 1.5em; line-height: 1.2; margin: 0; word-wrap: break-word;">
        <a href="post_detail.php?id=<?= $post['id'] ?>" style="color: inherit; text-decoration: none;"><?= htmlspecialchars($post['title']) ?></a>
    </h2>
</div>
<div class="post-meta">
            <p>작성자: <?= htmlspecialchars($post['username']) ?> / 작성일: <?= $post['created_at'] ?> / 댓글 개수: <?= $post['comment_count'] ?></p>
           </div>
        </div>
      <?php endwhile; ?>
    </section>
    
    <!-- 페이지네이션 -->
    <div class="pagination">
      <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1 ?>">이전</a>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="?page=<?= $i ?>" <?= ($i == $page) ? 'style="font-weight:bold;"' : '' ?>><?= $i ?></a>
      <?php endfor; ?>

      <?php if ($page < $total_pages): ?>
        <a href="?page=<?= $page + 1 ?>">다음</a>
      <?php endif; ?>
    </div>
  <?php else: ?>
    <section class="hero3">
      <img src="../image/cat.png" style="width: 200px; height: auto;">
      <p>작성한 게시물이 없습니다.</p>
    </section>
  <?php endif; ?>
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
  function handleSearch() {
    const searchInput = document.getElementById('search-input').value.trim();
    const searchMessage = document.getElementById('search-message');

    if (searchInput === "") {
      // 입력이 비어있으면 no_message.php로 리디렉션
      window.location.href = 'noSearchMassage.php';
    } else {
      // 입력이 있으면 다른 검색 처리 로직을 여기에 추가
      // 예: 검색 결과 페이지로 이동
      // window.location.href = 'search_results.php?q=' + encodeURIComponent(searchInput);
    }
  }
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
