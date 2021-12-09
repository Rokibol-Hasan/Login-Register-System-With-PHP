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
        if ($chk_email == true) {
            $msg = "<div class = 'alert alert-danger'><strong> ERROR! </strong> Email Already Exists!!</div>";
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
}
