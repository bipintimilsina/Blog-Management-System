<nav
  class="navbar navbar-expand-sm navbar-dark bg-dark justify-content-end p-3 text-bg-dark d-flex justify-content-around">
  <a href="<?php
  echo BASE_URL . "/index.php"

    ?>" class="navbar-brand h1 border border-white p-2 btn btn-outline" id="logo-text ">FewaBoat Blogs</a>

  <ul class="navbar-nav">

<?php
if(isset($_SESSION['id']))
{?>


  <div class="dropdown mb-0">
    <a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
      aria-expanded="false">
      <!-- <i class="fa-solid fa-user"></i> -->
  
      <?php
      echo $_SESSION['username'];
  
      ?>
    </a>
  
    <ul class="dropdown-menu navdrop" aria-labelledby="dropdownMenuLink">
      <!-- <li><a class="dropdown-item" href="#">Dashboard</a></li>  -->
      <li>
        <a class="dropdown-item" href="<?php
      echo BASE_URL."/logout.php";        ?>" style="background-color: white">Logout</a>
      </li>
    </ul>
  </div>
  
<?php
}
?>

  </ul>
</nav>