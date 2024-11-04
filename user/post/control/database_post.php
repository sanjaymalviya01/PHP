<?php
class database
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = 'root';
    private $database = 'myDB';
    public $connection;
    public $post;
    public $posts;
    private $query;

    public function db()
    {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if ($this->connection->connect_error) {
            die("Connection Failed : " . $this->connection->connect_error);
        } else {
            // echo "Connected Successfully.<br>";
            return $this->connection;
        }
    }
    public function operation($query)
    {
        $this->db();
        $this->query = $query;
        $this->posts = mysqli_query($this->connection, $this->query);
        return $this->posts;
    }
}
class ListPosts extends database
{
    public $sort;
    public $search;
    public $number_of_page;
    public function __construct($sort, $search)
    {
        $this->sort = $sort;
        $this->search = $search;
        $query = "SELECT * FROM posts WHERE post_title LIKE '%$this->search%' ORDER BY id $sort";
        
        $this->posts = $this->operation($query);

        //Code for pagination
        $results_per_page = 2;
        $result = $this->posts;
        $number_of_result = mysqli_num_rows($result);

        $this->number_of_page = ceil($number_of_result / $results_per_page);

        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        $page_first_result = ($page - 1) * $results_per_page;

        $query2 = "SELECT *FROM posts WHERE post_title LIKE '%$this->search%' ORDER BY id $sort LIMIT " . $page_first_result . ',' . $results_per_page;
        $result = $this->operation($query2);



        return $this->posts;
    }
}
class AddPost extends database
{
    public $username;
    public $post;
    public $post_title;
    public function __construct($username, $post_title, $post)
    {
        $this->post_title = $post_title;
        $this->username = $username;
        $this->post = $post;

        $query = "INSERT INTO posts (username,post_title,post) VALUES('$this->username','$this->post_title','$this->post')";
        $this->operation($query);
        return $this->posts;
    }
}
