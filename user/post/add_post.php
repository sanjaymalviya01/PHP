<?php
session_start();
include("./control/database_post.php");
$postTitleError = $postError = "";
$posttext = $_POST["posttext"];
$post_title = $_POST["post_title"];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST["posttext"])) {
        $postError = "Some content is required";
    }
    if (empty($_POST["post_title"])) {
        $postTitleError = "Title is required";
    }
    if ($postError === "" && $postTitleError === "") {
        $add = new AddPost($_SESSION['user']['firstname'], $post_title, $posttext);
        header('Location: ../post.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        <a href="../dashboard.php">Home</a>
                    </li>
                    <li>
                        <a href="../profile.php">Profile</a>
                    </li>
                    <li>
                        <a href="../post.php?page=1">Post</a>
                    </li>
                    <li>
                        <a href="../control/logout.php" class="text-red-500">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="grid m-8 p-8 border rounded-lg bg-slate-100">
        <div class="flex items-center gap-4">
            <label for="post_title">Post Title</label>
            <input type="text" name="post_title" class="border p-1 rounded-lg">
            <p class="text-red-500 text-right">*<?php echo $postTitleError; ?></p>
        </div>
        <label for="post">Write Your thoughts here.</label>
        <textarea name="posttext" id="post" class="border my-4 p-4 rounded-lg"></textarea>
        <p class="text-red-500 text-right">*<?php echo $postError; ?></p>
        <input type="submit" style="margin-top: 1rem;" class="text-white bg-blue-500 hover:bg-blue-800 active:bg-blue-300 p-2 rounded-lg text-center cursor-pointer" name="post" value="Post" />
    </form>

</body>

</html>