<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sujeong's Home</title>
        <style>
            #image {
                display: flex; 
                justify-content: center;
                align-items: center; 
	        }
            table { border-top: 1px solid black; text-align: center; }
            tr { border-bottom: 1px solid black; padding: 10px; }
            td { border-bottom: 1px solid black; padding: 10px; }
            .text { text-align: center; padding-top: 20px; }
	        .text:hover { text-decoration: underline; }
            h3 { text-align: center; }
            thead { background-color: gainsboro; height: 30px;}
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
            .container {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .writeBtn {
                display: inline-block;
                padding: 10px 20px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 4px;
                font-size: 16px;
                cursor: pointer;
            }

            .flex-container {
                display: flex;
                align-items: center;
            }
            .orderBtn {
                margin-left: 250px;
                background-color: orange;
                border-radius: 3px;
                font-size: 15px;
                cursor: pointer;
                border: none;
            }
            .searchForm {
                margin-left: 700px;
                display: flex;
            }
        </style>
    </head>
    <body>          
        <?php
          $connect = mysqli_connect('localhost', 'sio2', 'dancingCat42', 'log_db') or die("connect failed");
          $result = mysqli_query($connect, $query);
          $total = mysqli_num_rows($result);
	      session_start();

	  if(isset($_SESSION['userid'])) {
          ?>
        <button onclick="location.href='./logout.php'" style="float:right; font-size:15px;">Log out</button><br/>
          <?php
	  } else {
          ?>
	    <button onclick="location.href='./login.php'" style="float:right; font-size:15px;">Sign In</button><br/><br>
          <?php
          }
          ?>
        <br>
        <div id="main">
            <h1><strong>Welcome! This is Sujeong's.</strong></h1>
            Hi, <b><?php echo $_SESSION['userid']; ?></b>
	    </div>

        <h3>Board</h3><br>
        <?php
            $order = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'desc' : 'asc';
            $query = "SELECT * FROM board ORDER BY number $order";
            $result = $connect->query($query);
        ?>
        
        <div class="flex-container">
            <button onclick="toggleOrder()" class="orderBtn">
                <?php echo $order === 'asc' ? '최신순' : '오래된순'; ?>
            </button>

            <form action="search.php" method="get" class="searchForm">
                <input type="text" name="query" placeholder="제목 또는 작성자로 검색">
                <button type="submit">검색</button>
            </form>
        </div><br>

        <table align="center">
            <thead align="center">
                <tr>
                    <td width="50">No.</td>
                    <td width="500">Title</td>
                    <td width="100">Writer</td>
                    <td width="200">Date</td>
                <td width="50">Hits</td>
                </tr>
            </thead>
            <tbody>
            <?php
            $total = mysqli_num_rows($result);
            while ($rows = mysqli_fetch_assoc($result)) {
                 if ($total % 2 == 0) {
            ?>
                 <tr class="even">
                <?php } else { ?>
                    <tr>
                <?php } ?>
                    <td width="50" align="center"><?php echo $total ?></td>
                    <td width="500" align="center">
                        <a href="read.php?number=<?php echo $rows['number'] ?>">
                            <?php echo $rows['title'] ?>
                        </a>
                    </td>
                    <td width="100"><?php echo $rows['id'] ?></td>
                    <td width="200"><?php echo $rows['date'] ?></td>
                    <td width="50"><?php echo $rows['hit'] ?></td>
                    </tr>
                <?php
                $total--;
            }
            ?>
            </tbody>
        </table><br><br>
 
 <script>
     function toggleOrder() {
         var currentOrder = "<?php echo $order; ?>";
         var newOrder = currentOrder === 'asc' ? 'desc' : 'asc';
         var currentURL = window.location.href;
 
         if (currentURL.includes('order=')) {
             var updatedURL = currentURL.replace(/order=\w+/, 'order=' + newOrder);
         } else {
             updatedURL = currentURL + (currentURL.includes('?') ? '&' : '?') + 'order=' + newOrder;
         }
         window.location.href = updatedURL;
     }
 </script>

        <div class="container">
            <button class="writeBtn" onclick="location.href='./write.php'">글쓰기</button>
        </div>
    </body>
</html>
