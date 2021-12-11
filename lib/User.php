<?php
include_once 'Session.php';
include 'Database.php';

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function userRegistration($data)
    {
        $name       = $data['name'];
        $username   = $data['username'];
        $email      = $data['email'];
        $password   = md5($data['password']);

        $chk_email  = $this->emailCheck($email);

        if ($name == "" or $username == "" or $email == "" or $password == "") {
            $msg = "<div class = 'alert alert-danger'><strong> ERROR! </strong> Field Must Not Be Empty!</div>";
            return $msg;
        }
        if (strlen($username) < 3) {
            $msg = "<div class = 'alert alert-danger'><strong> ERROR! </strong> User name is too short!!</div>";
            return $msg;
        } elseif (preg_match('/[^a-z0-9_-]+/i', $username)) {
            $msg = "<div class = 'alert alert-danger'><strong> ERROR! </strong> User name must only contain alpha numerical dashes and underscore!!</div>";
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $msg = "<div class = 'alert alert-danger'><strong> ERROR! </strong> Email Address is not valid!!</div>";
            return $msg;
        }
        if (strlen($password) < 6) {
            $msg = "<div class = 'alert alert-danger'><strong> ERROR! </strong>Short Pass!!</div>";
            return $msg;
        }
        if ($chk_email == true) {
            $msg = "<div class = 'alert alert-danger'><strong> ERROR! </strong> Email Already Exists!!</div>";
            return $msg;
        }
        $password   = md5($data['password']);
        $sql = "INSERT INTO tbl_user(name,username,email,password) VALUES (:name,:username,:email,:password) ";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':name', $name);
        $query->bindValue(':username', $username);
        $query->bindValue(':email', $email);
        $query->bindValue(':password', $password);
        $result = $query->execute();
        if ($result) {
            $msg = "<div class = 'alert alert-success'><strong> Success! </strong> Thank You! You have been registered!</div>";
            return $msg;
        } else {
            $msg = "<div class = 'alert alert-danger'><strong> ERROR! </strong> Sorry! Something Wrong!!</div>";
            return $msg;
        }
    }
    public function emailCheck($email)
    {
        $sql = "SELECT email FROM tbl_user WHERE email = :email";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':email', $email);
        $query->execute();
        if ($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function getLoginUser($email, $password)
    {
        $sql = "SELECT * FROM tbl_user WHERE email = :email AND password = :password LIMIT 1";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':email', $email);
        $query->bindValue(':password', $password);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public function userLogin($data)
    {
        $email      = $data['email'];
        $password   = md5($data['password']);
        $chk_email  = $this->emailCheck($email);
        if ($email == "" or $password == "") {
            $msg = "<div class = 'alert alert-danger'><strong> ERROR! </strong> Field Must Not Be Empty!</div>";
            return $msg;
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $msg = "<div class = 'alert alert-danger'><strong> ERROR! </strong> Email Address is not valid!!</div>";
            return $msg;
        }
        if ($chk_email == false) {
            $msg = "<div class = 'alert alert-danger'><strong> ERROR! </strong> Email is not found!!</div>";
            return $msg;
        }
        $result = $this->getLoginUser($email, $password);
        if ($result) {
            Session::init();
            Session::set("login", true);
            Session::set("id", $result->id);
            Session::set("name", $result->name);
            Session::set("username", $result->username);
            Session::set("loginmsg", "<div class = 'alert alert-success'><strong> Success! </strong> You are logged in!!</div>");
            header("Location:index.php");
        } else {
            $msg = "<div class = 'alert alert-danger'><strong> ERROR! </strong> Data not found!!</div>";
            return $msg;
        }
    }
    public function getUserData()
    {
        $sql = "SELECT * FROM tbl_user ORDER BY id DESC";
        $query = $this->db->pdo->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    public function getUserById($userid)
    {
        $sql = "SELECT * FROM tbl_user WHERE id= :id LIMIT 1";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':id', $userid);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function updateUserData($id, $data)
    {
        $name       = $data['name'];
        $username   = $data['username'];
        $email      = $data['email'];


        if ($name == "" or $username == "" or $email == "") {
            $msg = "<div class = 'alert alert-danger'><strong> ERROR! </strong> Field Must Not Be Empty!</div>";
            return $msg;
        }

        $sql        = "UPDATE tbl_user SET 
        name        = :name,
        username    = :username,
        email       = :email
        WHERE id    = :id";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':name', $name);
        $query->bindValue(':username', $username);
        $query->bindValue(':email', $email);
        $query->bindValue(':id', $id);
        $result = $query->execute();
        if ($result) {
            $msg = "<div class = 'alert alert-success'><strong> Success! </strong> User Data Updated Successfully!</div>";
            return $msg;
        } else {
            $msg = "<div class = 'alert alert-danger'><strong> ERROR! </strong> Sorry! Something Wrong!!</div>";
            return $msg;
        }
    }
    private function checkPassword($id, $old_pass)
    {
        $password = md5($old_pass);
        $sql = "SELECT password FROM tbl_user WHERE id = :id AND password = :password";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':id', $id);
        $query->bindValue(':password', $password);
        $query->execute();
        if ($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePassword($userid, $data)
    {
        $old_pass = $data['old_pass'];
        $new_pass = $data['password'];
        $chk_pass = $this->checkPassword($userid, $old_pass);
        if ($old_pass == "" or $new_pass == "") {
            $msg = "<div class = 'alert alert-danger'><strong> ERROR! </strong>Field Must Not Be Empty!!</div>";
            return $msg;
        }
        if ($chk_pass == false) {
            $msg = "<div class = 'alert alert-danger'><strong> ERROR! </strong>Exist Pass!!</div>";
            return $msg;
        }

        if (strlen($new_pass) < 6) {
            $msg = "<div class = 'alert alert-danger'><strong> ERROR! </strong>Short Pass!!</div>";
            return $msg;
        }
        $password = md5($new_pass);
        $sql        = "UPDATE tbl_user SET 
        password    = :password
        WHERE id    = :id ";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':password', $password);
        $query->bindValue(':id', $userid);
        $result = $query->execute();
        if ($result) {
            $msg = "<div class = 'alert alert-success'><strong> Success! </strong> Password Updated!</div>";
            return $msg;
        } else {
            $msg = "<div class = 'alert alert-danger'><strong> ERROR! </strong> Sorry! Something Wrong!!</div>";
            return $msg;
        }
    }
}
