<?php


function validateAUser($user)
{
  // global $conn;


  $errors = [];

  if (empty($user['username'])) {
    array_push($errors, "username is required");

  }
  if (empty($user['password'])) {
    array_push($errors, "password is required");

  }

  if ($user['password'] !== $user['repass']) {


    array_push($errors, "password do not match");


  }


  $existingUser = selectOne('users', ['email' => $user['email']]);
  // if ($existingUser) {
  //   array_push($errors, 'Email already exists');
  // }
  if ($existingUser) {
    if (isset($user['update-user']) && $existingUser['id'] != $user['id']) {

      array_push($errors, "Email already exists");
    }


    if (isset($user['create-admin'])) {
      array_push($errors, "Email already exists")
      ;
    }

  }









  // $loginTheUser = selectOne('users', [
  //   'username' => $user['username'],
  //   'password' => $user['password']
  // ]);



  return $errors;
}












//for login

function validateALogin($user)
{
  // global $conn;


  $errors = [];

  if (empty($user['username'])) {
    array_push($errors, "username is required");

  }
  if (empty($user['password'])) {
    array_push($errors, "password is required");

  }

  return $errors;
}




?>