<?php
session_start();
if (count($_SESSION) === 0) {;
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
        <div class="font-medium text-gray-900 bg-sky-50 rounded-lg border m-10 p-4">
            <div class="flex justify-between items-center border-b border-slate-300 p-4">
                <h1 class="text-center text-xl">Posts</h1>
                <div class="search">

                    <form class="max-w-md mx-auto" action="post.php" method="get">
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input value="<?php echo $_GET['search']  ?>" type="search" id="input_search" name="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search by title..." />
                            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                            <?php if ($_GET['search'] !== "") { ?><a href="post.php?&search=" type="submit" class="text-gray-500 absolute end-20 mr-2 bottom-2.5 font-medium rounded-lg text-sm px-4 py-2">X</a><?php } ?>
                        </div>
                    </form>

                </div>

                <div class="flex items-center justify-center gap-4">

                    <div class="sort">
                        <?php
                        $searchinput = $_GET['search'];
                        $sort = $_GET['sort'];
                        if ($_GET['sort'] === "DESC") {
                            echo '<a class="bg-blue-700 p-3 rounded-lg text-white hover:bg-blue-800 active:bg-blue-300" id="ascending" href="post.php?sort=ASC&search=' . $searchinput . '">ascending</a>';
                        } else {
                            echo '<a class="bg-blue-700 p-3 rounded-lg text-white hover:bg-blue-800 active:bg-blue-300" id="descending" href="post.php?sort=DESC&search=' . $searchinput . '">descending</a>';
                        }
                        ?>

                    </div>
                    <a href="./post/add_post.php" class="bg-green-600 p-2 rounded-lg text-white hover:bg-green-800 active:bg-green-300">New Post</a>
                </div>
            </div>

            <?php
            include("./post/control/database_post.php");

            $list = new ListPosts($_GET['sort'], $_GET['search']);
            $posts = $list->posts;
            while ($post = mysqli_fetch_array($posts)) {
            ?>
                <div class="border border-slate-500 m-10 min-h-20 rounded-lg bg-white">
                    <div class="flex justify-between items-center px-10 bg-slate-100 rounded-t-lg">
                        <h1 class=""><?php echo $post['username']; ?> </h1>
                        <p class="px-10 text-xs text-gray-500">Post No. <?php echo $post['id']; ?></p>
                        <span class="text-xs text-gray-500"><?php echo $post['time']; ?></span>
                    </div>
                    <hr>
                    <h1 class="px-10 text-xl font-bold"><?php echo $post['post_title']; ?></h1>
                    <p class="px-10"><?php echo $post['post']; ?></p>
                </div>
            <?php } ?>


            <nav aria-label="Page navigation example" class="flex justify-center items-center">
                <ul class="inline-flex -space-x-px text-base h-10">
                    <li>
                        <?php echo $_GET['page'] == 1 ? '<a class="select-none text-gray-500 flex items-center justify-center px-4 h-10 ms-0 leading-tight bg-white border border-e-0 border-gray-300 rounded-s-lg">Previous</a>' : '<a href="post.php?page=' . ($_GET['page'] - 1) . '&search=' . $searchinput . '&sort=' . $sort . '" class="text-blue-500 flex items-center justify-center px-4 h-10 ms-0 leading-tight bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>' ?>
                    </li>
                    <?php
                    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $total_pages = $list->number_of_page;
                    $links_to_show = 3;

                    $start_page = max(1, $current_page - floor($links_to_show / 2));
                    $end_page = min($total_pages, $start_page + $links_to_show - 1);

                    if ($end_page - $start_page < $links_to_show - 1) {
                        $start_page = max(1, $end_page - $links_to_show + 1);
                    }

                    for ($page = $start_page; $page <= $end_page; $page++) {
                        if ($_GET['page'] == $page) {
                            echo '<a class="select-none text-blue-600 flex items-center justify-center px-4 h-10 leading-tight bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="post.php?page=' . $page . '&search=' . $searchinput . '&sort=' . $sort . '">' . $page . '</a> ';
                        } else {
                            echo '<a class="select-none text-gray-500 flex items-center justify-center px-4 h-10 leading-tight bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="post.php?page=' . $page . '&search=' . $searchinput . '&sort=' . $sort . '">' . $page . '</a> ';
                        }
                    }

                    ?>
                    <li>
                        <?php echo $_GET['page'] == $page - 1 ? '<a class="select-none text-gray-500 flex items-center justify-center px-4 h-10 bg-white border border-gray-300 rounded-e-lg">Next</a>' : '<a href="post.php?page=' . ($_GET['page'] + 1) . '&search=' . $searchinput . '&sort=' . $sort . '" class="text-blue-500 flex items-center justify-center px-4 h-10 leading-tight bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>' ?>
                    </li>
                </ul>
            </nav>
        </div>
    </body>

    </html>
<?php } ?>