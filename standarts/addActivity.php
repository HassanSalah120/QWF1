<?php
include '../shared/head.php';
include '../shared/nav.php';
include '../general/configDB.php';
include '../general/functions.php';

if(isset($_POST['submit'])){
    $actv = $_POST['actv'];
    $manager = $_POST['manager'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $output = $_POST['output'];
    $goalID = $_POST['goalID'];
    $pointerID = $_POST['pointerID'];
    $stdID = $_POST['stdID'];
    $insert = "INSERT INTO `activites` VALUES (NULL , '$actv' , '$manager', '$from' , '$to', '$output' , '$goalID', '$pointerID', '$stdID')";
    $i = mysqli_query($conn , $insert);
    header("Refresh:0; url=http://localhost/QWF/standarts/addActivity.php");

}

// pointers/goals Select
$select = "SELECT * FROM `pointer`";
$a = mysqli_query($conn, $select);

// standarts select
$select = "SELECT * FROM `standarts`";
$add = mysqli_query($conn, $select);
// auth();
?>
<main id="main" class="main">

    <div class="pagetitle">
    <h1>Activites</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="http://localhost/QWF/index.php">Home</a></li>
        <li class="breadcrumb-item">Add</li>
        <li class="breadcrumb-item active">Add Activites</li>
        </ol>
    </nav>
    </div><!-- End Page Title -->

<div class="container col-6">
    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" action="" name="form" method="POST"  style="direction:rtl;">
            <div class="form-group">
                    <label for="">المعيار</label>
                    <select name="stdID" class="form-control">
                        <?php foreach ($add as $stdID) { ?>
                        <option value="<?php echo $stdID['StdID']?>"> <?php echo $stdID['StdName'] ?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">المؤشر</label>
                    <select name="pointerID" class="form-control">
                        <?php foreach ($a as $pointerID) { ?>
                        <option value="<?php echo $pointerID['id']?>"> <?php echo $pointerID['pointer_name'] ?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">الهدف</label>
                    <select name="goalID" class="form-control">
                        <?php foreach ($a as $goalID) { ?>
                        <option value="<?php echo $goalID['id']?>"> <?php echo $goalID['goalName'] ?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">النشاط</label>
                    <input type="text" name="actv" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">مسئول التنفيذ</label>
                    <input type="text" name="manager" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">من</label>
                    <input type="text" name="from" class="form-control">
                </div>
                <div class="form-group">
                    <label for=""> الى</label>
                    <input type="text" name="to" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">المخرجات</label>
                    <input type="text" name="output" class="form-control">
                </div>
                <div class="col-12">
                     <br>
                     <button name="submit" class="btn btn-primary w-100" type="submit">Submit </button>
                </div>
            </form>
        </div>
    </div>
    

</div>
</main>
<?php include '../shared/script.php'; ?>