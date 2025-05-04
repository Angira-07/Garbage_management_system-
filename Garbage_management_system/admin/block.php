 v      <?php
include '../main/db_connect.php';

$error = "";
$id = $_GET['id'];
// $table = $_GET['table'];
$sql = "UPDATE driver SET isBlocked = 1 Where id = '$id'";

// if($table === 'dustbin'){
//     $sql = "UPDATE dustbin SET status = 'approved' Where id = '$id'";
// } else if($table === 'driver'){
//     $sql = "UPDATE driver SET isVerified = 0, isBlocked = 1 Where id = '$id'";
// }
// else{
//     $error = "Invalid table name!";
// }

if($conn->query($sql)){
    header("Location: ../admin/dashboard.php#verified");
    exit();
}

?>