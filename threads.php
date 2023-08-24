<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Questions</title>
  </head>
  <body>
    <?php 
    include 'partials/_header.php';
    include 'partials/_dbconnect.php';
    $id  = $_GET['threadId'];
$sql = "SELECT * FROM `threads` WHERE thread_id = $id";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
    $thread_id = $row['thread_id'];
  $thread_title = $row['thread_title'];
  $thread_description = $row['thread_desc'];
  $thread_time = $row['timestamp'];
echo '<div class="container" style = "word-wrap: break-word;">
<div class="jumbotron mt-5">
<h4 class="display-4">'.$thread_title.'</h4>
<p class="lead">'.$thread_description.'</p>';
}
    ?>
    <?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
  $comment = $_POST['comment'];
  $comment = str_replace("<", "&lt;", $comment);
  $comment = str_replace(">", "&gt;", $comment);
  $sel = $_SESSION['sl'];
  $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sel', current_timestamp())";
  $result = mysqli_query($conn, $sql);
  if(!$result){
    echo "Failed to submit the comment.";
  }
}
 ?>
    
  <hr class="my-4">
  <p>Do not spam |
Do Not Bump Posts |
Do Not Offer to Pay for Help |
Do Not Offer to Work For Hire |
Do Not Post About Commercial Products |
Do Not Create Multiple Accounts</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
  </p>
</div>

<div class="container">
  <h3 class = "mb-3">Enter your comment</h3>
  <?php
  if(isset($_SESSION['loggedin']) && $_SESSION == true){
  echo '
  <form action = "threads.php?threadId='.$id.'" method = "post">
  <div class="form-group">
    <input type="text" class="form-control" id="comment" name = "comment" placeholder="Description">
  </div>
  <button type="submit" class="btn btn-primary mb-5">Post Comment</button>
</form>';
  }
  else{
    echo '
    <div class="container">
    <p class="lead">
    You are not logged in, please login to share your comment.
    </p>
    </div>
    ';
  }
   ?>
</div>

 <div class = "container">
  <h3>Browse Comments</h3>
  <hr>
<?php
$sql = "SELECT * FROM `comments` WHERE thread_id = '$id'";
$result = mysqli_query($conn, $sql);
$noResult = true;
while($rows = mysqli_fetch_assoc($result)){
  $noResult = false;
  $comment = $rows['comment_content'];
  $number = $rows['comment_by'];
  $sql3 = "SELECT * FROM `users` WHERE sl = '$number'";
  $result3 = mysqli_query($conn, $sql3);
  $row3 = mysqli_fetch_assoc($result3);
  echo '<div class="media my-3">
  <img class="mr-3" src="images/2.png" alt="Generic placeholder image" style = "width : 60px; border-radius:200px;">
  <div class="media-body">
  <p>'.$row3['user_email'].' posted at '.$thread_time.'</p>
    <p class="mt-0">'.$comment.'</p></div>
</div>
<hr>';
}
if($noResult == true){
  echo "<p>Be the first one to comment.</p>";
}
 ?>
 </div>
</div>
<?php
    include 'partials\_footer.php';
    ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>