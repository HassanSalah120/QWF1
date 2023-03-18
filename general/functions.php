<?php
function textMessage($condation , $mess){

    if($condation){
    echo "<div class='alert alert-info'>
    $mess
    </div>
    ";

    }else{
        echo "<div class='alert alert-danger'>
        $mess
        </div>
        ";
    }
}
function auth(){
    if ($_SESSION['admin']) {
    } else {
        header("Refresh:0; url= http://localhost/QWF/admin/login.php");
    }
}
auth();
?>