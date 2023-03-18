<?php 
include '../shared/head.php';
include '../shared/nav.php';
include '../general/configDB.php';
include '../general/functions.php';
if($_SESSION['role'] != 1 && $_SESSION['role'] != 2) {
  echo '<script>window.location.href = "'.$_SERVER['PHP_SELF'].'";</script>';
  exit();
}

$select = "SELECT role.name Rol , admins.id  , admins.name, admins.roleId FROM admins JOIN `role` ON admins.roleId = role.id";
$s = mysqli_query($conn, $select);

// Check if the delete button has been clicked
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $roleId = $_GET['role'];
  
  if ($roleId == 1 && $_SESSION['role'] != 1) {
    // Prevent deleting an admin user with role id 1 by non-admin users
    echo "<script>alert('Cannot delete an admin user with role id 1.');</script>";
  } else if ($_SESSION['role'] == 2 && $roleId == 2) {
    // Prevent a user with role id 2 from deleting a user with role id 1
    echo "<script>alert('Cannot delete an admin user with role id 1.');</script>";
  } else {
    // Allow deleting users with role id other than 1 or deleting by an admin user with role id 1
    $delete = "DELETE FROM `admins` WHERE id = $id";
    $d = mysqli_query($conn, $delete);
  
    // Display message and reload page
    echo "<script>alert('User deleted successfully.');</script>";
    echo "<script>window.location = '{$_SERVER['PHP_SELF']}';</script>";
  }
  
}

?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Users</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="http://localhost/QWF/index.php">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">List of users</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<table class="table align-middle mb-0 bg-white my-custom-class">

    <thead class="bg-light">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">User</th>
        <th scope="col">Role</th>
        <th scope="col">Actions</th>
      </tr>
  </thead>
  <tbody>
    <?php foreach ($s as $user) { ?>
      <tr>
        <td>
          <?php echo $user['id']; ?>
        </td>
        <td>
          <?php echo $user['name']; ?>
        </td>
        <td>
          <?php echo $user['Rol']; ?>
        </td>
        <td>
          <?php if ($_SESSION['role'] == 1 || ($_SESSION['role'] == 2 && $user['roleId'] != 1)) { ?>
            <a href="users.php?delete=<?php echo $user['id']; ?>&role=<?php echo $user['roleId']; ?>"
              class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
          <?php } ?>
        </td>

      </tr>
    <?php } ?>
  </tbody>
</table>
</div>
</main>
<?php include '../shared/script.php'; ?>