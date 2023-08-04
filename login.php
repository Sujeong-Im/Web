<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Member Sign In</title>
    <style>
        h2 { color: salmon; margin-left: 80px;}
        form { border: 3px solid white; margin-left: 20px;}
        .subBtn {
            display: inline-block;
            justify-content: center;
            align-items: center; 
            margin-left: 50px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .subBtn:hover { background-color: #45a049;}
        .subBtn:focus { outline: none; }
        ul { list-style: none; }
        ul li {
            display: inline;
            padding: 0 10px;
        }
        ul li a { text-decoration: none; color: gray;}
        ul li a:hover { text-decoration: underline; color: palevioletred}
    </style>
</head>
<body>
    <h2>Sign In</h2>
    <form method="post" action="login_ok.php">
        <label for="username">ID:</label>
        <input type="text" name="id" required><br><br>
        <label for="password">PW:</label>
        <input type="password" name="pw" required><br><br>
        <input type="submit" value="Submit" class="subBtn">
        <ul>
            <li><a href="register.php">Sign Up</a></li>
            <li><a href="findpw.php">Forgot Password</a></li>
        </ul>
    </form>
</body>
</html>