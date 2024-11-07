<?php
include ("path.php");
include (ROOT_PATH . "/app/controller/topics.php");
$posts = array();
$postsTitle = "Recent Posts";
// dump_value($posts);


if (isset($_GET['t_id'])) {
  $posts = getPostsByTopicId($_GET['t_id']);
  $postsTitle = "You searched for posts under '" . $_GET['name'] . "' ";

} else if (isset($_POST['search-term'])) {

  $postsTitle = "You searched for '" . $_POST['search-term'] . "' ";

  $posts = searchPosts($_POST['search-term']);


} else {
  $posts = getPublishedPosts();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,
    initial-scale=1.0" ,maximum-scale=1.0,user-scalable=no ">
    <title>Fewa Boats</title>
    <link
      href=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/70e6448a33.js" crossorigin="anonymous">
  </script>
</head>

<body>

  <?php include ("app/include/header.php")
  ;
  include ("app/include/messages.php")

  ;


  ?>



  <!-- BLoooog section -->
  <section id="blog">
    <!-- heading -->
    <div class="blog-heading">
      <!-- <span>My Recent Posts</span> -->
      <h3 id="slider-title" class="">Trending Posts</h3>
    </div>
    <!-- blog container -->
    <div class="blog-container">
      <!-- box1 -->
      <?php $key = 0;
      foreach ($posts as $key => $post) {
        # code... ?>


        <div class="blog-box">
          <div class="blog-img">
            <img src="<?php
            echo BASE_URL . "/assets/images/" . $post['image'];
            ?>" alt="" />
          </div>

          <!-- text
-->
          <div class="blog-text">
            <div class="blog-head d-flex justify-content-between">
              <div class="left">
                <i class="fa-regular fa-calendar"></i>
                <span><?php
                echo date('F j, Y', strtotime($post['created_at']));
                ?> </span>
              </div>
              <div class="right">
                <i class="fa-solid fa-user"></i>
                <span class="username"><?php
                echo $post['username'];
                ?></span>
              </div>
            </div>
            <a href="single.php?id=<?php
            echo $post['id'];
            ?>" class="blog-title"><?php
            echo $post['title'];
            ?></a>
            <p>
              <?php

              // html entity to remove the <>><<these thingson view
              echo html_entity_decode(substr($post['body'], 0, 70) . "...");
              ?>
            </p>
            <!-- <a href="single.php">Read More</a> -->
          </div>
        </div>






        <?php
        $key + 1;
        if ($key > 1) {
          break;
        }
      }
      ?>


    </div>
  </section>




  <?php
  // // index.php
  
  // // Assuming you have logic to fetch post titles and other details
  
  // // Loop through your posts
  // foreach ($posts as $post) {
  //   $post_id = $post['id'];
  //   $title = $post['title'];
  
  //   // Fetch post views counter
  //   $views = getPosterViews($post_id);
  
  //   // Display post title and views count
  //   echo "<div class='post-preview'>";
  //   echo "<h2>$title</h2>";
  //   echo "<p>Total Views: $views</p>";
  //   echo "</div>";
  // }
  


  // index.php
  



  ?>



  <!-- content -->

  <div class="content ">
    <div class="main-content">
      <h1 class="recent-post-title"><?php
      echo $postsTitle;
      ?></h1>


      <?php


      foreach ($posts as $key => $post) {
        ?>




        <div class="post">
          <img src="<?php
          echo BASE_URL . "/assets/images/" . $post['image']
            ?>   " alt="" class="post-image" />
          <div class="post-preview">
            <h2>
              <a href="single.php?id=<?php
              echo $post['id']; ?>"><?php
                echo $post['title'];

                ?></a>
            </h2>

            <!-- here im gonnaa put the view count here -->

            <i class="fa fa-user" aria-hidden="true"></i> <span><?php
            echo $post['username'];
            ?></span>
            <i class="fa fa-calendar" aria-hidden="true"></i>
            <span><?php
            echo date('F j, Y', strtotime($post['created_at']));
            ?></span>


            <?php

            $post_id = $post['id'];

            $views = getPostViews($post_id); ?>
            
              <i class="far fa-eye"></i>
              <span class="counte"><?php echo $views . " views"; ?></span>
            

            <p class="preview-text">
              <?php
              echo html_entity_decode(substr($post['body'], 0, 100) . "...");
              ?>
            </p>
            <a href="single.php?id=<?php
            echo $post['id']; ?>" class="btn btn-dark">Read More</a>
          </div>
        </div>




        <?php
      }
      ?>



    </div>
    <div class="sidebar" id="sidebar">




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



  <?php include ("app/include/footer.php")
  ;
  ?>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
</body>

</html>