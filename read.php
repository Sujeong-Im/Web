<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <style>
    .read_table {
        border: 1px solid #444444;
        margin-top: 30px;
        margin-left: 30px;
    }
    .read_title {
        height: 45px;
        font-size: 23.5px;
        text-align: center;
        background-color: cornflowerblue;
        color: white;
        width: 1000px;
    }
    .read_id {
        text-align: center;
        background-color: #EEEEEE;
        width: 30px;
        height: 33px;
    }
    .read_id2 {
        background-color: white;
        width: 60px;
        height: 33px;
        padding-left: 10px;
    }
    .read_hit {
        background-color: #EEEEEE;
        width: 30px;
        text-align: center;
        height: 33px;
    }
    .read_hit2 {
        background-color: white;
        width: 60px;
        height: 33px;
        padding-left: 10px;
    }
    .read_content {
        padding: 20px;
        border-top: 1px solid #444444;
        height: 500px;
    }
    .read_btn {
        width: 700px;
        height: 200px;
        text-align: center;
        margin: auto;
        margin-top: 30px;
    }
    .read_btn1 {
        height: 45px;
        width: 90px;
        margin-left: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }
    .read_comment_input {
        width: 700px;
        height: 500px;
        text-align: center;
        margin: auto;
    }
    .read_text3 {
        font-weight: bold;
        float: left;
        margin-left: 20px;
    }
    .read_com_id {
        width: 100px;
    }
    .container {
        display: flex;
    }
    .comment_btn {
        border: none;
        background-color: #FFCCCC;
        color: black;
        border-radius: 4px;
        font-size: 10px;
    }
</style>
</head>
<body>
    <?php
    $connect = mysqli_connect('localhost', 'sio2', 'Sio2password$', 'log_db');
    $number = $_GET['number'];
    $cnumber = $_GET['comment_number'];
    session_start();
    $query = "SELECT title, content, date, hit, id, file FROM board WHERE number = $number";
    $query2 = "SELECT comment_number, id, content, date FROM comment WHERE board_number = $number";
    $result = $connect->query($query);
    $result2 = $connect->query($query2);
    $rows = mysqli_fetch_assoc($result);

    $hit = "UPDATE board SET hit = hit + 1 WHERE number = $number";
    $connect->query($hit);
    ?>

    <table class="read_table" float=center>
        <tr>
            <td colspan="4" class="read_title"><?php echo $rows['title'] ?></td>
        </tr>
        <tr>
            <td class="read_id">Writer</td>
            <td class="read_id2"><?php echo $rows['id'] ?></td>
            <td class="read_hit">Hits</td>
            <td class="read_hit2"><?php echo $rows['hit'] + 1 ?></td>
        </tr>
        <tr>
            <td colspan="4" class="read_content" valign="top">
                <?php echo $rows['content'] ?>
            </td>
        </tr>
<?php if (!empty($rows['file'])) { ?>
    <tr>
        <td>
        <a href="./upload/<?php echo $rows['file'];?>" download><?php echo $rows['file']; ?></a>
        </td>
    </tr>
<?php } else {
    echo "File is empty or not found.";
} ?>

    </table>
    <div class="read_btn">
        <button class="read_btn1" onclick="location.href='./home2.php'">목록</button>&nbsp;&nbsp;
        <?php
        if (isset($_SESSION['userid']) and $_SESSION['userid'] == $rows['id']) { ?>
            <button class="read_btn1" onclick="location.href='./modify.php?number=<?= $number ?>'">수정</button>&nbsp;&nbsp;
            <button class="read_btn1" onclick="ask();">삭제</button>
            <script>
                function ask() {
                    if (confirm("게시글을 삭제하시겠습니까?")) {
                        window.location = "./delete.php?number=<?= $number ?>"
                    }
                }
            </script>
        <?php } ?>
    </div>

    <h3>COMMENTS</h3>
    <form method="post" action="comment_ok.php">
        <table style="padding-top:20px" width=auto border= "0" cellpadding="2">
            <tr>
                <td><input type="hidden" name="username" value="<?= $_SESSION['userid'] ?>"><strong><?= $_SESSION['userid'] ?></strong></td>
                    <input type="hidden" name="board_number" value="<?= $number ?>"> <!-- 게시글 번호를 hidden 필드로 전달합니다. -->
            </tr>
            <tr>
                <td class="container">
                    <textarea name="comment_content" cols="50" rows="2" placeholder="댓글을 입력해보세요."></textarea>&nbsp;&nbsp;
                    <input class="comment_btn" style="height:40px; width:47px; font-size:16px;" type="submit" value="등록">
                </td>
            </tr>
        </table>
    </form><br>

    <?php
    if ($result2->num_rows > 0) {
        while ($comment = $result2->fetch_assoc()) {
            $commentNumber = $comment['comment_number'];
            $isCommentAuthor = isset($_SESSION['userid']) && ($_SESSION['userid'] == $comment['id']);
    ?>
        <div class="read_comment">
            <div class="read_com_id"><strong><?= $comment['id'] ?></strong></div>
            <div class="read_com_content"><?= $comment['content'] ?></div>
            <div class="read_com_date"><?= $comment['date'] ?></div>
            <?php if ($isCommentAuthor) { ?>
                <button class="comment_btn" onclick="location.href='./modify_comment.php?board_number=<?= $number ?>&comment_number=<?= $comment['comment_number'] ?>'">수정</button>
                <button class="comment_btn" onclick="askDelete(<?= $comment['comment_number'] ?>)">삭제</button>

                <script>
                    function askDelete(commentNumber) {
                        if (confirm("댓글을 삭제하시겠습니까?")) {
                            window.location = "./delete_comment.php?board_number=<?= $number ?>&comment_number=" + commentNumber;
                        }
                    }
                </script>
            <?php } ?>
        </div><br>
    <?php
        }
    } else {
        echo "No comment yet.";
    }
    ?>


</body>
</html>