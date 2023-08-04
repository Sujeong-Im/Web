<?php
$connect = mysqli_connect("localhost", "sio2", "Sio2password$", "log_db") or die("fail");

$id = $_POST['name'];
$title = $_POST['title'];
$content = $_POST['content'];
$date = date('Y-m-d H:i:s');
$URL ='./home2.php';

$tmpfile = $_FILES['fileToUpload']['tmp_name'];
$o_name = $_FILES['fileToUpload']['name'];
$filename = $_FILES['fileToUpload']['name'];
$folder = "./upload/".$filename;
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 777, true); 
}
move_uploaded_file($tmpfile, $folder);

$query = "INSERT INTO board (number, title, content, date, hit, id, file) values(null, '$title', '$content', '$date', 0, '$id', '$filename')";

$result = $connect->query($query);
if ($result) {
?> <script>
        alert("<?php echo "Added Successfully." ?>");
        location.replace("<?php echo $URL ?>");
    </script>
<?php
} else {
	echo "Failed to create a post.";
}

mysqli_close($connect);
?>