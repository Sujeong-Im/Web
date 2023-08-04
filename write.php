<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <style>
        table.table2 {
            border-collapse: separate;
            border-spacing: 1px;
            text-align: left;
            line-height: 1.5;
            border-top: 1px solid #ccc;
            margin: 20px 10px;
        }

        table.table2 tr {
            width: 50px;
            padding: 10px;
            font-weight: bold;
            vertical-align: top;
            border-bottom: 1px solid #ccc;
        }

        table.table2 td {
            width: 100px;
            padding: 10px;
            vertical-align: top;
            border-bottom: 1px solid #ccc;
	}
        
    </style>
</head>

<body>
    <?php
    session_start();
    $URL = "./login.php";
    if (!isset($_SESSION['userid'])) {
    ?>
        <script>
            alert("You need to log in first.");
            location.replace("<?php echo $URL ?>");
        </script>
    <?php
    }
    ?>

    <form method="post" action="write_ok.php" enctype="multipart/form-data">
        <table style="padding-top:50px" align=center width=auto border=0 cellpadding=2>
            <tr>
                <td style="height:30; float:center; background-color: cornflower">
                    <p style="font-size: 20px; text-align:center; color:white; margin-top:15px; margin-bottom:15px"><b>Create a Post</b></p>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="table2">
                        <tr>
                            <td>Writer</td>
                            <td><input type="hidden" name="name" value="<?= $_SESSION['userid'] ?>"><?= $_SESSION['userid'] ?></td>
                        </tr>

                        <tr>
                            <td>Title</td>
                            <td><input type="text" name="title" size=60></td>
                        </tr>

                        <tr>
                            <td>Content</td>
                            <td><textarea name="content" cols=75 rows=15></textarea></td>
                        </tr>
                        <tr>
                            <td>FILE: <input type="file" name="fileToUpload"></td>
                        </tr>
                    </table>

                    <center>
                        <input style="height: 40px; width: 60px; font-size: 20px; border: none;" type="submit" value="작성">
                    </center>
                </td>
            </tr>
        </table>
    </form>
</body>

</html>