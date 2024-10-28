<?php include("../dbConfig.php") ?>

<?php
if (isset($_POST["add_btn"])) {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];

    $query = "INSERT INTO users (firstname,lastname,email) VALUES('$fname','$lname','$email')";

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        echo "User added successfully.";
        header('Location: ../app/index.php');
    } else {
        echo "alert(Something went wrong.)";
    }
}
