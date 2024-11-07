<?php
include ("../path.php");


include (ROOT_PATH . "/app/controller/posts.php");
adminOnly();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,
    initial-scale=1.0" ,maximum-scale=1.0,user-scalable=no ">
    <title>Manage Comments</title>
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

  <link rel="stylesheet" href="../css/admin.css" />



  


<style>
     .table1 {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .reply-link {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .reply-link:hover {
            background-color: #0056b3;
        }
  </style>
  <link rel="stylesheet" href="../css/reset.css" />
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

      <div class="content">
        <h2 class="page-title">Manage Comments</h2>


        <?php
        include (ROOT_PATH . "/app/include/messages.php");
        ?>











<?php

// $conn;
// // Fetch comments with user details from database
// $sql = "SELECT comments.*, users.username AS user_name, users.email AS user_email 
//         FROM comments 
//         INNER JOIN users ON comments.user_id = users.id";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     // Output data of each row
//     while($row = $result->fetch_assoc()) {
//         echo "<tr>";
//         echo "<td>" . $row["user_name"] . "</td>";
//         echo "<td>" . $row["user_email"] . "</td>";
//         echo "<td>" . $row["comment"] . "</td>";
//         echo "<td><a href='reply_comment.php?email=" . $row["user_email"] . "'>Reply</a></td>";
//         echo "</tr>";
//     }
// } else {
//     echo "0 results";
// }





















$sql = "SELECT comments.*, users.username AS user_name, users.email AS user_email, posts.title
        FROM comments 
        INNER JOIN users ON comments.user_id = users.id
        INNER JOIN posts ON comments.post_id = posts.id";
$result = $conn->query($sql);
?>

<table class="table1">
    <tr>
        <th>Post</th>
        <th>Name</th>
        <th>Email</th>
        <th>Comment</th>
        <th>Action</th>
    </tr>

<?php
if ($result) {
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["title"] . "</td>";
            echo "<td>" . $row["user_name"] . "</td>";
            echo "<td>" . $row["user_email"] . "</td>";
            echo "<td>" . $row["comment"] . "</td>";
            echo "<td><a class='reply-link' href='mailto:" . $row["user_email"] . "?subject=Reply%20to%20Your%20Comment'>Reply</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>0 results</td></tr>";
    }
} else {
    echo "<tr><td colspan='5'>Error: " . $conn->error . "</td></tr>";
}
?>

</table>




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
  <script src="../assets/js/script.js"></script>
</body>

</html>