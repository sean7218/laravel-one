<?php
/**
 * Created by PhpStorm.
 * User: atom1
 * Date: 8/5/17
 * Time: 12:44 PM
 */

class FundSrcDbOperation
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

    //Function to create new Funding Source
    public function createFundSrc($memID, $fndName, $fndSrcType, $fndSrcAcct, $fndSrcRt, $fndSrcUser, $fndSrcPass)
    {
        $stmt = $this->conn->prepare("INSERT INTO stker_fund_src( MEM_ID, FND_TYPE, FND_RT, FND_ACCT, FND_USERNAME, FND_NAME) values(?,?,?,?,?,?)");
        if ($stmt){
            echo "stmt true";
        }else{
            echo "stmt false";
        }
        $stmt->bind_param("iiiiss", $memID, $fndSrcType, $fndSrcRt, $fndSrcAcct, $fndSrcUser, $fndName);
        //echo $stmt;
        $result = $stmt->execute();
        $stmt->close();
        if($result){
            return true;
        } else {
            return false;
        }
    }


    //Function to update Funding Source
    public function updateFundSrc($memID, $fndName, $fndSrcType, $fndSrcAcct, $fndSrcRt, $fndSrcUser, $fndSrcPass)
    {
        $stmt = $this->conn->prepare("");
        if ($stmt){
            echo "stmt true";
        }else{
            echo "stmt false";
        }
        $stmt->bind_param("iiiiss", $memID, $fndSrcType, $fndSrcRt, $fndSrcAcct, $fndSrcUser, $fndName);
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