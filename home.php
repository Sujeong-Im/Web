<!DOCTYPE html>
<html>
    <head>
        <style>
            #image {
                display: flex; 
                justify-content: center;
                align-items: center; 
            }
            #main {
                width: 600px;
                height: 130px;
                border: 2px solid skyblue;
                margin-top: 20px;
                margin-left: auto;
                margin-right: auto;
                text-align: center;
                background-color:floralwhite;
            }
            ul {
               list-style: none;
               text-align: center; 
            }
            ul li {
                display: inline;
                padding: 0 10px;
                letter-spacing: 3px;
            }
            ul li a { text-decoration: none; color: black}
            ul li a:hover { text-decoration: underline; color: greenyellow}
        </style>
        <meta charset="UTF-8">
        <title>Sujeong's Home</title>
    </head>
    <body>
        <br><br><br>
        <div id="main">
        <h1><strong>Welcome! This is Sujeong's.</strong></h1>
        <h2>You need to <em>Sign In </em>or <em>Sign Up</em>.</h2>
        </div>
        <ul>
            <li><a href="./login.php">Sign In</a></li>
            <li><a href="./register.php">Sign Up</a></li>
        </ul><br>
    </body>
</html>