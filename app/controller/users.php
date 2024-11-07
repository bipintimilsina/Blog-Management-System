<?php




include (ROOT_PATH . "/app/database/db.php");
include (ROOT_PATH . "/app/helpers/validate.php");
include (ROOT_PATH . "/app/helpers/middleware.php");

$table = 'users';

$admin_users = selectAll($table);

$id = "";
$username = '';
$admin = '';
$email = '';
$password = '';
$repass = '';





function loginUser($user)
{
  $_SESSION['id'] = $user['id'];
  $_SESSION['username'] = $user['username'];
  $_SESSION['admin'] = $user['admin'];
  $_SESSION['message'] = 'You are now logged in';
  $_SESSION['type'] = 'success';

  if ($_SESSION['admin']) {
    header('location: ' . BASE_URL . '/admin/dashboard.php');

  } else {

    header('location: ' . BASE_URL . '/index.php');

    # code...
  }



  exit();
}




$errors = [];
if (isset($_POST['register-btn']) || isset($_POST['create-admin'])) {

  // var_dump($_POST);
  $errors = validateAUser($_POST);
  // dump_value($errors); 
  if (count($errors) === 0) {

    unset($_POST['register-btn'], $_POST['repass'], $_POST['create-admin']);
    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (($_POST['admin'])) {

      $_POST['admin'] = 1;


      $user_id = create($table, $_POST);
      $_SESSION['message'] = 'Admin user created successfully';
      $_SESSION['type'] = 'success';

      header("location:" . BASE_URL . "/admin/users/index.php");
      exit();
      # code...
    } else {
      $_POST['admin'] = 0;
      $user_id = create($table, $_POST);
      $user = selectOne(
        $table,
        ['id' => $user_id]
      )
      ;      //log user in 
      loginUser($user);
      # code...
    }






    // dump_value($user);
  } else {
    // when there is no err we still maintain the username and other field state
// when there is err then the upper if will work

    $username = $_POST['username'];
    $admin = isset($_POST['admin']) ? 1 : 0;

    $email = $_POST['email'];
    $password = $_POST['password'];
    $repass = $_POST['repass'];


  }


}





//editpage admin
if (isset($_GET['id'])) {
  $user = selectOne($table, ['id' => $_GET['id']]);
  // dump_value($user);
  $id = $user['id'];
  $username = $user['username'];
  $admin = $user['admin'] ;
  $email = $user['email'];

}









//login 


if (isset($_POST['login-btn'])) {


  $condition = [


    'username' => $_POST['username']


  ];
  // var_dump($_POST);
  // $username=$_POST['username'];
// $password=$_POST['password'];
  $errors = validateALogin($_POST);
  // var_dump($errors);
// echo $_POST['username'];
  if (count($errors) === 0) {

    $user = selectOne('users', $condition);
    //trying to find the user

    // $user = selectOne('users', $conditions)
    // ;


    // echo $_POST['username'];



    // $user = selectOne('users', [
    //   'username' => $_POST['username']
    // ]);
    // dump_value($user);
    // var_dump($user);
    // var_dump($user['username']);

    // var_dump($_POST);
    // echo $user['$username'].$user['password'];
    //if user exist the $user would return true 
//paswrod verify checks the encrypted data against the other user inputted data
    if ($user && password_verify($_POST['password'], $user['password'])) {

      //log user in



      loginUser($user);
    } else {


      array_push($errors, 'Wrong credentials');


    }



  }


  $username = $_POST['username'];
  $password = $_POST['password'];
}




if (isset($_POST['update-user'])) {


  adminOnly();
  $errors = validateAUser($_POST);


  if (count($errors) === 0) {
    $id = $_POST['id'];
    unset($_POST['update-user'], $_POST['repass'], $_POST['id']);


    $_POST['password'] = password_hash($_POST['$password'], PASSWORD_DEFAULT);


    $_POST['admin'] = isset($_POST['admin']) ? 1 : 0;
    $count = update($table, $id, $_POST);

    $_SESSION['message'] = "User updated successfully";
    $_session['type'] = "success";
    header("location:" . BASE_URL . "/admin/users/index.php");
    exit();

  } else {
    $username = $_POST['username'];
    $admin = isset($_POST['admin']) ? 1 : 0;
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repass = $_POST['repass'];
  }






}



if (isset($_GET['delete_id'])) {

  adminOnly();

  $count = deleteRow($table, $_GET['delete_id']);
  $_SESSION['message'] = "Admin user deleted";
  $_SESSION['type'] = "success";
  header('location:' . BASE_URL . "/admin/users/index.php");
  exit();

}











?>