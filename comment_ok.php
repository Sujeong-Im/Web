<?php
$connect = mysqli_connect("localhost", "sio2", "dancingCat42", "log_db") or die("Connection Failed");

$id = $_POST['username'];
$number = $_POST['board_number'];
$content = $_POST['comment_content'];
$date = date('Y-m-d H:i:s');

$query = "INSERT INTO comment (board_number, id, content, date, comment_number) VALUES ('$number', '$id', '$content', '$date', null)";
$result = $connect->query($query);

if ($result) {
    ?>
    <script>
        alert("<?php echo "Added Successfully." ?>");
        location.replace("./read.php?number=<?= $number ?>");
    </script>
    <?php
} else {
    echo "Failed : " . mysqli_error($connect);
}

mysqli_close($connect);
?>

