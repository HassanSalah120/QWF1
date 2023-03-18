<?php
include '../shared/head.php';
include '../shared/nav.php';
include '../general/configDB.php';
include '../general/functions.php';
include 'fileslogic.php';

$st = $_GET['StdID'];
$dd = $_GET['id'];
// fetch the name of the standard from the standards table
$sql = "SELECT stdName FROM `standarts` WHERE StdID = '$st' ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$stdName = $row['stdName'];

// fetch the files that have a matching StdID value
$sql_files = "SELECT * FROM `files` WHERE StdID = '$st' AND outputID='$dd' ";
$result_files = mysqli_query($conn, $sql_files);
$files = mysqli_fetch_all($result_files, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = "DELETE FROM `files` WHERE id = $id";
    $d = mysqli_query($conn, $delete);
    if ($d) {
        echo "<script>window.location = '{$_SERVER['PHP_SELF']}?StdID={$st}';</script>";
    } else {
        echo "Error deleting file";
    }
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Files</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="http://localhost/QWF/index.php">Home</a></li>
                <li class="breadcrumb-item">Download</li>
                <li class="breadcrumb-item active">Download Files</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="container">
        <div class="row">
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <th>Standard</th>
                        <th>Filename</th>
                        <th>Download</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php foreach ($files as $file) : ?>
                            <tr>
                                <td><?php echo $stdName ?></td>
                                <td><?php echo $file['name']; ?></td>
                                <td><a class="btn btn-danger" target="_blank" href="uploads/<?php echo $file['name']; ?>">View</a></td>
                                <td><button class="btn btn-warning" onclick="deleteFile(<?php echo $file['ID']; ?>)">Delete</button></td>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</main>
<!--  -->
<?php include '../shared/script.php'; ?>
<script>
function deleteFile(id) {
    $.ajax({
        url: '<?php echo $_SERVER['PHP_SELF']; ?>?StdID=<?php echo $st; ?>&delete=' + id,
        method: 'GET',
        success: function(data) {
            // Reload the page after successful deletion
            location.reload();
        },
        error: function() {
            alert('Error deleting file');
        }
    });
}
</script>
