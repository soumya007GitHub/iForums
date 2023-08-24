<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Search results</title>
  </head>
  <body>
    <?php 
    include 'partials\_header.php';
    include 'partials\_dbconnect.php';
    $search = $_GET['search'];
    echo '<div class="container mt-5 mb-5">
    <h3>Search results for <em>"'.$search.'"</em></h3>
    </div>
    <div class = "container">';

    $sql = "SELECT * FROM `threads` where match (thread_title, thread_desc) against ('$search')";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $number = mysqli_num_rows($result);
    if($number == 0){
        echo '<p class = "lead">No results found :)</p>';
    }
    while($row = mysqli_fetch_assoc($result)){
        $thread_id = $row['thread_id'];
      $thread_title = $row['thread_title'];
      $thread_desc = $row['thread_desc'];
      $url = "threads.php?threadId=".$thread_id;
            echo '<div class="container">
        <h5 class="mt-0"><a href = "'.$url.'">'.$thread_title.'</a></h5>';
         echo '<p>'.$thread_desc.'</p></div><hr>';
        }
    echo "</div>";
    ?>
    <?php
    echo '<footer class = "bg-dark p-3" style = "position:absolute; bottom:0; width:100%">
    <p class = "mb-0" style = "text-align : center; color:white;">Copyright iForums | All rights reserved</p>
</footer>';
     ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
