<?php
session_start();
if (count($_SESSION) === 0) {
    header('Location: ../login.php');
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
        <title>dashboard</title>
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
                <div class="flex justify-center items-center gap-2">

                    <div class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                        <svg class="absolute w-12 h-12 text-gray-400 -left-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>

                    <?php
                    echo $_SESSION["user"]["firstname"] . " " . $_SESSION["user"]["lastname"];
                    ?>
                </div>
                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                        <li>
                            <a href="dashboard.php">Home</a>
                        </li>
                        <li>
                            <a href="profile.php">Profile</a>
                        </li>
                        <li>
                            <a href="post.php?page=1">Post</a>
                        </li>
                        <li>
                            <a href="../control/logout.php" class="text-red-500">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <ul class="text-sm font-medium text-gray-900 bg-white rounded-lg border m-10 p-4">
            <div class="border-b flex justify-between items-center py-2 px-8">

                <h1 class="text-center text-lg">All Users</h1>
                <div class="flex items-center justify-center gap-4">
                    <div class="sort">
                        <?php
                        $searchinput = $_GET['search'];
                        $sort = $_GET['sort'];
                        if ($_GET['sort'] === "DESC") {
                            echo '<a class="bg-blue-700 p-3 rounded-lg text-white hover:bg-blue-800 active:bg-blue-300" id="ascending" href="dashboard.php?sort=ASC&search=' . $searchinput . '">ascending</a>';
                        } else {
                            echo '<a class="bg-blue-700 p-3 rounded-lg text-white hover:bg-blue-800 active:bg-blue-300" id="descending" href="dashboard.php?sort=DESC&search=' . $searchinput . '">descending</a>';
                        }
                        ?>

                    </div>
                    <a href="./adduser.php" class="bg-green-600 p-2 rounded-lg text-white hover:bg-green-800 active:bg-green-300">New User</a>
                </div>
            </div>

            <li class="m-4 border border-gray-200 bg-gray-100 rounded-lg grid grid-cols-4">
                <div class="border-r col-span-1 p-4">Id</div>
                <div class="border-r col-span-1 p-4">First Name</div>
                <div class="border-r col-span-1 p-4">Last Name</div>
                <div class="border-r col-span-1 p-4">Email</div>
            </li>
            <?php
            include("../control/database_users.php");
            $list = new ListUsers($_GET['sort']);
            $users = $list->users;
            while ($user = mysqli_fetch_array($users)) {
                if ($user['parent_email'] === $_SESSION["user"]["email"]) {
            ?>
                    <li class="m-4 border border-gray-200 bg-gray-100 rounded-lg grid grid-cols-4">
                        <div class="border-r col-span-1 p-4"><?php echo $user['id']; ?></div>
                        <div class="border-r col-span-1 p-4"><?php echo $user['firstname']; ?></div>
                        <div class="border-r col-span-1 p-4"><?php echo $user['lastname']; ?></div>
                        <div class="border-r col-span-1 p-4"><?php echo $user['email']; ?></div>
                    </li>
            <?php }
            } ?>
        </ul>


    </body>

    </html>
<?php } ?>