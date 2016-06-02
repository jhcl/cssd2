<?php

/**
 * TODO : Full PHPDOCS User Class
 * This class contains information over User and User actions
 */
class User
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $db;

    function __construct($id, $name, $email, $password) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->db = new Database();
    }

    /**
     * Function to login a user
     * TODO : Full PHPDOCS
     *
     * @param $username
     * @param $password
     */
    public function login($username, $password)
    {

        $query = "select * from gebruiker where username = :usr and password = :pwd";
        $params = array("usr" => $username , "pwd" => $password);
        $result = $this->db->selectStatement($query, $params);

        if($result == NULL){

            $_SESSION['msg'] = "Invalid name or password for ".$username;
            header('Location:/index.php');

        }
        else {
            $username = $result[0]['username'];
            $password = $result[0]['password'];
            $_SESSION['msg'] = "logged in as " . $username;
            $_SESSION['user'] = $username;
            setcookie("user", $username, time() + 3600, "/");
            header('Location:/hoofdpagina.php');
        }
    }

    /**
     * Function to logout a user
     * TODO : Full PHPDOCS
     *
     * @param $user_id
     */
    public function logout($user_id)
    {
        // TODO : Logout implementation
    }

    /**
     * Function to register a user
     * TODO : Full PHPDOCS
     *
     * @param $name
     * @param $email
     * @param $password
     *
     */
    public function register($username, $password)
    {
        $query = "insert into gebruiker values (:usr, :pwd,'',1)";
        $params = array('usr' => $username, 'pwd' => $password);
        $this->db->createStatement($query, $params);

        $_SESSION['msg'] = "Registered ".$username." ".$password;

        header('Location:/index.php');
    }

    /**
     * Function to validate a user that wants to register
     * TODO : Full PHPDOCS
     *
     * @param $name
     * @param $email
     * @param $password
     */
    public function registerValidation($name, $email, $password)
    {
        // TODO : Register Validation implementation
    }

    /**
     * Function for "file owner" to invite anoter user to a file
     * TODO : Full PHPDOCS
     *
     * @param $user_id
     */
    public function inviteUserToFile($user_id)
    {
        // TODO : Invite User To File implementation
    }

    /**
     * Function to grant acces to the file to the selected user
     * TODO : Full PHPDOCS
     *
     * @param $user_id
     */
    public function setPrivilige($user_id)
    {
        // TODO : Set privilege implementation
    }

    /**
     * Function to upload a file
     * TODO : Full PHPDOCS
     *
     * @param $file_obj
     */
    public function upload($file_obj)
    {
        // TODO : Upload File implementation
    }

}
