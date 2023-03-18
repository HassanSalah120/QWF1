<?php
include '../shared/head.php';
include '../shared/nav.php';
include '../general/configDB.php';
include '../general/functions.php';

if (isset($_POST['submit'])) {
    $pointer_name = $_POST['pointer_name'];
    $standard_id = $_POST['standard_id'];
    $goalname = $_POST['goalname'];

    if (!empty($pointer_name) && !empty($standard_id)) {
        $insert = "INSERT INTO `standard_pointer` VALUES (NULL , '$standard_id', '$pointer_name' , '$goalname')";
        $i = mysqli_query($conn, $insert);
        header("Refresh:0; url= http://localhost/QWF/standarts/addPointer.php");
    } else {
        // handle empty selection error
    }
}

// auth();
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Pointers</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="http://localhost/QWF/index.php">Home</a></li>
                <li class="breadcrumb-item">Add</li>
                <li class="breadcrumb-item active">Add Pointer</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="container col-6">
        <div class="card">
            <div class="card-body">
                <form action="" method="POST" enctype="" style="direction:rtl;">
                    <div class="form-group">
                        <label for="">المعيار</label>
                        <select name="standard_id" class="form-control">
                            <option value="">-- اختر معيارًا --</option>
                            <?php
                            // Query the standards from the database
                            $user_id = $_SESSION['id'];

                            $query = "SELECT standarts.StdID, standarts.StdName, admins.roleID
           FROM standarts 
           INNER JOIN admins ON admins.id = $user_id
           INNER JOIN admin_std ON standarts.StdID = admin_std.std_id
           WHERE admin_std.user_id = $user_id";
                            $result = mysqli_query($conn, $query);

                            // Check if query is successful
                            if (!$result) {
                                die("Query failed: " . mysqli_error($conn));
                            }

                            // Loop through the standards and generate the options
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['StdID'] . "'>" . $row['StdName'] . "</option>";
                            }
                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">المؤشر</label>
                        <input type="text" name="pointer_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">الهدف</label>
                        <input type="text" name="goalname" class="form-control">
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