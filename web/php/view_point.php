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

// 댓글 작성 처리
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_content'])) {
    $postId = $_POST['post_id'];
    $content = $conn->real_escape_string($_POST['comment_content']);
    $conn->query("INSERT INTO comments (post_id, user_id, content) VALUES ('$postId', '$userId', '$content')");
}

// 게시물 삭제 처리
if (isset($_GET['delete_post_id'])) {
    $postId = $_GET['delete_post_id'];
    $conn->query("DELETE FROM posts WHERE id = '$postId' AND user_id = '$userId'");
    header("Location: view_posts.php"); // 삭제 후 페이지 새로 고침
    exit();
}

// 댓글 삭제 처리
if (isset($_GET['delete_comment_id'])) {
    $commentId = $_GET['delete_comment_id'];
    $conn->query("DELETE FROM comments WHERE id = '$commentId' AND user_id = '$userId'");
    header("Location: view_posts.php"); // 삭제 후 페이지 새로 고침
    exit();
}

// 게시물 가져오기
$posts = $conn->query("SELECT p.*, u.username FROM posts p JOIN users u ON p.user_id = u.id ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>게시물 보기</title>
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
<section class="hero1" style="margin-top: 200px;">
    <?php while ($post = $posts->fetch_assoc()): ?>
    <div>
        <h2><?= htmlspecialchars($post['username']) ?>의 글</h2>
        <p><?= htmlspecialchars($post['content']) ?></p>
        <p>작성일: <?= $post['created_at'] ?></p>
        <a href="?delete_post_id=<?= $post['id'] ?>" onclick="return confirm('정말로 이 게시물을 삭제하시겠습니까?');">❌ 삭제</a>
        <form method="POST">
            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
            <input type="text" name="comment_content" placeholder="댓글 작성..." required>
            <button type="submit">댓글 달기</button>
        </form>

        <!-- 댓글 출력 -->
        <?php
        $comments = $conn->query("SELECT c.*, u.username FROM comments c JOIN users u ON c.user_id = u.id WHERE post_id = " . $post['id']);
        while ($comment = $comments->fetch_assoc()):
        ?>
            <div style="margin-left: 20px;">
                <strong><?= htmlspecialchars($comment['username']) ?></strong>: <?= htmlspecialchars($comment['content']) ?>
                <a href="?delete_comment_id=<?= $comment['id'] ?>" onclick="return confirm('정말로 이 댓글을 삭제하시겠습니까?');">❌ 삭제</a>
            </div>
        <?php endwhile; ?>
    </div>
    <?php endwhile; ?>
</section>

<footer>
    <p>© <span id="current-year"></span> Jangjaeseok 보유.</p>
</footer>

<script>
    function updateYear() {
        const yearElement = document.getElementById('current-year');
        const currentYear = new Date().getFullYear(); // 현재 년도 가져오기
        yearElement.textContent = currentYear; // 년도 업데이트
    }

    window.onload = updateYear;
</script>
</body>
</html>