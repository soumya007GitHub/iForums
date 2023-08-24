<?php
session_start();
include '_dbconnect.php';

$sql = "SELECT * from `categories`";
$result = mysqli_query($conn, $sql);


echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="/">iForums</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Categories
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">';

while($row = mysqli_fetch_assoc($result)){
  $id = $row['category_id'];
  $title = $row['category_name'];
  echo '<a class="dropdown-item" href="questions.php?catid='.$id.'">'.$title.'</a>';
}

    echo '
    </div>
    </li>
    <li class="nav-item">
      <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
    </li>
  </ul>
  <form action = "result.php" method = "get" class="form-inline my-2 my-lg-0">
    <input name = "search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-primary my-2 my-sm-0 mr-2" type="submit">Search</button>
  </form>';
  ?>

  <?php
  
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    echo '<p class= "mt-3 mr-2" style = "color: white;">';
    echo $_SESSION['username'];
    echo '</p>';
    echo '<button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><a href = "partials/_logout.php" style = "text-decoration : none; color:white;">Log Out</a></button>';
  }
  else{
    echo '
    <button class="btn btn-outline-primary  my-2 my-sm-0" data-toggle="modal" data-target="#signinModal" type="submit">Sign in</button>
    <button class="btn btn-outline-primary ml-2 my-2 my-sm-0" data-toggle="modal" data-target="#signupModal" type="submit">Sign Up</button>
    ';
  }
  echo '</div>
  </nav>';
?>
<?php
echo '
<!-- Modal for sign in -->
<div class="modal fade" id="signinModal" tabindex="-1" role="dialog" aria-labelledby="signinModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signinModalLabel">Sign In</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action = "partials/_handlesignin.php" method = "post">
      <div class="form-group">
        <label for="signinemail">Email address</label>
        <input type="email" class="form-control" id="signinemail" name="signinemail" aria-describedby="emailHelp">
        <small id="emailHelp" class="form-text text-muted">We\'ll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="signinpassword">Password</label>
        <input type="password" class="form-control" id="signinpassword" name="signinpassword">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal for sign up -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action = "partials/_handlesignup.php" method = "post">
      <div class="form-group">
        <label for="signupemail">Email address</label>
        <input type="email" class="form-control" id="signupemail" name = "signupemail" aria-describedby="emailHelp" required>
        <small id="emailHelp" class="form-text text-muted">We\'ll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="signuppassword">Password</label>
        <input type="password" class="form-control" id="signuppassword" name = "signuppassword" required>
      </div>
      <div class="form-group">
        <label for="signupcpassword">Confirm Password</label>
        <input type="password" class="form-control" id="signupcpassword" name = "signupcpassword" required>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
      </div>
    </div>
  </div>
</div>';
 ?>