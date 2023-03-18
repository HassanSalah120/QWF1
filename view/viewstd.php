<?php
include '../shared/head.php';
include '../shared/nav.php';
include '../general/configDB.php';
include '../general/functions.php';
// to select non admin users
$select = "SELECT role.name Rol, admins.id, admins.name FROM admins JOIN role ON admins.roleId = role.id WHERE admins.roleId != 1";
//to show all include admin users
//$select = "SELECT role.name Rol, admins.id, admins.name FROM admins JOIN role ON admins.roleId = role.id";
$s = mysqli_query($conn, $select);
$std_id = null;
$std_id = $_GET['edit'] ?? null;

$message = '';

if (isset($_POST['assign']) && isset($std_id)) {
    $stmt = $conn->prepare("INSERT INTO admin_std(user_id, std_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $std_id);
    foreach ($_POST['assign'] as $user_id) {
        $stmt->execute();
        $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM admins WHERE id = $user_id"));
        $std_query = "SELECT StdName FROM standarts WHERE StdID = $std_id";
        $std_result = mysqli_query($conn, $std_query);
        $std_row = mysqli_fetch_assoc($std_result);
        $std_name = $std_row['StdName'];
        $message .= "User {$user['name']} assigned to standard $std_name<br>";
    }
}

if (isset($_POST['delete']) && isset($std_id)) {
    $stmt = $conn->prepare("DELETE FROM admin_std WHERE user_id = ? AND std_id = ?");
    $stmt->bind_param("ii", $user_id, $std_id);
    foreach ($_POST['delete'] as $user_id) {
        $check_query = "SELECT * FROM admin_std WHERE user_id = $user_id AND std_id = $std_id";
        $check_result = mysqli_query($conn, $check_query);
        if (mysqli_num_rows($check_result) == 0) {
            $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM admins WHERE id = $user_id"));
            $std_query = "SELECT StdName FROM standarts WHERE StdID = $std_id";
            $std_result = mysqli_query($conn, $std_query);
            $std_row = mysqli_fetch_assoc($std_result);
            $std_name = $std_row['StdName'];
        } else {
            $stmt->execute();
            $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM admins WHERE id = $user_id"));
            $std_query = "SELECT StdName FROM standarts WHERE StdID = $std_id";
            $std_result = mysqli_query($conn, $std_query);
            $std_row = mysqli_fetch_assoc($std_result);
            $std_name = $std_row['StdName'];
            $message .= "User {$user['name']} Unasigned from standard $std_name<br>";
        }
    }
}
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Users</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="http://localhost/QWF/index.php">Home</a></li>
                <li class="breadcrumb-item">users</li>
                <li class="breadcrumb-item active">List Of Users</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <?php if ($message) { ?>
        <div class="alert alert-success" role="alert">
            <?php echo $message; ?>
        </div>
    <?php } ?>
    <form action="<?= $_SERVER['PHP_SELF'] ?>?edit=<?= $std_id ?>" method="POST">
        <div class="container col-6">
            <div class="card">
                <div class="card-body">
                    <table class="table  table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">user</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th> <!-- New column for delete button -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($s as $user) { ?>
                                <tr>
                                    <td><?php echo $user['id']; ?></td>
                                    <td><?php echo $user['name']; ?></td>
                                    <td><?php echo $user['Rol']; ?></td>
                                    <td><?php
                                        $check_query = "SELECT * FROM admin_std WHERE user_id = {$user['id']} AND std_id = $std_id";
                                        $check_result = mysqli_query($conn, $check_query);
                                        if (mysqli_num_rows($check_result) > 0) {
                                            $row = mysqli_fetch_assoc($check_result);
                                            $assign_id = $row['id'];
                                            echo '<button type="submit" class="btn btn-warning" name="delete[]" value="' . $user['id'] . '">Unasign</button>';
                                        } else {
                                            echo '<input type="checkbox" value="' . $user['id'] . '" name="assign[]">';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php if (isset($std_id)) { ?>
    <button type="submit" class="btn btn-primary">Assign User to Standard</button>
<?php } ?>
    </form>
</main>
<?php include '../shared/script.php'; ?>