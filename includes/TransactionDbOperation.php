<?php
/**
 * Created by PhpStorm.
 * User: atom1
 * Date: 8/21/17
 * Time: 6:52 PM
 */

class TransactionDbOperation
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
    public function createTransaction($msfID, $transType, $transAmt, $transStatus)
    {
        $stmt = $this->conn->prepare("INSERT INTO stkr_transaction(MSF_ID, TRNS_TYPE, TRNS_AMT, TRNS_STATUS) VALUES (?, ?, ?, ?)");
        if ($stmt){
            echo "stmt true";
        }else{
            echo "stmt false";
        }
        $stmt->bind_param("iiii", $msfID, $transType, $transAmt, $transStatus);
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