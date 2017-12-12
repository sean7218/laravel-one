<?php
/**
 * Created by PhpStorm.
 * User: atom1
 * Date: 8/5/17
 * Time: 12:30 PM
 */

class MemberDbOperation
{
    private $conn;

    //Constructor
    function __construct()
    {
        require_once 'Config.php';
        require_once 'DbConnect.php';
        //opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    //Function to create a new user
    public function createMember($memName, $memPhone, $memEmail)
    {
        /*
        if($memName === ''){
            $memName = "ANT";
        }


        $connek = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

        if ($connek->connect_error){
            die("Connection failed: " . $connek->connect_error);
        }

        $sql= "INSERT INTO stkr_member(MEM_NAME, MEM_EMAIL, MEM_PHONE) VALUES ('" . $memName . "', '" . $memEmail . "'," . $memPhone ." )";

        if ($connek->query($sql)===TRUE){
            echo "nw rec made";
        }else{
            echo "fuck off" . $sql;
        }
        $connek->close();
        */

        $stmt = $this->conn->prepare("INSERT INTO stkr_member(MEM_NAME, MEM_EMAIL, MEM_PHONE) values(?,?,?)");
        if ($stmt){
            echo "stmt true";
        }else{
            echo "stmt false";
        }
        $stmt->bind_param("ssi", $memName, $memEmail,$memPhone);
        //echo $stmt;
        $result = $stmt->execute();
        $stmt->close();
        if($result){
            return true;
        } else {
            return false;
        }
    }
}