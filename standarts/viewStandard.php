<?php 
include '../shared/head.php';
include '../shared/nav.php';
include '../general/configDB.php';
include '../general/functions.php';

$user_id = $_SESSION['id'];
if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) {
  $select = "SELECT standarts.StdID, standarts.StdName, NULL AS roleID FROM standarts";
} else {
  $select = "SELECT standarts.StdID, standarts.StdName, admins.roleID
             FROM standarts 
             INNER JOIN admins ON admins.id = $user_id
             INNER JOIN admin_std ON standarts.StdID = admin_std.std_id
             WHERE admin_std.user_id = $user_id";
}
$s = mysqli_query($conn, $select);

?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Standarts</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="http://localhost/QWF/index.php">Home</a></li>
        <li class="breadcrumb-item active">Standards</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="container col-6">
    <div class="card">
      <div class="card-body">
        <?php if (isset($_SESSION['id']) && isset($_SESSION['admin'])) { // Check if user is logged in ?>
        <p> User ID : <?php echo $_SESSION['id'] . ' <br> Name :  ' . $_SESSION['admin']; ?></p>
        <!-- Print user id and name -->
        <?php } else { ?>
        <p>No logged user</p>
        <?php } ?>

        <table class="table table table-bordered" style="direction:rtl;">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col"> Standard</th>
              <th scope="col" colspan="2">Action</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($s as $standardt) { ?>
            <tr>
              <td><?php echo $standardt['StdID']; ?></td>
              <td><?php echo $standardt['StdName']; ?></td>
              <td>
              <a href="http://localhost/QWF/standarts/table.php?StdID=<?php echo $standardt['StdID']; ?>" class="btn btn-dark">View</a>
              </td>
              <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
              <td colspan="2">
                <a href="../view/viewstd.php?edit=<?php echo $standardt['StdID']; ?>" class="btn btn-primary">Assign</a>
              </td>
              <?php } else { ?>
              <td></td> <!-- empty cell if user's role ID is 3 -->
              <?php } ?>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>
<?php include '../shared/script.php';?>