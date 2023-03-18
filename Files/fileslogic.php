<?php
// include '../general/configDB.php';
$sql = "SELECT * FROM files";
$result = mysqli_query($conn, $sql);
$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

// standarts select
$select = "SELECT * FROM `standarts`";
$add = mysqli_query($conn, $select);
 // pointers/goals Select
$select = "SELECT * FROM `pointer`";
$ad = mysqli_query($conn, $select);
// activites select
$select = "SELECT * FROM `activites`";
$a = mysqli_query($conn, $select);

// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = mysqli_real_escape_string($conn, $_FILES['myfile']['name']);
    // destination of the file on the server
    $destination = 'uploads/' . $filename;
    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];
    $stdID = mysqli_real_escape_string($conn, $_POST['stdID']);
    $pointerID = mysqli_real_escape_string($conn, $_POST['pointerID']);
    $out = mysqli_real_escape_string($conn, $_POST['id']);
    if (!in_array($extension, ['zip', 'pdf', 'docx','png','jpg' , 'txt'])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO files (name, size, downloads, stdID, pointerID ,outputID) VALUES ('$filename', $size, 0, $stdID, $pointerID, $out)";
            if (mysqli_query($conn, $sql)) {
                echo '<script>window.location.href = "http://localhost/QWF/standarts/table.php?StdID=' . $stdID . '";</script>';
                exit();
            }
        } else {
            echo "Failed to upload file.";
        }
    }        
}

    
// Downloads files
if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];
    // fetch file to download from database
    $sql = "SELECT * FROM files WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/' . $file['name'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $file['name']));
        ob_clean();
        flush();
        readfile($filepath, "rb");
    }
}


function getFiles($stdID){
    global $conn;
    $sql = "SELECT * FROM files WHERE stdID = '$stdID'";
    $result = mysqli_query($conn, $sql);
    $files = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $files;
}

?>