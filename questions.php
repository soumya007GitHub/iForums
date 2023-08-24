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
    include 'partials\_header.php';
    include 'partials\_dbconnect.php';
    $id  = $_GET['catid'];
$sql = "SELECT * FROM `categories` WHERE category_id = $id";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
  $title = $row['category_name'];
  $description = $row['category_description'];
echo '<div class="container">
<div class="jumbotron mt-5">
<h1 class="display-4">'.$title.'</h1>
<p class="lead">'.$description.'</p>';
}
    ?>
<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
  $question = $_POST['question'];
  $question = str_replace("<", "&lt;", $question);
  $question = str_replace(">", "&gt;", $question);
  $desc = $_POST['desc'];
  $sel = $_SESSION['sl'];
  $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$question', '$desc', '$id', '$sel', current_timestamp())";
  $result = mysqli_query($conn, $sql);
  if(!$result){
    echo "Failed to raise the question.";
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
  <h3 class = "mb-3">Enter your question</h3>
  <?php
  if(isset($_SESSION['loggedin']) && $_SESSION == true){
    echo '<form action = "questions.php?catid='.$id.'" method = "post">
    <div class="form-group">
      <input type="text" class="form-control" id="question" name = "question" aria-describedby="emailHelp" placeholder="Enter your question">
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="desc" name = "desc" placeholder="Description">
    </div>
    <button type="submit" class="btn btn-primary mb-5">Submit</button>
  </form>';
  }
  else{
    echo '<div class="container">
    <p>
    You are not logged in, please login to ask a question.
    </p>
    </div>
    <h3>Browse Questions</h3>';
  }
   ?>
</div>

<hr>
<div class = "container">
<?php
$id  = $_GET['catid'];
$sql = "SELECT * FROM `threads` WHERE thread_cat_id = $id";
$result = mysqli_query($conn, $sql);
$noResult = true;
while($row = mysqli_fetch_assoc($result)){
  $noResult = false;
  $thread_id = $row['thread_id'];
  $thread_title = $row['thread_title'];
  $thread_user_id = $row['thread_user_id'];
  $thread_desc = $row['thread_desc'];
  $thread_time = $row['timestamp'];
  $sql2 = "SELECT * FROM `users` WHERE `sl` = $thread_user_id";
  $result2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_assoc($result2);
  $user_email = $row2['user_email'];
echo '<div class="media my-3">
  <img class="mr-3" src="images/2.png" alt="Generic placeholder image" style = "width : 60px; border-radius:200px;">
  <div class="media-body">
  <p>'.$user_email.' posted at '.$thread_time.'</p>
    <h5 class="mt-0"><a href = "threads.php?threadId='.$thread_id.'">'.$thread_title.'</a></h5>'.
    $thread_desc
  .'</div>
</div>
<hr>'; }
if($noResult){
  echo '<p>Be the first one to raise a question.</p>';
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