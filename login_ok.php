<?php
session_start();

$connect = mysqli_connect("localhost", "sio2", "dancingCat42", "log_db") or die("connect failed");
$id = $_POST['id'];
$pw = $_POST['pw'];

$query = "select * from member where id='$id'";
$result = $connect->query($query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    if ($row['password'] == $pw) {
        $_SESSION['userid'] = $id;
        if (isset($_SESSION['userid'])) {
?> <script>
                location.replace("./home2.php");
            </script>
        <?php
        } else {
            echo "session failed";
        }
    } else {
        ?> <script>
            alert("Check your ID/PW.");
            history.back();
        </script>
    <?php
    }
} else {
    ?> <script>
        alert"Check your ID/PW.");
        history.back();
    </script>
<?php
}
?>
