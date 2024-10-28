<?php include("../dbConfig.php") ?>

<?php
$id = $_GET['id'];
echo $id;
if (isset($_POST["edit_btn"])) {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];

    $query="UPDATE `users` SET `firstname` = '$fname', `lastname` = '$lname', `email` = '$email' WHERE `users`.`id` = $id"; 

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        echo "User updated successfully.";
        header('Location: ../app/index.php');
    } else {
        echo "Something went wrong.";
    }
}
