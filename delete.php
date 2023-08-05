<?php
$connect = mysqli_connect('localhost', 'sio2', 'dancingCat42', 'log_db') or die("connect failed");
$number = $_GET['number'];
$query = "select id from board where number = $number";
$result = $connect->query($query);
$rows = mysqli_fetch_assoc($result);
$userid = $rows['id'];

session_start();

$URL = "./home2.php";
?>

<?php
if (!isset($_SESSION['userid'])) {
?> <script>
        alert("Have No Privileges.");
        location.replace("<?php echo $URL ?>");
    </script>

<?php } else if ($_SESSION['userid'] == $userid) {
    $query1 = "delete from board where number = $number";
    $result1 = $connect->query($query1); ?>
    <script>
        alert("Deleted Successfully");
        location.replace("<?php echo $URL ?>");
    </script>

<?php } else { ?>
    <script>
        alert("Have No Privileges.");
        location.replace("<?php echo $URL ?>");
    </script>
<?php }
?>
