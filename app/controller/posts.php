<!-- //in topics.php -->

<?php



include (ROOT_PATH . "/app/database/db.php");
include (ROOT_PATH . "/app/helpers/validatePost.php");
include (ROOT_PATH . "/app/helpers/middleware.php");
// $table = 'topics';



$table = "posts";
$errors = [];

$topics = selectAll('topics');
$posts = selectAll($table);

$id = "";
$title = "";
$body = "";
$topic_id = "";
$published = "";


if (isset($_GET['id'])) {


  $post = selectOne($table, ['id' => $_GET['id']]);
  $id = $post['id'];
  // dump_value($post);
  $title = $post['title'];

  $body = $post['body'];
  $topic_id = $post['topic_id'];
  $published = $post['published'];





}



//for deletion
if (isset($_GET['del_id'])) {
  adminOnly();
  $count = deleteRow($table, $_GET['del_id']);

  $_SESSION['message'] = 'Post deleted successfully';
  $_SESSION['type'] = 'success';
  header("location:" . BASE_URL . "/admin/posts/index.php");
  exit();
}


//for publishing and unpublishing
if (isset($_GET['published']) && isset($_GET['p_id'])) {
  adminOnly();
  $published = $_GET['published'];
  $p_id = $_GET['p_id'];
  //  update published 


  $count = update($table, $p_id, ['published' => $published]);



  $_SESSION['message'] = "Post published state changed";
  $_SESSION['type'] = "success";
  header("location:" . BASE_URL . "/admin/posts/index.php");




}




if (isset($_POST['add-post'])) {
  // dump_value($_FILES['image']);
  adminOnly();

  $errors = validatePost($_POST);

  // Check if the image file is provided and if the $_FILES array is set
  if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
    // Sanitize the original file name
    $original_filename = basename($_FILES['image']['name']);

    // Make the image name unique using the current timestamp
    $image_name = time() . "_" . $original_filename;

    // Define the destination path for the uploaded image
    $destination = ROOT_PATH . "/assets/images/" . $image_name;

    // Attempt to move the uploaded file to the destination directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
      // If successful, set the image name in the $_POST array
      $_POST['image'] = $image_name;
    } else {
      // If the file upload failed, add an error message
      array_push($errors, "Failed to upload image. Please check the directory permissions.");
    }
  } else {
    // If no image file is provided, add an error message
    array_push($errors, "Post image required");
  }



  if (count($errors) === 0) {

    unset($_POST['add-post']);

    $_POST['user_id'] = $_SESSION['id'];

    //if the form published field is checked or set then we are sayiing the published would become 1 else 0
    //its a if else shorthand
    $_POST['published'] = isset($_POST['published']) ? 1 : 0;
    $_POST['body'] = htmlentities($_POST['body']);
    ;

    $post_id = create('posts', $_POST);

    $_SESSION['message'] = 'Post created successfully';
    $_SESSION['type'] = "success";


    header("location:" . BASE_URL . "/admin/posts/index.php");
  } else {

    $title = $_POST['title'];
    $body = $_POST['body'];



    $topic_id = $_POST['topic_id'];
    $published = isset($_POST['published']) ? 1 : 0;

  }



  // dump_value($post_id);
}






if (isset($_POST['update-post'])) {

  adminOnly();
  $errors = validatePost($_POST);
  // Check if the image file is provided and if the $_FILES array is set
  if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
    // Sanitize the original file name
    $original_filename = basename($_FILES['image']['name']);


    // Make the image name unique using the current timestamp
    $image_name = time() . "_" . $original_filename;

    // Define the destination path for the uploaded image
    $destination = ROOT_PATH . "/assets/images/" . $image_name;

    // Attempt to move the uploaded file to the destination directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
      // If successful, set the image name in the $_POST array
      $_POST['image'] = $image_name;
    } else {
      // If the file upload failed, add an error message
      array_push($errors, "Failed to upload image. Please check the directory permissions.");
    }
  } else {
    // If no image file is provided, add an error message
    array_push($errors, "Post image required");
  }



  if (count($errors) === 0) {
    $id = $_POST['id'];
    unset($_POST['update-post'], $_POST['id']);

    $_POST['user_id'] = $_SESSION['id'];


    //if the form published field is checked or set then we are sayiing the published would become 1 else 0
    //its a if else shorthand
    $_POST['published'] = isset($_POST['published']) ? 1 : 0;
    $_POST['body'] = htmlentities($_POST['body']);
    ;

    $post_id = update($table, $id, $_POST);

    $_SESSION['message'] = 'Post updated successfully';
    $_SESSION['type'] = "success";


    header("location:" . BASE_URL . "/admin/posts/index.php");
  } else {

    $title = $_POST['title'];
    $body = $_POST['body'];
    $topic_id = $_POST['topic_id'];
    $published = isset($_POST['published']) ? 1 : 0;

  }



}






// Function to record post visit and retrieve view count
function recordPostVisitAndViewCount($conn, $post_id)
{
  // Get visitor's IP address
  $ip_address = $_SERVER['REMOTE_ADDR'];

  // Check if the IP address has already been recorded for this post
  $stmt = $conn->prepare("SELECT * FROM post_visits WHERE post_id = ? AND ip_address = ?");
  $stmt->bind_param("is", $post_id, $ip_address);
  $stmt->execute();
  $result = $stmt->get_result();

  // If the user's IP address has not been recorded for this post, increase the post view count
  if ($result->num_rows === 0) {
    // Insert a new record to record the user's visit
    $stmt = $conn->prepare("INSERT INTO post_visits (post_id, ip_address, count) VALUES (?, ?, 1)");
    $stmt->bind_param("is", $post_id, $ip_address);
    $stmt->execute();
  }

  // Retrieve the total post view count
  $stmt = $conn->prepare("SELECT SUM(count) AS total_visits FROM post_visits WHERE post_id = ?");
  $stmt->bind_param("i", $post_id);
  $stmt->execute();
  $result = $stmt->get_result();

  // Check if there are any results
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    return $row["total_visits"];
  } else {
    return 0;
  }
}

// Example usage:
// $total_visits = recordPostVisitAndViewCount($conn, $_GET['id']);
















function getPostDetails($conn, $post_id)
{

  $sql = "SELECT posts.title, posts.created_at, users.username
          FROM posts
          JOIN users ON posts.user_id = users.id
          WHERE posts.id = ?";

  $stmt = $conn->prepare($sql);
  if ($stmt) {
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    } else {
      return null;
    }
  } else {
    return null;
  }
}














// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//   global $conn;
//   $name = $_POST['name'];
//   $comment = $_POST['comment'];
//   $post_id = $_GET['id'];
//    // Assuming the post ID is 1 for this example

//   $sql = "INSERT INTO comments (post_id, name, comment) VALUES (?, ?, ?)";
//   $stmt = $conn->prepare($sql);
//   $stmt->bind_param("iss", $post_id, $name, $comment);

//   if ($stmt->execute()) {
//       echo "New comment added successfully";
//   } else {
//       echo "Error: " . $sql . "<br>" . $conn->error;
//   }

//   $stmt->close();
// }




// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//   // Assuming you have a user ID stored in the session after authentication
//   $user_id = $_SESSION['id'];

//   // If user ID is not available in session, you may prompt the user to enter their name and retrieve the corresponding user ID from the database
//   // $user_name = $_POST['name'];
//   // $user_id = getUserIdFromName($user_name); // Implement this function to get user ID from name

//   $comment = $_POST['comment'];
//   $post_id = intval($_GET['id']); // Ensure post ID is an integer

//   // Insert the comment along with the user ID
//   $sql = "INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)";
//   $stmt = $conn->prepare($sql);
//   $stmt->bind_param("iis", $post_id, $user_id, $comment);

//   if ($stmt->execute()) {
//       echo "New comment added successfully";
//   } else {
//       echo "Error: " . $sql . "<br>" . $conn->error;
//   }

//   $stmt->close();
// }




















global $conn;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['com-submit'])) {
  usersOnly();

  // Check if the user ID is set in the session
  if (!isset($_SESSION['id'])) {
    die("Error: User is not logged in.");
  }
  $user_id = $_SESSION['id'];

  // Check if the comment is set in the POST data
  if (!isset($_POST['comment'])) {
    die("Error: Comment is not set.");
  }
  $comment = $_POST['comment'];

  // Check if the post ID is set in the GET data and is a valid integer
  if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Error: Post ID is not set or is invalid.");
  }
  $post_id = intval($_GET['id']);

  // Insert the comment along with the user ID
  $sql = "INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)";
  if ($stmt = $conn->prepare($sql)) {
    if ($stmt->bind_param("iis", $post_id, $user_id, $comment)) {
      if ($stmt->execute()) {
        // Set session variable to indicate that the form was submitted
        $_SESSION['comment_submitted'] = true;

        // Redirect back to the same page
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit(); // Ensure that no further code is executed after the redirection
      } else {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
      }
    } else {
      die("Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error);
    }
  } else {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
  }

  $stmt->close();
}

// Check if comment was submitted and display a confirmation message
if (isset($_SESSION['comment_submitted']) && $_SESSION['comment_submitted']) {
  echo "New comment added successfully";
  unset($_SESSION['comment_submitted']); // Unset the session variable to prevent duplicate submissions
}













if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($POST['com-submit'])) {

  usersOnly();
  // Assuming you have a user ID stored in the session after authentication
  $user_id = $_SESSION['id'];

  $comment = $_POST['comment'];
  $post_id = intval($_GET['id']); // Ensure post ID is an integer

  // Insert the comment along with the user ID
  $sql = "INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("iis", $post_id, $user_id, $comment);

  if ($stmt->execute()) {
    // Set session variable to indicate that the form was submitted
    $_SESSION['comment_submitted'] = true;

    // Redirect back to the same page
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit(); // Ensure that no further code is executed after the redirection
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $stmt->close();
}

// Check if comment was submitted and display a confirmation message
if (isset($_SESSION['comment_submitted']) && $_SESSION['comment_submitted']) {
  echo "New comment added successfully";
  unset($_SESSION['comment_submitted']); // Unset the session variable to prevent duplicate submissions
}





// global $conn;
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//   // Check if the user ID is set in the session
//   if (!isset($_SESSION['id'])) {
//     die("Error: User is not logged in.");
//   }
//   $user_id = $_SESSION['id'];

//   // Check if the reply and comment ID are set in the POST data
//   if (!isset($_POST['reply']) || !isset($_POST['comment_id'])) {
//     die("Error: Reply or comment ID is not set.");
//   }

//   $reply = $_POST['reply'];
//   $comment_id = intval($_POST['comment_id']);
//   $comment_id = 1;
// // 
//   // Insert the reply into the comment_replies table
//   $sql = "INSERT INTO comment_replies (comment_id, user_id, reply) VALUES (?, ?, ?)";
//   if ($stmt = $conn->prepare($sql)) {
//     if ($stmt->bind_param("iis", $comment_id, $user_id, $reply)) {
//       if ($stmt->execute()) {
//         // Redirect back to the post page
//         header("Location:" . BASE_URL . "/single.php?id=" . intval($_GET['id']));
//         exit(); // Ensure that no further code is executed after the redirection
//       } else {
//         die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
//       }
//     } else {
//       die("Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error);
//     }
//   } else {
//     die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
//   }

//   $stmt->close();
// } else {
//   die("Error: Invalid request method.");
// }
// function getReplies($comment_id)
// {
//   global $conn;
//   $sql = "SELECT comment_replies.*, users.username AS user_name 
//           FROM comment_replies 
//           INNER JOIN users ON comment_replies.user_id = users.id 
//           WHERE comment_id = ?";
//   if ($stmt = $conn->prepare($sql)) {
//     if ($stmt->bind_param("i", $comment_id)) {
//       if ($stmt->execute()) {
//         $result = $stmt->get_result();
//         $replies = [];
//         while ($row = $result->fetch_assoc()) {
//           $replies[] = $row;
//         }
//         return $replies;
//       } else {
//         die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
//       }
//     } else {
//       die("Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error);
//     }
//   } else {
//     die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
//   }
// }












function hasUserLikedPost($post_id, $user_id)
{
  global $conn;
  $check_sql = "SELECT * FROM likes WHERE post_id = ? AND user_id = ?";
  if ($stmt = $conn->prepare($check_sql)) {
    if ($stmt->bind_param("ii", $post_id, $user_id)) {
      if ($stmt->execute()) {
        $result = $stmt->get_result();
        return $result->num_rows > 0;
      } else {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
      }
    } else {
      die("Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error);
    }
  } else {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
  }
}

function addLike($post_id, $user_id)
{
  global $conn;
  $insert_sql = "INSERT INTO likes (post_id, user_id) VALUES (?, ?)";
  if ($stmt = $conn->prepare($insert_sql)) {
    if ($stmt->bind_param("ii", $post_id, $user_id)) {
      if (!$stmt->execute()) {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
      }
    } else {
      die("Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error);
    }
  } else {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
  }
}

function getLikeCount($post_id)
{
  global $conn;
  $count_sql = "SELECT COUNT(*) AS like_count FROM likes WHERE post_id = ?";
  if ($stmt = $conn->prepare($count_sql)) {
    if ($stmt->bind_param("i", $post_id)) {
      if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result) {
          $row = $result->fetch_assoc();
          return $row['like_count'];
        } else {
          die("Getting result set failed: (" . $stmt->errno . ") " . $stmt->error);
        }
      } else {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
      }
    } else {
      die("Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error);
    }
  } else {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
  }
}

// Processing the like action if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $post_id = $_GET['id'];
  $user_id = $_SESSION['id']; // Assuming user_id is stored in session after login

  if (!hasUserLikedPost($post_id, $user_id)) {
    addLike($post_id, $user_id);
  }

  // Redirect back to the main page after processing the like
  header('Location:' . BASE_URL . "/single.php?id=" . $post_id);
  exit();
}




//for admin panel dashboard

function getCommentsThisWeek($conn) {
  $sql = "SELECT COUNT(*) AS comment_count 
          FROM comments 
          WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1)";
  $result = $conn->query($sql);

  if (!$result) {
      die("Error executing query: " . $conn->error);
  }

  $row = $result->fetch_assoc();
  return $row['comment_count'];
}
function getLikesThisWeek($conn) {
  $sql = "SELECT COUNT(*) AS like_count 
          FROM likes 
          WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1)";
  $result = $conn->query($sql);

  if (!$result) {
      die("Error executing query: " . $conn->error);
  }

  $row = $result->fetch_assoc();
  return $row['like_count'];
}
function getVisitsThisWeek($conn) {
  $sql = "SELECT COUNT(*) AS visit_count 
          FROM post_visits 
          WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1)";
  $result = $conn->query($sql);

  if (!$result) {
      die("Error executing query: " . $conn->error);
  }

  $row = $result->fetch_assoc();
  return $row['visit_count'];
}
function getVisitssThisWeek($conn) {
  $sql = "SELECT COUNT(*) AS visit_count 
          FROM blog_post_visits 
          WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1)";
  $result = $conn->query($sql);

  if (!$result) {
      die("Error executing query: " . $conn->error);
  }

  $row = $result->fetch_assoc();
  return $row['visit_count'];
}
