<?php
/**
 * Created by PhpStorm.
 * User: atom1
 * Date: 7/23/17
 * Time: 7:08 PM
 */

$response = array();

$memID = $fndName = $fndSrcType = $rtNum = $acctNum = $user = $pass = "";

if($_SERVER['REQUEST_METHOD']=='POST'){

    //getting values


    if(empty($_POST['memID'])){
        $memID = "memid";
    } else{
        $memID = $_POST['memID'];
    }

    if(empty($_POST['fndName'])){
        $fndName = "fnd name";
    } else{
        $fndName = $_POST['fndName'];
    }

    if(empty($_POST['fndSrcTyp'])){
        $fndSrcType = 01;
    } else{
        $fndSrcType = $_POST['fndSrcTyp'];
    }

    if(empty($_POST['rtNum'])){
        $rtNum = 1;
    } else{
        $rtNum = $_POST['rtNum'];
    }

    if(empty($_POST['acctNum'])){
        $acctNum = 1;
    } else{
        $acctNum = $_POST['acctNum'];
    }

    if(empty($_POST['user'])){
        $user = "user1";
    } else{
        $user = $_POST['user'];
    }

    if(empty($_POST['pass'])){
        $pass = "pass1";
    } else{
        $pass = $_POST['pass'];
    }

    require_once '../includes/FundSrcDbOperation.php';

    $db = new FundSrcDbOperation();

    //inserting values
    if($db->createFundSrc($memID, $fndName,$fndSrcType, $acctNum, $rtNum, $user, $pass)){
        $response['error']=false;
        $response['message'] = 'Fund Source added successfully';
    } else{
        $response['error'] = true;
        $response['message'] = 'Could not add fund source';
    }
} else {
    $response['error'] =true;
    $response['message'] = 'say sumn else';
}

echo json_encode($response);

function testInput($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
}