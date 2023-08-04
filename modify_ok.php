<?php
$connect = mysqli_connect('localhost', 'sio2', 'Sio2password$', 'log_db') or die("connect failed");
$number = $_POST['number'];
$title = $_POST['title'];
$content = $_POST['content'];

$date = date('Y-m-d H:i:s');

$query = "update board set title='$title', content='$content', date='$date' where number=$number";
$result = $connect->query($query);
if ($result) {
?>
    <script>
        alert("Edited Successfully");
        location.replace("./read.php?number=<?= $number ?>");
    </script>
<?php } else {
    echo "Please Try Again.";
}

mysqli_close($connect);
?>