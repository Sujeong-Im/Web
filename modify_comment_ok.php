<?php
$connect = mysqli_connect("localhost", "sio2", "Sio2password$", "log_db") or die("Connection Failed");

$number = $_POST['board_number'];
$cnumber = $_POST['comment_number'];

$query = "SELECT * FROM comment WHERE comment_number = '$cnumber'";
$result = $connect->query($query);
$comment = mysqli_fetch_assoc($result);

if (isset($_POST['comment_content'])) {
    $content = $_POST['comment_content'];
    $query_update_comment = "UPDATE comment SET content = '$content', date = NOW() WHERE comment_number = $cnumber";
    $result_update_comment = $connect->query($query_update_comment);
    header("Location: ./read.php?number=" . $comment['board_number']);
    exit();
}


mysqli_close($connect);
?>
