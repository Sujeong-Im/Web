<?php
$connect = mysqli_connect("localhost", "sio2", "dancingCat42", "log_db") or die("Connection Failed");

$id = $_POST['username'];
$number = $_POST['board_number'];
$content = $_POST['comment_content'];
$date = date('Y-m-d H:i:s');

$query = "INSERT INTO comment (board_number, id, content, date, comment_number) VALUES (?, ?, ?, ?, null)";

$stmt = $connect->prepare($query);
$stmt->bind_param("isss", $number, $id, $content, $date);

$result = $stmt->execute();

if ($result) {
    ?>
    <script>
        alert("<?php echo "Added Successfully." ?>");
        location.replace("./read.php?number=<?= $number ?>");
    </script>
    <?php
} else {
    // 쿼리 오류 메시지 출력
    echo "Failed : " . mysqli_error($connect);
}

$stmt->close();
mysqli_close($connect);
?>
