<?php
include 'partials/_dbconnect.php';
$sql = "SELECT * FROM `categories`";
$result = mysqli_query($conn, $sql);
echo '<h2 class = "text-center my-5">Categories</h2>
<div class = "container">
<div class = "row">
';
while($row = mysqli_fetch_assoc($result)){
  $id = $row['category_id'];
  $title = $row['category_name'];
  $description = $row['category_description'];
  echo '<div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card mb-5" style="width:80%;margin:10px auto">
                  <img src="https://source.unsplash.com/500x400/?programming, coding,'.$title.'" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><a href = "questions.php?catid='.$id.'">'.$title.'</a></h5>
                  <p class="card-text">'.$description.'</p>
                  <a href="questions.php?catid='.$id.'." class="btn btn-primary">Explore Now</a>
                </div>
            </div>
        </div>';
}
echo '</div>
</div>';
 ?>