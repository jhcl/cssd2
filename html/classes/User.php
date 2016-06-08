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

        $query = "select * from gebruiker where username = :usr";
        $params = array("usr" => strtolower($username));
        $result = $this->db->selectStatement($query, $params);
        
        if($result == NULL){

            $_SESSION['msg'] = "Invalid name for ".$username;
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
              $_SESSION['msg'] = "Invalid password for ".$username;
            }
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
    public function register($username, $password) {
        if (preg_match('/[\\\\.\/]+/', $username) === 0 && strlen($username) > 0 && strlen($password) > 0) {
            $query = "insert into gebruiker values (:usr, :pwd, 1)";
            $pswHash = password_hash($password, PASSWORD_DEFAULT);
            $params = array('usr' => strtolower($username), 'pwd' => $pswHash);
            $this->db->createStatement($query, $params);

            $_SESSION['msg'] = "Registered ".$username." ".$pswHash;
        } else {
            $_SESSION['msg'] = "No (back)slashes or dots in username or empty password.";
        }
        header('Location:/index.php');
    }

    /**
     * Function to check whether user has had invite to a file
     * TODO : Full PHPDOCS
     *
     * @param $bestandid 
     * @return boolean
     *
     */
    public function hasInvite($bestandid) {
       $count = $this->db->selectStatement("select count(*) as count from user_bestandid where upper(username) = upper(:usr) and bestandid = :bid and invite = 1",
            array("usr"=>$this->name, "bid"=>$bestandid));
       return (($count[0]['count'] == 1) ? TRUE : FALSE);
    }

    /**
     * Function to check whether user has had invite to a file
     * TODO : Full PHPDOCS
     *
     * @param $bestandid 
     * @return boolean
     *
     */
    public function hasRequested($bestandid) {
       $count = $this->db->selectStatement("select count(*) as count from user_bestandid where upper(username) = upper(:usr) and bestandid = :bid and invite = 0",
            array("usr"=>$this->name, "bid"=>$bestandid));
       return (($count[0]['count'] == 1) ? TRUE : FALSE);
    }

    /**
     * Function to check whether user has is owner of file
     * TODO : Full PHPDOCS
     *
     * @param $bestandid 
     * @return boolean
     *
     */
    public function isOwner($bestandid) {
       $count = $this->db->selectStatement("select count(*) as count from bestand where upper(owner) = upper(:usr) and id = :bid",
            array("usr"=>$this->name, "bid"=>$bestandid));
       return (($count[0]['count'] == 1) ? TRUE : FALSE);
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
