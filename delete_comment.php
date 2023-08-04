<?php
$connect = mysqli_connect('localhost', 'sio2', 'Sio2password$', 'log_db');
session_start();

if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
    $board_number = $_GET['board_number'];
    $comment_number = $_GET['comment_number'];

    // 댓글 조회
    $result = $connect->query($query);
    $comment = mysqli_fetch_assoc($result);

    // 댓글이 존재하는지 확인
    if ($comment) {
        // 댓글 작성자와 로그인 사용자가 동일한지 확인
        if ($comment['id'] === $userid) {
            // 댓글 삭제 쿼리
            $result_delete = $connect->query($delete_query);

            if ($result_delete) {
                // 댓글 삭제 성공 시
                header("Location: ./read.php?number=" . $board_number);
                echo "댓글 삭제에 성공했습니다.";
                exit();
            } else {
                // 댓글 삭제 실패 시
                echo "댓글 삭제에 실패했습니다.";
            }
        } else {
            // 댓글 작성자와 로그인 사용자가 다른 경우
            echo "댓글을 삭제할 수 있는 권한이 없습니다.";
        }
    } else {
        // 해당 댓글이 존재하지 않는 경우
        echo "해당 댓글을 찾을 수 없습니다.";
    }
} else {
    // 로그인하지 않은 경우
    echo "로그인이 필요합니다.";
}

mysqli_close($connect);
?>