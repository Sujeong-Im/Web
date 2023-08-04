<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Member Registration</title>
    <style>
        h2 { color:cornflowerblue; margin-left: 80px; }
        label { text-decoration: none;}
        form { border: 3px solid white; margin-left: 20px;}
        .subBtn {
            display: inline-block;
            justify-content: center;
            align-items: center; 
            padding: 10px 20px;
            margin-left: 50px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .subBtn:hover {
            background-color: #45a049;
        }

        .subBtn:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <h2>Sign Up</h2>
    <form action="register_ok.php" method="POST">
        <label for="id">ID:</label>
        <input type="text" name="id" required><br><br>
        <label for="password">PW:</label>
        <input type="password" name="pw" required><br><br>
        <input type="submit" value="Submit" class="subBtn">
    </form>
</body>
</html>