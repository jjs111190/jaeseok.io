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

// 게시글 ID 가져오기
$postId = $_GET['id'] ?? null;
if (!$postId) {
    echo "게시글이 존재하지 않습니다.";
    exit();
}

// 게시글 정보 가져오기
$post = $conn->query("SELECT p.*, u.username FROM posts p JOIN users u ON p.user_id = u.id WHERE p.id = '$postId'")->fetch_assoc();
if (!$post) {
    echo "게시글이 존재하지 않습니다.";
    exit();
}

// 게시글 삭제 처리
if (isset($_GET['delete_post'])) {
    // 게시글 작성자와 현재 로그인한 사용자가 동일한지 확인
    if ($post['user_id'] == $_SESSION['user_id']) {
        // 게시글 삭제 쿼리
        $conn->query("DELETE FROM posts WHERE id = '$postId'");
        header("Location: main.php"); // 삭제 후 메인 페이지로 리다이렉트
        exit();
    } else {
        echo "<script>alert('본인이 작성한 글만 삭제할 수 있습니다.');</script>";
    }
}

// 댓글 작성 처리
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_content'])) {
    $commentContent = $conn->real_escape_string($_POST['comment_content']);
    $userId = $_SESSION['user_id'];

    if ($conn->query("INSERT INTO comments (post_id, user_id, content) VALUES ('$postId', '$userId', '$commentContent')") === TRUE) {
        header("Location: post_detail.php?id=$postId"); // 댓글 작성 후 페이지 새로 고침
        exit();
    } else {
        echo "댓글 작성 실패: " . $conn->error;
    }
}

// 댓글 삭제 처리
if (isset($_GET['delete_comment_id'])) {
    $commentId = $_GET['delete_comment_id'];
    // 댓글 작성자와 현재 로그인한 사용자가 동일한지 확인
    $checkComment = $conn->query("SELECT user_id FROM comments WHERE id = '$commentId'");
    $comment = $checkComment->fetch_assoc();

    if ($comment && $comment['user_id'] == $_SESSION['user_id']) {
        // 댓글 삭제 쿼리
        $conn->query("DELETE FROM comments WHERE id = '$commentId'");
        header("Location: post_detail.php?id=$postId"); // 삭제 후 페이지 새로 고침
        exit();
    } else {
        echo "<script>alert('본인이 작성한 댓글만 삭제할 수 있습니다.');</script>";
    }
}

// 댓글 가져오기
$comments = $conn->query("SELECT c.*, u.username FROM comments c JOIN users u ON c.user_id = u.id WHERE c.post_id = '$postId' ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($post['title']) ?></title>
  <link rel="stylesheet" href="../style/style.css">
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
<section class="hero4">
<section class="posts">
<div class="post">
<img src="../image/profile.png" alt="Profile Image" style="width: 70px; height: 50px; margin-right: 10px;">
<p style="margin: 0px;"><b><?= htmlspecialchars($post['username']) ?></b> <font style="font-size:10px;">작성자</font></p>
<div class="post-title">
    <h1 style="font-size: 40px; word-wrap: break-word; margin: 0;"><?= htmlspecialchars($post['title']) ?></h1>
</div>

<section class="hero5">
    <p style="word-wrap: break-word; margin: 0;"><?= nl2br(htmlspecialchars($post['content'])) ?></p> <!-- 내용 표시 -->
</section>
<p style="font-size: 10px; color: gray;">게시일: <?= $post['created_at'] ?></p>

<!-- 게시글 작성자일 경우에만 삭제 버튼 표시 -->
<?php if ($post['user_id'] == $_SESSION['user_id']): ?>
    <p style="text-align:right; font-size: 10px;"><a href="?id=<?= $postId ?>&delete_post=1" onclick="return confirm('게시글을 삭제하시겠습니까?');" >게시글 삭제</a></p>
<?php endif; ?>
</div>
</section>
</section>

<section class="hero6" style="display: flex; flex-direction: column; align-items: center; justify-content: center; width: 100%;">
   

<?php if ($comments->num_rows > 0): ?>
    <?php while ($comment = $comments->fetch_assoc()): ?>
        <div class="comment" style="width: 100%; max-width: 800px; margin: 10px 0; padding: 10px; border: 1px solid #d2d2d7; border-radius: 8px; display: flex; align-items: flex-start;">
    <img src="../image/profile.png" alt="Profile Image" style="width: 70px; height: 50px; margin-right: 10px;">
    <div style="flex-grow: 1;"> <!-- flex-grow를 추가하여 공간을 차지하도록 설정 -->
        <div style="font-weight: bold; margin-bottom: 5px; text-align: left;"><?= htmlspecialchars($comment['username']) ?></div>
        <div style="word-wrap: break-word; overflow-wrap: break-word; margin: 0; white-space: normal;">
    <span style="display: inline-block; max-width: 100%;"><?= nl2br(htmlspecialchars($comment['content'])) ?></span>
</div>
 <?php if ($comment['user_id'] == $_SESSION['user_id']): ?>
            <a href="?id=<?= $postId ?>&delete_comment_id=<?= $comment['id'] ?>" onclick="return confirm('댓글을 삭제하시겠습니까?');" style="float: left; font-size: 0.5em; color: gray;">댓글 삭제</a>
        <?php endif; ?>
    </div> 
</div>

        <?php endwhile; ?>
    <?php else: ?>
        <div class="form-alert" style="text-align: center; margin-top: 20px;">
            <p>댓글이 없습니다.</p>
        </div>
    <?php endif; ?>
    <form method="POST" style="display: flex; align-items: center; width: 100%; max-width: 800px; height:100px;">
        <textarea name="comment_content" placeholder="댓글을 입력하세요" required style="width: 90%; height:100%; resize: none; font-size: 16px; text-align: left; border-radius: 25px; padding-left: 15px; padding-top:10px;" "></textarea>
        <button type="submit" style="width: 10%; font-size:50 px; height:50%; ">댓글 작성</button>
    </form>
</section>



<footer>
    <p>© <span id="current-year"></span> Jangjaeseok 보유.</p>
    <p>고객지원 | 연락처 | 소셜 미디어</p>
</footer>

<script>
    function updateYear() {
        const yearElement = document.getElementById('current-year');
        const currentYear = new Date().getFullYear();
        yearElement.textContent = currentYear;
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