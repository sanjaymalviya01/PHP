<?php
class database
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = 'root';
    private $database = 'myDB';
    public $connection;
    public $user;
    public $users;
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
        $this->users = mysqli_query($this->connection, $this->query);
        return $this->users;
    }
}
class ListUsers extends database
{
    public $sort;
    public function __construct($sort)
    {
        $this->sort = $sort;
        $query = "SELECT * FROM users ORDER BY id $this->sort";
        $this->users = $this->operation($query);
        return $this->users;
    }
}
class FindUser extends database
{
    public $id;
    public function __construct($id)
    {
        $this->id = $id;
        $query = "SELECT * FROM users WHERE id=$this->id";
        $this->user = $this->operation($query);
        return $this->user;
    }
}
class AddUser extends database
{
    private $fname;
    private $lname;
    private $email;
    private $password;
    private $parent_email;
    public function __construct($fname, $lname, $parent_email, $email, $password)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->password = $password;
        $this->parent_email = $parent_email;

        $query = "INSERT INTO users (firstname,lastname,parent_email,email,password) VALUES('$this->fname','$this->lname','$this->parent_email','$this->email','$this->password')";
        $this->operation($query);
        return $this->users;
    }
}
class UpdateUser extends database
{
    private $id;
    private $fname;
    private $lname;
    private $email;
    private $password;
    public function __construct($id, $fname, $lname, $email, $password)
    {
        echo "hello";
        $this->id = $id;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->password = $password;
        $query = "UPDATE `users` SET `firstname` = '$this->fname', `lastname` = '$this->lname', `email` = '$this->email' , `password` = '$this->password' WHERE `users`.`id` = $this->id";
        $this->operation($query);
        return $this->users;
    }
}
class DeleteUser extends database
{
    private $id;
    private $query;
    public function __construct($id)
    {
        echo "hello";
        $this->id = $id;
        $this->query = "DELETE *FROM users WHERE id = $this->id";
        mysqli_query($this->connection, $this->query);
    }
}
class LoginUser extends database
{
    private $email;
    private $password;
    public $user;
    public $error;
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;

        echo $this->email;
        echo $this->password;

        $query = "SELECT * FROM users WHERE email='$this->email'";
        $result = $this->operation($query);
        $this->user = mysqli_fetch_array($result);
        echo $this->user;
        $db_pass = $this->user['password'];
        if ($this->user === NULL) {
            $this->error = "incorrect email";
        } else {
            if ($this->password === $db_pass) {
                header('Location: user/dashboard.php');
            } else {
                $this->error = "incorrect password";
            }
        }
    }
}
