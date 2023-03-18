<?php

include '../shared/head.php';
include '../shared/nav.php';
include '../general/configDB.php';
include '../general/functions.php';

if(isset($_POST['submit'])){
    
    $StdName = $_POST['StdName'];
    $insert = "INSERT INTO `standarts` VALUES (NULL , '$StdName' )";
    $i = mysqli_query($conn , $insert);
    header("Refresh:0; url= http://localhost/QWF/standarts/addStandard.php");
}
// auth();

?>
<main id="main" class="main">

    <div class="pagetitle">
    <h1>Standards</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="http://localhost/QWF/index.php">Home</a></li>
        <li class="breadcrumb-item">Add</li>
        <li class="breadcrumb-item active">Add standard</li>
        </ol>
    </nav>
    </div><!-- End Page Title -->

<div class="container col-6">
    <div class="card">
        <div class="card-body">
            <form action="" method="POST" enctype="" style="direction:rtl;">
                <div class="form-group">
                    <label for="">المعيار</label>
                    <input type="text" name="StdName" class="form-control">
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