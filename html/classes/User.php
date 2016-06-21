<?php

/**
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
     *
     * First there will be a check that will check if an user already exists in the database with the given username.@deprecated
     * If this results in a null returned then the user will be redirected to index.php else
     * the user will be logged in if the given password matches the password from the database.
     * Both passwords contains a hash
     *
     * If the user entered a valid e-mail and password then the user will be logged in username as value for $_SESSION['user']
     * and redirected to hoofdpagina.php
     * If this user entered a invalid password the user will be redirected to index.php
     *
     * @param $username the username of an user as string
     * @param $password the password of an user as string
     *
     */
    public function login($username, $password)
    {

        $query = "select * from gebruiker where username = :usr";
        $params = array("usr" => strtolower($username));
        $result = $this->db->selectStatement($query, $params);
        
        if($result == NULL){

            $_SESSION['msg'] = "Invalid username and / or password";
            header('Location:/index.php');

        }
        else {
            $username = $result[0]['username'];
            $pswHash = $result[0]['password'];
            $verified = password_verify($password, $pswHash);
            if ($verified) {
                $_SESSION['msg'] = "logged in as " . $username;
                $_SESSION['user'] = $username;
                setcookie("user", $username, time() + 3600, "/");
                header('Location:/hoofdpagina.php');
            } else {
              $_SESSION['msg'] = "Invalid username and / or password ";
                header('Location:/index.php');
            }
        }
    }

    /**
     * Function to register a user
     *
     * This function will first check if the user did not enter disallowed characters
     * This function will also check if the user did enter an username and password that has aleast 1 character
     * If this is the case than the given username and password will be inserted into the database and the user
     * is created. The password will be hashed.
     *
     * If above isn't true than the user will get the following error message:
     * "No (back)slashes or dots in username or empty password."
     *
     * @param $email the user's given e-mailadres
     * @param $password the user's given password
     *
     */
    public function register($username, $password) {
        if (preg_match('/[\\\\.\/]+/', $username) === 0 && strlen($username) > 0 && strlen($password) > 0) {
            $query = "insert into gebruiker values (:usr, :pwd, 1)";
            $pswHash = password_hash($password, PASSWORD_DEFAULT);
            $params = array('usr' => strtolower($username), 'pwd' => $pswHash);
            $this->db->createStatement($query, $params);

            $_SESSION['msg'] = "Registered ".$username;
        } else {
            $_SESSION['msg'] = "No (back)slashes or dots in username or empty password.";
        }
        header('Location:/index.php');
    }

    /**
     * Function to check whether user has had invite to a file
     *
     * Simple database PDO query that will check if the user has any invites by checking if
     * invite == 1 in the database for the given (SESSION) username this happens in table user_bestandid
     * The book id is connected to the user.
     *
     * @param $bestandid the id of the file
     * @return boolean true if the user got access to the book, false if this is not the case
     *
     */
    public function hasInvite($bestandid) {
       $count = $this->db->selectStatement("select count(*) as count from user_bestandid where upper(username) = upper(:usr) and bestandid = :bid and invite = 1",
            array("usr"=>$this->name, "bid"=>$bestandid));
       return (($count[0]['count'] == 1) ? TRUE : FALSE);
    }

    /**
     * Function to check whether user has had requested access to a file
     *
     * Simple database PDO query that will check if the user has send any requests by checking if
     * invite == 0 in the database for the given (SESSION) username this happens in table user_bestandid
     * The book id is connected to the user.
     *
     * @param $bestandid the id of the file
     * @return boolean true if the user requested to the book, false if this is not the case
     *
     */
    public function hasRequested($bestandid) {
       $count = $this->db->selectStatement("select count(*) as count from user_bestandid where upper(username) = upper(:usr) and bestandid = :bid and invite = 0",
            array("usr"=>$this->name, "bid"=>$bestandid));
       return (($count[0]['count'] == 1) ? TRUE : FALSE);
    }

    /**
     * Function to check whether user is the owner of the file
     *
     * Simple database PDO query that will check if the user is the owner of the file
     * If owner == username the user is the owner of the book
     *
     * @param $bestandid the id of the file
     * @return boolean true if the user is the owner of the bbook, false if this is not the case
     *
     */
    public function isOwner($bestandid) {
       $count = $this->db->selectStatement("select count(*) as count from bestand where upper(owner) = upper(:usr) and id = :bid",
            array("usr"=>$this->name, "bid"=>$bestandid));
       return (($count[0]['count'] == 1) ? TRUE : FALSE);
    }


}
