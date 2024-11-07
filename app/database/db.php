<?php

session_start();
require ('connect.php')
;



function dump_value($value)
{
  echo "<pre>", print_r($value, true), "</pre>";
  die();
}








function executeQuery($sql, $data)
{


  global $conn;
  $stmt = $conn->prepare($sql);

  // Check if prepare() failed
  if ($stmt === false) {
    echo "Error in preparing statement: " . $conn->error;

  }


  $values = array_values($data);
  $types = str_repeat('s', count($values));
  $stmt->bind_param($types, ...$values);
  $stmt->execute();


  if ($stmt->errno) {
    echo "Error in executing statement: " . $stmt->error;
    return false;
  }

  return $stmt;

}










function selectAll($table, $conditions = [])
{
  global $conn;
  $sql = "Select * From $table";
  if (empty($conditions)) {
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;

  } else {
    $i = 0;
    foreach ($conditions as $key => $value) {
      if ($i === 0) {
        $sql = $sql . " where $key=?";

      } else {
        $sql = $sql . " And $key=?";

      }

      $i++;
    }


    $stmt = executeQuery($sql, $conditions);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;

  }


}





function selectOne($table, $conditions)
{
  global $conn;
  $sql = "Select * From $table";

  $i = 0;
  foreach ($conditions as $key => $value) {
    if ($i === 0) {
      $sql = $sql . " where $key=?";

    } else {
      $sql = $sql . " And $key=?";

    }

    $i++;
  }
  $sql = $sql . " LIMIT 1";



  $stmt = executeQuery($sql, $conditions);
  $records = $stmt->get_result()->fetch_assoc();
  return $records;




}







function create($table, $data)
{
  global $conn;
  $sql = "Insert into $table SET ";

  $i = 0;
  foreach ($data as $key => $value) {

    if ($i === 0) {
      $sql = $sql . " $key=?";

    } else {
      $sql = $sql . ", $key=?";

    }
    $i++;

  }



  $stmt = executeQuery($sql, $data);
  $id = $stmt->insert_id;
  return $id;


}





function update($table, $id, $data)
{
  global $conn;



  $sql = "update $table SET ";

  $i = 0;
  foreach ($data as $key => $value) {

    if ($i === 0) {
      $sql = $sql . " $key=?";

    } else {
      $sql = $sql . ", $key=?";

    }
    $i++;

  }


  $sql = $sql . " Where id=?";
  $data['id'] = $id;

  $stmt = executeQuery($sql, $data);




  return $stmt->affected_rows;


}















function deleteRow($table, $id)
{
  global $conn;
  $sql = "DELETE FROM $table WHERE id=?";

  $stmt = executeQuery($sql, ['id' => $id]);


  if (!$stmt) {
    echo "Error in deleting record: " . $conn->error;
    return false;
  }



  return $stmt->affected_rows;


}
// $id = deleteRow('topics', 2);










$data = [


  'username' => '@bing jqamfsee',
  'admin' => 0,


  'email' => 'jama@gmail.com'

  ,
  'password' => 'jefhkajfa'

];



$conditions = [


  'username' => 'ggg',
  'admin' => 0,
];

// $users = selectOne('users', $conditions)
// ;

// dump_value($users);
// $id = create('users', $data);



// $id = update('users', 3, $data);
// $id = delete('users', 2);





function getPublishedPosts()
{
  global $conn;
  // 
  $sql = "Select p.*, u.username FROM posts AS p JOIN users AS u ON p.user_id=u.id WHERE p.published=? ";


  $stmt = executeQuery($sql, ['published' => 1]);

  $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  return $records;



}


function getPostsByTopicId($topic_id)
{
  global $conn;
  // 
  $sql = "Select p.*, u.username FROM posts AS p JOIN users AS u ON p.user_id=u.id WHERE p.published=? AND topic_id=?";


  $stmt = executeQuery($sql, ['published' => 1, 'topic_id' => $topic_id]);

  $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  return $records;



}








function searchPosts($term)
{
  $match = '%' . $term . '%';
  global $conn;
  $sql = "SELECT 
                p.*, u.username 
            FROM posts AS p 
            JOIN users AS u 
            ON p.user_id=u.id 
            WHERE p.published=?
            AND p.title LIKE ? OR p.body LIKE ?";


  $stmt = executeQuery($sql, ['published' => 1, 'title' => $match, 'body' => $match]);
  $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  return $records;
}




?>