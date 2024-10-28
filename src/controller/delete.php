<?php include("../dbConfig.php") ?>

<?php
$id = $_GET['id'];
$query = "DELETE FROM `users` WHERE `users`.`id` = $id";

$query_run = mysqli_query($conn, $query);

if ($query_run) {
    echo "User deleted successfully.";
    header('Location: ../app/index.php');
} else {
    echo "Something went wrong.";
}
