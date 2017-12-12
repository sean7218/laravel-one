<?php
/**
 * Created by PhpStorm.
 * User: atom1
 * Date: 8/21/17
 * Time: 6:54 PM
 */

class MemStkFndDbOperation
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
    public function createMemStkFnd($memID, $stackID, $fndSrcID, $memStatus)
    {
        $stmt = $this->conn->prepare("INSERT INTO stkr_mem_stk_fnd(MEM_ID, STACK_ID, FND_ID, MEM_STATUS) VALUES (?, ?, ?, ?)");
        if ($stmt){
            echo "stmt true";
        }else{
            echo "stmt false";
        }
        $stmt->bind_param("iiii", $memID, $stackID, $fndSrcID, $memStatus);
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