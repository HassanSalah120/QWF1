<?php
include '../shared/head.php';
include '../shared/nav.php';
include '../general/configDB.php';
include '../general/functions.php';
// Verify user role
if($_SESSION['role'] != 1 && $_SESSION['role'] != 2) {
    echo '<script>window.location.href = "http://localhost/QWF/index.php";</script>';
    exit();
  }
// Select role table
$select = "SELECT * FROM `role`";
$add = mysqli_query($conn, $select);
$message = '';
if(isset($_POST['register'])){
    $name = $_POST['userName'];
    $password = $_POST['password'];
    $role = $_POST['roleId'];

    // Check if user already exists
    $query = "SELECT * FROM `admins` WHERE `name`='$name'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
      $message = "<div class='alert alert-danger'>User $name already exists!</div>";
    } else {
        $insert = "INSERT INTO `admins` VALUES (NULL , '$name' , '$password' ,'$role')";
        $i = mysqli_query($conn , $insert);

        $message = "<div class='alert alert-success'>User $name registered successfully!</div>";
    }
}
?>
<main id="main" class="main">

<div class="pagetitle">
<h1>Users</h1>
<nav>
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="http://localhost/QWF/index.php">Home</a></li>
    <!-- <li class="breadcrumb-item">users</li> -->
    <li class="breadcrumb-item active">Add User</li>
    </ol>
</nav>
</div><!-- End Page Title -->


<div class="container h-100">
<div class="row d-flex justify-content-center align-items-center h-100">
<div class="col-lg-12 col-xl-11">
  <div class="card text-black" style="border-radius: 25px;">
    <div class="card-body p-md-5">
      <div class="row justify-content-center">
        <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
        <?php echo $message; ?>  
        <form method="POST">
            <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Add user</p>

            <div class="d-flex flex-row align-items-center mb-4">
              <i class="fas fa-user fa-lg me-3 fa-fw"></i>
              <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="">Username</label>
                <input type="text" id="form3Example1c" class="form-control" name="userName" />
              </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-4">
              <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
              <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="form3Example4c">Password</label>
                <input type="password" id="form3Example4c" class="form-control" name="password" />
              </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-4">
              <i class="fas fa-key fa-lg me-3 fa-fw"></i>
              <div class="form-outline flex-fill mb-0">
                <div class="form-group">
                <label for="">User Role</label>
<select name="roleId" class="form-control">
  <?php foreach ($add as $role) {
    if ($_SESSION['role'] == 2 && $role['id'] == 1) { // if logged-in user has role2, skip role1 (admin)
      continue;
    }
  ?>
  <option value="<?php echo $role['id']?>"><?php echo $role['name']?></option>
  <?php }?>
</select>
                </div>
              </div>
            </div>

            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
              <button name="register" class="btn btn-primary btn-lg" type="submit">Register</button>
            </div>
          </form>
        </div>
        <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
<img src="http://localhost/QWF/assets/img/logo.png" style="max-width: 100%; margin: 0 auto;">
</div>


      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</main>
<?php include '../shared/script.php'; ?>