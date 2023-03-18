<?php
include '../shared/head.php';
include '../shared/nav.php';
include '../general/configDB.php';
include '../general/functions.php';
include 'fileslogic.php';


$stdName = $_GET['StdName'];
$pointerID = $_GET['pointerID'];
$outputFromLink = $_GET['output'];

$pointers = mysqli_query($conn, "SELECT pointerName FROM standard_pointer");

// fetch the standards from the standards table
$sql_standards = "SELECT StdID, StdName FROM `standarts`";
$result_standards = mysqli_query($conn, $sql_standards);
$standards = mysqli_fetch_all($result_standards, MYSQLI_ASSOC);

// fetch the activities from the activities table
$sql_activities = "SELECT * FROM `activites`";
$result_activities = mysqli_query($conn, $sql_activities);
$activities = mysqli_fetch_all($result_activities, MYSQLI_ASSOC);


?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Files</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="http://localhost/QWF/index.php">Home</a></li>
                <li class="breadcrumb-item">Upload</li>
                <li class="breadcrumb-item active">Upload Files</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <form action="upload.php" method="post" enctype="multipart/form-data" class="form-control" style="direction:rtl;">
                        <div class="form-group">
                            <label for="">Upload File</label>
                            <input type="file" name="myfile" class="form-control">
                        </div>
                        <div class="form-group">
    <label for="">المعيار</label>
    <select name="stdID" class="form-control" readonly>
        <?php foreach ($add as $stdID) { ?>
            <option value="<?php echo $stdID['StdID'] ?>" <?php echo ($stdID['StdName'] == $stdName) ? 'selected' : '' ?>>
                <?php echo $stdID['StdName'] ?></option>
        <?php } ?>
    </select>
</div>
                        <div class="form-group">
    <label for="">المؤشر</label>
    <select name="pointerID" class="form-control" disabled>
        <?php
        $pointers = mysqli_query($conn, "SELECT * FROM standard_pointer");
        while ($row = mysqli_fetch_array($pointers)) {
            $pointerID = $row['pointerID'];
            $pointerName = $row['pointerName'];
        ?>
            <option value="<?php echo $pointerID; ?>" <?php echo ($pointerID == $_GET['pointerID']) ? 'selected' : ''; ?>>
                <?php echo $pointerName; ?>
            </option>
        <?php } ?>
    </select>
    <input type="hidden" name="pointerID" value="<?php echo $_GET['pointerID']; ?>">
</div>

                        <div class="form-group">
    <label for="">المخرجات</label>
    <input type="hidden" name="output" value="<?php echo $outputFromLink; ?>">
    <select name="output_select" class="form-control" disabled>
        <?php
        $activites = mysqli_query($conn, "SELECT * FROM activites WHERE output = '$outputFromLink'");
        while ($row = mysqli_fetch_array($activites)) {
            $output = $row['output'];
        ?>
            <option value="<?php echo $pointerID; ?>" <?php echo ($output == $outputFromLink) ? 'selected' : ''; ?>>
                <?php echo $output; ?>
            </option>
        <?php } ?>
    </select>
</div>



                        <div class="form-group">
                            <label for="">ID</label>
                            <?php
                            $id = isset($_GET['id']) ? $_GET['id'] : '';
                            ?>
                            <select name="id" class="form-control" disabled>
                                <?php
                                $sql_activities = "SELECT * FROM activites";
                                $result_activities = mysqli_query($conn, $sql_activities);
                                while ($activity = mysqli_fetch_assoc($result_activities)) {
                                    $selected = '';
                                    if ($id == $activity['id']) {
                                        $selected = 'selected';
                                    }
                                ?>
                                    <option value="<?php echo $activity['id'] ?>" <?php echo $selected ?>>
                                        <?php echo $activity['id'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                        </div>
                        <div class="col-12">
                            <br>
                            <button name="save" class="btn btn-primary w-100" type="submit"> Upload </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include '../shared/script.php'; ?>