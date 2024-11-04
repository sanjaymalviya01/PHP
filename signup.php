<?php include("./control/database_users.php") ?>
<?php
$fnameError = $lnameError = $emailError = $passwordError = "";
$fname = $lname = $email = $password = "";
$parent_email = 'none';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST["fname"])) {
        $fnameError = "required";
    } else {
        $fname = test_input($_POST['fname']);
        if (!preg_match("/^[a-zA-Z-]*$/", $fname)) {
            $fnameError = "Only letters and whitespace allowed";
        }
    }
    if (empty($_POST["lname"])) {
        $lnameError = "required";
    } else {
        $lname = test_input($_POST['lname']);
        if (!preg_match("/^[a-zA-Z-]*$/", $lname)) {
            $lnameError = "Only letters and whitespace allowed";
        }
    }
    if (empty($_POST["email"])) {
        $emailError = "required";
    } else {
        $email = test_input($_POST['email']);
        if (!preg_match("/^[a-zA-Z0-9]+@(?:[a-zA-Z0-9]+\.)+[A-Za-z]+$/", $email)) {
            $emailError = "Incorrcet Email";
        }
    }
    if (empty($_POST["password"])) {
        $passwordError = "required";
    } else {
        $password = test_input($_POST['password']);
        if (strlen($password) < 6) {
            $passwordError = "must be 6 letter long";
        }
        if (!preg_match("/[a-z]/", $password)) {
            $passwordError = "At least 1 letter";
        }
        if (!preg_match("/[0-9]/", $password)) {
            $passwordError = "At least 1 number";
        }
        if (!preg_match("/[!#$%&?@ ']/", $password)) {
            $passwordError = "At least 1 Special Character";
        }
    }
    if (
        $fnameError === "" && $lnameError === "" && $emailError === "" && $passwordError === ""
        && $fname !== "" && $lname !== "" && $email !== "" && $password !== ""

    ) {
        $parent_email = $email;
        $add = new AddUser($fname, $lname, $parent_email, $email, $password);
        header('Location: login.php');
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
    <style>
        .error {
            text-align: right;
            color: red
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>

    <nav class="border">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">CRUD App</span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="flex gap-4 w-full border justify-between items-center">
        <div class="flex justify-center w-full h-full gap-4">
            <a href="https://flowbite.com/" class="h-40">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-full w-full" alt="Flowbite Logo" />
            </a>
            <div class="flex flex-col justify-center items-center">
                <h1 class="self-center text-3xl font-semibold">CRUD App</h1>
                <p class="self-center">Connecting People</p>
            </div>
        </div>
        <div class="border rounded-lg m-4 p-4 w-1/2">

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <h1 class="text-center text-2xl m-2">Signup Form</h1>
                <hr>
                <div style="margin-top: 1rem;" class="flex justify-between items-center gap-4">
                    <label>First Name :</label>
                    <input onchange="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="border p-2 rounded-lg" type="text" autocomplete="off" name="fname" value="<?php echo $fname; ?>">
                </div>
                <p class="error"><span class="error">* <?php echo $fnameError; ?></span></p>
                <div class="flex justify-between items-center gap-4">
                    <label>Last Name :</label>
                    <input class="border p-2 rounded-lg" type="text" autocomplete="off" name="lname" value="<?php echo $lname; ?>">
                </div>
                <p class="error"><span class="error">* <?php echo $lnameError; ?></span></p>
                <!-- <div class="flex justify-between items-center gap-4">
                    <label>Parent Email :</label>
                    <input disabled class="border p-2 rounded-lg text-gray-500" type="text" autocomplete="off" name="parent_email" value="<?php echo $parent_email; ?>">
                </div>
                <p class="error"><span class="text-gray-500 text-xs">* You will be the admin user.</span></p> -->
                <div class="flex justify-between items-center gap-4">
                    <label>Email :</label>
                    <input class="border p-2 rounded-lg" type="text" autocomplete="off" name="email" value="<?php echo $email; ?>">
                </div>
                <p class="error"><span class="error">* <?php echo $emailError; ?></span></p>
                <div class="flex justify-between items-center gap-4">
                    <label>Password :</label>
                    <input class="border p-2 rounded-lg" type="password" autocomplete="off" name="password" value="<?php echo $password; ?>">
                </div>
                <p class="error" style="margin-bottom: 1rem;"><span class="error">* <?php echo $passwordError; ?></span></p>
                <hr>
                <input type="submit" style="margin-top: 1rem;" class="text-white bg-blue-500 p-2 rounded-lg text-center " name="Signup" value="Signup" />
            </form>
        </div>
    </div>

</body>

</html>