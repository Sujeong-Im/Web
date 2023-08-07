<!DOCTYPE html>
<html>
<head>
    <title>Board Search Page</title>
    <style>
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

            .homeBtn {
                margin-left: 100px;
                background-color: orange;
                border-radius: 3px;
                font-size: 12px;
                cursor: pointer;
            }
            .orderBtn {
                margin-left: 250px;
                background-color: orange;
                border-radius: 3px;
                font-size: 15px;
                cursor: pointer;
                border: none;
            }
    </style>
</head>
<body>
    <?php
        $connect = mysqli_connect('localhost', 'sio2', 'dancingCat42', 'log_db') or die("connect failed");
        $result = mysqli_query($connect, $query);
        $total = mysqli_num_rows($result);
	    session_start();
    ?>
    <br><br>
    <button class="homeBtn" onclick="location.href='./home2.php'">BACK</button><br><br>
    <div id="main">
        <h1><strong>Welcome! This is Sujeong's.</strong></h1>
        <h3>Here the <em>result</em> you are!</h3>
	</div><br><br>
    <?php
        // Retrieve the sorting order from the URL parameter
        $order = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'desc' : 'asc';
 
        // Modify the SQL query to reflect the desired sorting order
        $query = "SELECT * FROM board ORDER BY number $order";
        $result = $connect->query($query);
    ?>
        
    <!-- Sort button -->
    <button onclick="toggleOrder()" class="orderBtn">
        <?php echo $order === 'asc' ? '최신순' : '오래된순'; ?>
    </button><br><br>

    <script>
     function toggleOrder() {
         var currentOrder = "<?php echo $order; ?>";
         var newOrder = currentOrder === 'asc' ? 'desc' : 'asc';
         var currentURL = window.location.href;
 
         // Check if the 'order' parameter exists in the URL
         if (currentURL.includes('order=')) {
             // Replace the 'order' parameter in the URL with the new sorting order
             var updatedURL = currentURL.replace(/order=\w+/, 'order=' + newOrder);
         } else {
             // Add the 'order' parameter to the URL
             updatedURL = currentURL + (currentURL.includes('?') ? '&' : '?') + 'order=' + newOrder;
         }
 
         // Redirect to the updated URL
         window.location.href = updatedURL;
     }
    </script>

    <div id="searchResults">
        <?php
        if (isset($_GET['query'])) {
            $searchQuery = $_GET['query'];

            $connect = mysqli_connect('localhost', 'sio2', 'dancingCat42', 'log_db') or die("connect failed");
            $sql = "SELECT * FROM board WHERE title LIKE '%$searchQuery%' OR id LIKE '%$searchQuery%' ORDER BY number " . $order;
            $result = $connect->query($sql);

            if (mysqli_num_rows($result) > 0) {
                echo '<table align="center">';
                echo '<thead align="center">';
                echo '<tr>';
                echo '<td width="50">No.</td>';
                echo '<td width="500">Title</td>';
                echo '<td width="100">Writer</td>';
                echo '<td width="200">Date</td>';
                echo '<td width="50">Hits</td>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                $total = mysqli_num_rows($result);
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($total % 2 == 0) {
                        echo '<tr class="even">';
                    } else {
                        echo '<tr>';
                    }
                    echo '<td width="50" align="center">' . $total . '</td>';
                    echo '<td width="500" align="center">';
                    echo '<a href="read.php?number=' . $row['number'] . '">' . $row['title'] . '</a>';
                    echo '</td>';
                    echo '<td width="100">' . $row['id'] . '</td>';
                    echo '<td width="200">' . $row['date'] . '</td>';
                    echo '<td width="50">' . $row['hit'] . '</td>';
                    echo '</tr>';
                    $total--;
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<div class="no-results"><h3>No matching posts found.</h3></div>';
            }
        }
        ?>
    </div><br><br><br><br><br>
    <div class="container">
        <button class="writeBtn" onclick="location.href='./write.php'">글쓰기</button>
    </div>
</body>
</html>

