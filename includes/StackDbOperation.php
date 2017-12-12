<?php
/**
 * Created by PhpStorm.
 * User: atom1
 * Date: 8/5/17
 * Time: 12:23 PM
 */

class StackDbOperation
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

    //Function to get stacks
    public function getStacksBymemId($memId)
    {
        $stmt = $this->conn->prepare("");
        if($stmt){
            echo"stmt true";
        }else{
            echo "stmt false";
        }

        $stmt->bind_param("i", $memId);
        $result = $stmt->execute();
        $stmt->close();
        if($result){




            return true;
        }else{
            return false;
        }


    }

    //Function to update stack
    public function updateStack($stackId, $amount)
    {
        $stmt = $this->conn->prepare("");
        if($stmt){
            echo"stmt true";
        }else{
            echo "stmt false";
        }

        $stmt->bind_param("ii", $stackId,$amount);
        $result = $stmt->execut();
        $stmt->close();

        if($result){

            return true;
        }else{
            return false;
        }
    }

}