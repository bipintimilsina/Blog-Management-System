<?php
include ("../../path.php");
include (ROOT_PATH . "/app/controller/posts.php");
adminOnly();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,
    initial-scale=1.0" ,maximum-scale=1.0,user-scalable=no ">
    <title>Edit Posts</title>
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

  <link rel="stylesheet" href="../../css/admin.css" />
  <link rel="stylesheet" href="../../css/reset.css" />
  <link rel="stylesheet" href="assets/images/fav-icon.svg" />

  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100" rel="stylesheet">
  <script src="https://kit.fontawesome.com/70e6448a33.js" crossorigin="anonymous">
  </script>
</head>

<body>
  <?php
  include (ROOT_PATH . "/app/include/admin-nav.php");
  ?>
  <div class="admin-wrapper">

    <?php
    include (ROOT_PATH . "/app/include/adminSidebar.php");



    ?>



    <div class="admin-content">
      <div class="btn-group">
        <a href="create.php" class="btn btn-big">Add Posts</a>
        <a href="index.php" class="btn btn-big">Manage Posts</a>
      </div>
      <div class="content">
        <h2 class="page-title">Edit Posts</h2>
        <?php
        include (ROOT_PATH . "/app/helpers/formErrors.php");
        ?>
        <!-- main content of create posting -->

        <form action="edit.php" method="post" enctype="multipart/form-data">


          <input type="hidden" name="id" value="<?php
          echo $id
            ?>">
          <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="" value="<?php
            echo $title
              ?>" class="text-input
              input-search" />
          </div>

          <div>








            <label for=" Body">Body</label>

            <textarea name="body" id="editor" cols="30" rows="10"><?php
            echo $body; ?></textarea>



          </div>
          <div>
            <label for="image">Title</label>
            <input type="file" name="image" id="" class="text-input" />
          </div>
          <div>
            <label for="Topic">Topic</label>

            <select name="topic_id" id="" class="text-input">
              <option value=""></option>
              <?php
              foreach ($topics as $key => $topic) {
                if (!empty($topic_id) && $topic_id == $topic['id']) { ?>
                  <option selected value="<?php
                  echo $topic['id'];
                  ?>">
                    <?php
                    echo $topic['name'];
                    ?>
                  </option>
                  <?php
                  # code...
                } else { ?>
                  <option value="<?php
                  echo $topic['id'];
                  ?>">
                    <?php
                    echo $topic['name'];
                    ?>
                  </option>
                  # code...
                <?php }

                ?>

                <?php
                # code...
              } ?>
            </select>
          </div>

          <div>

            <?php
            if (empty($published) && $published == 0) { ?>

              <label>
                <input type="checkbox" name="published">Publish
              </label>

              <?php

            } else { ?>

              <label>
                <input checked type="checkbox" name="published">Publish
              </label>


              <?php
            }

            ?>
          </div>


          <div>
            <!-- <a type="submit" class="btn btn-big"></a> -->
            <input type="submit" style=" width: 150px; margin: 10px 0px;display:flex" href="create.php"
              class="btn btn-big" value="Update Posts" name="update-post">




          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>

  <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
  <script src="../../assets/js/script.js"></script>
</body>

</html>