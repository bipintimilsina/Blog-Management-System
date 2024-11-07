<?php


function validateTopic($topic)
{
  // global $conn;


  $errors = [];

  if (empty($topic['name'])) {
    array_push($errors, "Name is required");

  }





  $existingTopic = selectOne('topics', ['name' => $topic['name']]);
  if ($existingTopic) {
    if (isset($post['update-topic']) && $existingTopic['id'] != $topic['id']) {

      array_push($errors, "Name already exists");



    }

    if (isset($post['add-topic'])) {
      array_push($errors, "Name already exists");
    }

  }







  // $loginTheUser = selectOne('users', [
  //   'username' => $user['username'],
  //   'password' => $user['password']
  // ]);



  return $errors;
}



?>