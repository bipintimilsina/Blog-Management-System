<?php include ("path.php");


include (ROOT_PATH . '/app/controller/posts.php')
;
//id comes from the index.php page
// guestOnly();
// usersOnly();

if (isset($_GET['id'])) {
  $post = selectOne('posts', ['id' => $_GET['id']]);



}
$topics = selectAll('topics');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,
    initial-scale=1.0" ,maximum-scale=1.0,user-scalable=no ">
    <title><?php
    echo $post['title'];
    ?> | FewaBoat Blogs</title>
    
    
    
    <link rel=" stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
  <!-- poppins font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="css/styles.css" />
  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="assets/images/fav-icon.svg" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100" rel="stylesheet">
  <script src="https://kit.fontawesome.com/70e6448a33.js" crossorigin="anonymous">
  </script>


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="sha512-5mDa1dSiRRy1x5kS4n8FE8WyWfjji3AFTuDmzWnmM8++G1wQYYasHfXY5jrXNq5FjF6PQXAd8BH+w2fNsh2WZg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />


  <script>
    function showReplyBox(commentId) {
      var replyBox = document.getElementById('reply-box-' + commentId);
      replyBox.style.display = 'block';
      replyBox.querySelector('textarea').focus();
    }
  </script>
</head>

<body>

  <?php include (ROOT_PATH . "/app/include/header.php")
  ;
  ?>



  <!-- content -->
  <div class="content">


    <div class="main-content">

      <h1 class="post-title"><?php echo $post['title'];
      ?> </h1>
      <?php

      $post_id = $_GET['id']; // Replace with dynamic post_id based on your logic
      
      $like_count = getLikeCount($post_id);
      ?>


      <!-- //this is for name and date published -->
      <div class="post-meta ">
        <div>
          Posted by
          <i class="fa fa-user" aria-hidden="true"></i>
          <span class="username">
            <?php
            $post_id = $_GET['id'];

            // Fetch post details
            $poster = getPostDetails($conn, $post_id);
            echo htmlspecialchars($poster['username']); ?>
          </span>

        </div>
        <div class="class-for-doing-flex">

          <span class="dateTime">



            <i class="fa fa-calendar" aria-hidden="true"></i>
            <span class="date"><?php
            echo date('F j, Y', strtotime($post['created_at']));
            ?></>
            </span>

          </span>

          <span class="like-container">
            <form method="post" action="single.php?id=<?php
            echo $post_id
              ?>">
              <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
              <button type="submit" style="background:none; border:none; cursor:pointer;"><span
                  style="font-weight:560;">Liked by</span>
                <span class="material-icons like-icon">favorite_border</span>
              </button>
              <span style=""><?php echo $like_count; ?></span>
            </form>
          </span>
        </div>
      </div>
      <div class="post-content">
        <?php
        echo html_entity_decode($post['body']);
        ?>

      </div>


    </div>
    <div class="sidebar" id="sidebar">

      <div class="post-views-container">
        <h4>Post views</h4>
        <div class="post-views">
          <i class="far fa-eye"></i>
          <span class="count"><?php


          $total_visits = recordPostVisitAndViewCount($conn, $_GET['id']);
          echo $total_visits . " views"; ?></span>





        </div>

      </div>

      <?php
      // // Assuming $conn is your database connection
// $total_visits = recordPostVisitAndViewCount($conn, $_GET['id']);
// echo "Total visits: $total_visits";
      ?>

      <div class="container-search ">
        <h2>Search</h2>
        <form action="index.php" method="post">
          <input type="text" class="input-search" name="search-term" placeholder="
      Search...">
        </form>
      </div>

      <div class="topics container-search">
        <h1>Topics</h1>
        <ul>


          <?php
          foreach ($topics as $key => $topic) {

            ?>

            <li><a href="<?php
            echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'];
            ?>">

                <?php
                echo $topic['name'];
                ?></a></li>

          <?php } ?>


        </ul>
      </div>
    </div>

  </div>




  <?php

  ?>





  <div class="containery">
    <!-- <h1>Blog Post Title</h1> -->
    <div class="comment-section">
      <h2>Comments</h2>
      <div class="comment-form">
        <form method="post">
          <textarea name="comment" placeholder="Write your comment here" required></textarea>
          <button type="submit" name="com-submit">Submit Comment</button>
        </form>
      </div>
      <?php
      // include 'comments/submit_comment.php';
      ?>
      <?php
      //  include 'comments/view_comments.php';
      ?>
    </div>


















    <?php
    global $conn;

    $sql = "SELECT comments.*, users.username AS user_name FROM comments INNER JOIN users ON comments.user_id = users.id WHERE post_id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
      die("Error preparing statement: " . $conn->error); // Display the error message
    }

    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
      die("Error executing statement: " . $stmt->error); // Display the error message
    }


    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<div class='comment'>";
        echo "<div class='comment-header'>";
        echo "<i class='fas fa-user-circle' style='color: #4CAF50;'></i>";
        echo "<h3>" . htmlspecialchars($row["user_name"]) . "<h3>";
        echo "</div>";
        echo "<div class='comment-body'>";
        echo "<p>" . htmlspecialchars($row["comment"]) . "</p>";
        echo "</div>";
        echo "</div>";








      }
    } else {
      echo "No comments yet.";
    }

    $stmt->close();
    ?>



















  </div>



















  <?php include (ROOT_PATH . "/app/include/footer.php");

  ?>
  <?php
  // // Assuming you have already fetched comments
  // foreach ($comment as $comments) {
  //     echo "<div class='comment-container'>";
  //     echo "<p><strong>" . htmlspecialchars($comments['user_name']) . ":</strong> " . htmlspecialchars($comments['comment']) . "</p>";
  //     echo "<button onclick='showReplyBox(" . $comments['id'] . ")'>Reply</button>";
  
  //     // Display existing replies
  //     $replies = getReplies($comment['id']); // Assuming you have a function to fetch replies
  //     foreach ($replies as $reply) {
  //         echo "<div class='reply-container'>";
  //         echo "<p><strong>" . htmlspecialchars($reply['user_name']) . ":</strong> " . htmlspecialchars($reply['reply']) . "</p>";
  //         echo "</div>";
  //     }
  
  //     // Reply box
  //     echo "<div id='reply-box-" . $comment['id'] . "' class='reply-box'>";
  //     echo "<form action='singele.php' method='POST'>";
  //     echo "<textarea name='reply' rows='3' cols='50'></textarea>";
  //     echo "<input type='hidden' name='comment_id' value='" . $comment['id'] . "'>";
  //     echo "<input type='submit' value='Submit'>";
  //     echo "</form>";
  //     echo "</div>";
  
  //     echo "</div>";
  // }
  ?>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>

</body>

</html>