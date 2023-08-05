<?php
$connect = mysqli_connect('localhost', 'sio2', 'dancingCat42', 'log_db') or die("connect failed");

$id = $_POST['id'];
$pw = $_POST['pw'];
$date = date('Y-m-d H:i:s');
$query1 = "select * from member where id='$id'";
$result1 = $connect->query($query1);
$count = mysqli_num_rows($result1);

if ($count) {

?><script>
        alert('This ID already exists.');
        history.back();
    </script>
    <?php } else {

    $query = "insert into member(id, password, date, permit) values('$id', '$pw', '$date', 0)";

    $result = $connect->query($query);

    if ($result) {
    ?> <script>
            alert('Welcome!');
            location.replace("./login.php");
       </script>

    <?php } else {
    ?> <script>
            alert("Failed to Register");
        </script>
<?php }
}
mysqli_close($connect);
?>
