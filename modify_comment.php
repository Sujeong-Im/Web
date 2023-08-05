<!DOCTYPE html>
<html>
<head>
    <title>EDIT COMMENTS</title>
    <style>
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
    $connect = mysqli_connect('localhost', 'sio2', 'dancingCat42', 'log_db');
    $number = $_GET['number'];
    $cnumber = $_GET['comment_number'];

    session_start();
    ?>
    <h3>EDIT COMMENTS</h3>
    <!--- 댓글 입력 폼 -->
    <form method="post" action="modify_comment_ok.php">
        <table style="padding-top:20px" width=auto border= "0" cellpadding="2">
            <tr>
                <td>
                    <input type="hidden" name="board_number" value="<?= $number ?>"> 
                    <input type="hidden" name="comment_number" value="<?= $cnumber ?>">
                </td>
            </tr>
            <tr>
                <td class="container">
                    <textarea name="comment_content" cols="50" rows="2" placeholder="댓글을 입력해보세요."></textarea>&nbsp;&nbsp;
                    <input class="comment_btn" style="height:40px; width:47px; font-size:16px;" type="submit" value="등록">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
