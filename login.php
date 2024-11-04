<?php include("./control/database_users.php") ?>
<?php
$lemailError = $lpasswordError = "";
$lemail = $lpassword = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (empty($_POST["lemail"])) {
        $lemailError = "required";
    } else {
        $lemail = test_input($_POST['lemail']);
        if (!preg_match("/^[a-zA-Z0-9]+@(?:[a-zA-Z0-9]+\.)+[A-Za-z]+$/", $lemail)) {
            $lemailError = "Incorrcet Email";
        }
    }
    if (empty($_POST["lpassword"])) {
        $lpasswordError = "required";
    } else {
        $lpassword = test_input($_POST['lpassword']);
        if (strlen($lpassword) < 6) {
            $lpasswordError = "must be 6 letter long";
        }
        if (!preg_match("/[a-z]/", $lpassword)) {
            $lpasswordError = "At least 1 letter";
        }
        if (!preg_match("/[0-9]/", $lpassword)) {
            $lpasswordError = "At least 1 number";
        }
        if (!preg_match("/[!#$%&?@ ']/", $lpassword)) {
            $lpasswordError = "At least 1 Special Character";
        }
    }
    if (
        $lemailError === "" && $lpasswordError === "" && $lemail !== "" && $lpassword !== ""

    ) {
        session_start();

        $login_user = new LoginUser($lemail, $lpassword);
        $error = $login_user->error;

        if ($error) {

            echo $error;
        } else {
            $_SESSION['user'] = $login_user->user;
        }
    }
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/tailwindcss">
        .nav-main{
            @apply border shadow-lg
        }
        .nav-div{
            @apply max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4
        }
        .logo-a{
            @apply flex items-center space-x-3 rtl:space-x-reverse
        }
        .logo-name{
            @apply self-center text-2xl font-semibold whitespace-nowrap dark:text-white
        }
        .link-div{
            @apply hidden w-full md:block md:w-auto
        }
        .link-ul{
            @apply font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700
        }
        .hero-div{
            @apply flex gap-4 w-full h-full justify-between items-center
        }
        .banner-div{
            @apply m-4 p-4 flex justify-center w-1/2 h-full gap-4
        }
        .text-div{
            @apply flex flex-col justify-center items-center
        }
        .text-div-head{
            @apply self-center text-3xl font-semibold
        }
        .form-div{
            @apply border rounded-lg m-4 p-4 shadow-lg
        }
        .form-heading{
            @apply text-center text-2xl m-2
        }
        .input-div{
            @apply flex justify-between items-center gap-4
        }
        input{
            @apply border p-2 rounded-lg
        }
        .error {
            @apply text-right text-red-500
        }
        .login-btn {
            @apply text-white bg-blue-500 p-2 rounded-lg
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>

    <nav class="nav-main">
        <div class="nav-div">
            <a href="https://flowbite.com/" class="logo-a">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                <span class="logo-name">CRUD App</span>
            </a>
            <div class="link-div" id="navbar-default">
                <ul class="link-ul">
                    <li>
                        <a href="signup.php">Signup</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="hero-div">
        <div class="banner-div">
            <a href="https://flowbite.com/" class="h-40">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-full " alt="Flowbite Logo" />
            </a>
            <div class="text-div">
                <h1 class="text-div-head">CRUD App</h1>
                <p class="self-center">Connecting People</p>
            </div>
        </div>
        <div class="form-div">

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                <h1 class="form-heading">Login Form</h1>
                <hr>
                <div class="input-div mt-4">
                    <label>Email :</label>
                    <input class="" autocomplete="off" type="text" placeholder="email@email.com" name="lemail" value="<?php echo $lemail; ?>">
                </div>
                <p class="error"><span class="error">* <?php echo $lemailError; ?></span></p>
                <div class="input-div">
                    <label>Password :</label>

                    <input class="" autocomplete="off" type="password" placeholder="password@123" name="lpassword" value="<?php echo $lpassword; ?>">
                </div>
                <p class="error"><span class="error">* <?php echo $lpasswordError; ?></span></p>
                <input type="submit" class="login-btn" name="Login" value="Login" />
            </form>
        </div>
    </div>

</body>

</html>