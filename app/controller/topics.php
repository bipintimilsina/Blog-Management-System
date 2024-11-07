<!-- //in topics.php -->

<?php

include (ROOT_PATH . "/app/database/db.php");
include (ROOT_PATH . "/app/helpers/validateTopic.php");

include (ROOT_PATH . "/app/helpers/middleware.php");

$table = 'topics';


$errors = array();
$id = '';
$name = '';
$description = '';
$topics = selectAll($table);
// dump_value($topics);

if (isset($_POST['add-topics'])) {
  adminOnly();

  $errors = validatetopic($_POST);

  if (count($errors) === 0) {



    unset($_POST['add-topics']);

    // dump_value($_POST);
    // create('topics',['name'=>'poemmm','description'=>'hfkalhdja']);
    $topic_id = create('topics', $_POST);
    $_SESSION['message'] = 'Topic created successfully';
    $_SESSION['type'] = 'success';
    header('location:' . BASE_URL . "/admin/topics/index.php");
    exit();

  } else {
    $name = $_POST['name'];
    $description = $_POST['description'];
  }


}




//editing feature
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $topic = selectOne($table, ['id' => $id])
  ;


  $id = $topic['id'];

  $name = $topic['name'];
  $description = $topic['description'];
  // echo $description;



}



// del_id is the the id of the td which gets send to the controller for deletion

if (isset($_GET['del_id'])) {
  adminOnly();

  echo "hello";
  $id = $_GET['del_id'];
  echo $id;
  $count = deleteRow('topics', $id);
  $_SESSION['message'] = 'Topic deleted successfully';
  $_SESSION['type'] = 'success';
  header('location:' . BASE_URL . "admin/topics/index.php");
  exit();
}





if (isset($_POST['update-topic'])) {
  adminOnly();
  $id = $_POST['id'];
  $errors = validateTopic($_POST);
  if (count($errors) === 0) {

    unset($_POST['update-topic'], $_POST['id']);

    // dump_value($_POST);
    $topic_id = update($table, $id, $_POST);
    $_SESSION['message'] = 'Topic successfully updated';
    $_SESSION['type'] = 'success';
    header('location:' . BASE_URL . "/admin/topics/index.php");
    exit();


  } else {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];


  }


}









// function getPosterViews($post_id) {
//   global $conn;
//   $sql = "SELECT SUM(count) AS total_views FROM post_visits WHERE post_id = ?";
  
//   $stmt = $conn->prepare($sql);
//   if ($stmt) {
//       $stmt->bind_param("i", $post_id);
//       $stmt->execute();
//       $result = $stmt->get_result();
//       if ($result->num_rows > 0) {
//           $row = $result->fetch_assoc();
//           return $row['total_views'];
//       } else {
//           return 0;
//       }
//   } else {
//       return 0;
//   }
// }









function getPostViews($post_id) {
    global $conn;
    $sql = "SELECT SUM(count) AS total_views FROM post_visits WHERE post_id = ?";
    
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['total_views'];
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}




?>