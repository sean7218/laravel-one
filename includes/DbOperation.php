<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
/**
 * Created by PhpStorm.
 * User: atom1
 * Date: 7/19/17
 * Time: 11:03 AM
 */

class DbOperation
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

    //Function to create new Stack
    public function createStack($stackName, $stackGoalAmount, $stackCurrentAmount)
    {
        $stmt = $this->conn->prepare("INSERT INTO stkr_stack(STACK_NAME, STACK_GOAL, STACK_CURRENT) values(?,?,?)");
        if ($stmt){
            echo "stmt true";
        }else{
            echo "stmt false";
        }
        $stmt->bind_param("sii", $stackName, $stackGoalAmount,$stackCurrentAmount);
        //echo $stmt;
        $result = $stmt->execute();
        $stmt->close();
        if($result){
            return true;
        } else {
            return false;
        }
    }

    //Function to create new Funding Source
    public function createFundSrc($fndName, $fndSrcType, $fndSrcAcct, $fndSrcRt, $fndSrcUser, $fndSrcPass){
        $stmt = $this->conn->prepare("INSERT INTO stkr_fund_src(MEM_ID, FND_NAME, FND_TYPE, FND_RT, FND_ACCT, FND_USER, FND_PASS) values(?,?,?,?,?,?,?)");
        if ($stmt){
            echo "stmt true";
        }else{
            echo "stmt false";
        }
        $stmt->bind_param("isiiiss", $fndName, $,$stackCurrentAmount);
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