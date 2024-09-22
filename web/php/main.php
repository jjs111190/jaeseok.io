
<?php
include 'db_connection.php'; // 데이터베이스 연결 포함
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
  <title>Security</title>
  <link rel="stylesheet" href="../style/style.css">
  <script src="../javascript/script.js">
    
  </script>
  
</head>
<body>

  <!-- 헤더 -->
<!-- 헤더 수정 -->
<header>
  <nav>
    <ul class="nav-links">
    <li><a href="#"><img src="../image/cat.png" style="width:2em;height:auto;"></a></li>
     
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
        <img src="../image/slide2.png">
   
      </div>
      
      <!-- 두 번째 슬라이드 -->
      <div class="slide">
        <img src="../image/slide1.png" >

      </div>
      
      <!-- 세 번째 슬라이드 -->
      <div class="slide">
        <img src="../image/slide2.png">
      </div>
    

    <div class="slide">
        <img src="../image/slide3.png">
      </div>
</die>
  </section>

  <!-- 푸터 -->
  <footer class="footer1">
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