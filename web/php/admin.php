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
  <title>admin</title>
  <link rel="stylesheet" href="../style/style.css">
  <script src="../javascript/script.js">
    
  </script>
</head>
<body>

  <!-- 헤더 -->
  <header>
    <nav>
      <ul>
        <li><a href="main.html"><b>Admin</b></a></li>
        <li><a href="#">디지털 포랜식</a></li>
        <li><a href="#">Mac</a></li>
        <li><a href="#">iPad</a></li>
        <li><a href="#">iPhone</a></li>
        <li><a href="#">Watch</a></li>
        <li><a href="#">AirPods</a></li>
        <li><a href="#">TV & Home</a></li>
        <li><a href="#">엔터테인먼트</a></li>
        <li><a href="community.php">게시판</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <!-- 메인 배너 -->
  <section class="hero" >
    <div class="hero-content" >
      <h1>Digital Forensics</h1>
      <p>Apple Intelligence, 연내 미국 영어로 우선 출시 예정</p>
      <button>더 알아보기</button>
      <button>사전 주문하기</button>
    </div>
  </section>

  <!-- 제품 섹션 -->
  <section class="product-info">
    <h2>iPhone 16</h2>
    <p>더 나은 성능과 혁신적인 디자인</p>
  </section>

  <section class="product-info">
    <div class="product-content">
      <h2>iPhone 16</h2>
      <img src="../image/mainbackground.jpg" alt="iPhone 16 이미지">
      <p>9월 20일 출시</p>
      <p>Apple Intelligence, 연내 미국 영어로 우선 출시 예정</p>
      <button>더 알아보기</button>
      <button>사전 주문하기</button>
    </div>
  </section>

  <section class="product-grid">
    <div class="grid-container">
      <!-- 첫 번째 이미지와 설명 -->
      <div class="grid-item">
  <figure class="snip1132">
    <img src="../image/mainbackground.jpg" alt="Apple Watch 이미지">
    <figcaption>
      <h3>디지털포렌식</h3>
      <div class="caption">
        <!-- 추가적인 내용이 필요하면 여기에 삽입 -->
      </div>
    </figcaption>
  </figure>
</div>
 <!-- 두 번째 이미지와 설명 -->
<div class="grid-item">
  <figure class="snip1132">
    <img src="../image/mainbackground.jpg" alt="Apple Watch 이미지">
    <figcaption>
      <h3>디지털포렌식</h3>
      <div class="caption">
        <!-- 추가적인 내용이 필요하면 여기에 삽입 -->
      </div>
    </figcaption>
  </figure>
</div>
 <!-- 세 번째 이미지와 설명 -->
<div class="grid-item">
  <figure class="snip1132">
    <img src="../image/mainbackground.jpg" alt="Apple Watch 이미지">
    <figcaption>
      <h3>디지털포렌식</h3>
      <div class="caption">
        <!-- 추가적인 내용이 필요하면 여기에 삽입 -->
      </div>
    </figcaption>
  </figure>
</div>
 <!-- 네 번째 이미지와 설명 -->
<div class="grid-item">
  <figure class="snip1132">
    <img src="../image/mainbackground.jpg" alt="Apple Watch 이미지">
    <figcaption>
      <h3>디지털포렌식</h3>
      <div class="caption">
        <!-- 추가적인 내용이 필요하면 여기에 삽입 -->
      </div>
    </figcaption>
  </figure>
</div>
 <!-- 다섯 번째 이미지와 설명 -->
<div class="grid-item">
  <figure class="snip1132">
    <img src="../image/mainbackground.jpg" alt="Apple Watch 이미지">
    <figcaption>
      <h3>디지털포렌식</h3>
      <div class="caption">
        <!-- 추가적인 내용이 필요하면 여기에 삽입 -->
      </div>
    </figcaption>
  </figure>
</div>
       <!-- 여섯 번째 이미지와 설명 -->
<div class="grid-item">
  <figure class="snip1132">
    <img src="../image/mainbackground.jpg" alt="Apple Watch 이미지">
    <figcaption>
      <h3>디지털포렌식</h3>
      <div class="caption">
        <!-- 추가적인 내용이 필요하면 여기에 삽입 -->
      </div>
    </figcaption>
  </figure>
</div>
     
    
    </div>
  </section>

  <section class="slider">
    <div class="slides">
      <!-- 첫 번째 슬라이드 -->
      <div class="slide">
        <img src="./image/image.webp" alt="iPhone 16 이미지">
        <h3>iPhone 16</h3>
        
      </div>
      
      <!-- 두 번째 슬라이드 -->
      <div class="slide">
        <img src="./image/image.webp" alt="Apple Watch 이미지">
        <h3>Apple Watch</h3>
        <p>9월 20일 출시</p>
       
      </div>
      
      <!-- 세 번째 슬라이드 -->
      <div class="slide">
        <img src="./image/image.webp" alt="AirPods 이미지">
        <h3>AirPods 4</h3>
        <p>아이콘의 귀환. 사운드의 진화.</p>
        
      </div>
    </div>
  </section>
  <!-- 푸터 -->
  <footer>
    <p>© 2024 Apple Inc. 모든 권리 보유.</p>
    <p>고객지원 | 연락처 | 소셜 미디어</p>
  </footer>
 
</body>
</html>