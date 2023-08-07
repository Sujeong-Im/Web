<?php
$connect = mysqli_connect('localhost', 'sio2', 'dancingCat42', 'log_db') or die("connect failed");

$id = $_POST['name'];
$title = $_POST['title'];
$content = $_POST['content'];
$date = date('Y-m-d H:i:s');
$upload_dir = "./upload/";
$filename = $_FILES['fileToUpload']['name'];
$tmpfile = $_FILES['fileToUpload']['tmp_name'];
$allowedImageTypes = array("image/gif");
$allowedTextTypes = array("text/plain");

$fileType = $_FILES['fileToUpload']['type'];

if (in_array($fileType, $allowedImageTypes) || in_array($fileType, $allowedTextTypes)) {
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 777, true); 
    }
    $folder = $upload_dir . $filename;
    move_uploaded_file($tmpfile, $folder);

    $query = "INSERT INTO board (number, title, content, date, hit, id, file) VALUES (null, ?, ?, ?, 0, ?, ?)";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("sssss", $title, $content, $date, $id, $filename);

    if ($stmt->execute()) {
        // 데이터 삽입 성공
        $stmt->close();
        mysqli_close($connect);
        header("Location: ./home2.php");
        exit();
    } else {
        // 데이터 삽입 실패
        echo "데이터 삽입 실패: " . $stmt->error;
        $stmt->close();
        mysqli_close($connect);
    }
} else {
    echo "허용되지 않는 파일 유형입니다.";
}
?>
