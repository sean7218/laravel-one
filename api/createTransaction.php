<?php
/**
 * Created by PhpStorm.
 * User: atom1
 * Date: 8/25/17
 * Time: 9:03 PM
 */


$response = array();

$msfID = $transType = $transAmt = $transStatus = "";

if($_SERVER['REQUEST_METHOD']=='POST'){

    //getting values


    if(empty($_POST['msfID'])){
        $msfID = 100;
    } else{
        $msfID = $_POST['msfID'];
    }

    if(empty($_POST['transType'])){
        $transType = 100;
    } else{
        $transType = $_POST['transType'];
    }

    if(empty($_POST['transAmt'])){
        $transAmt = 100;
    } else{
        $transAmt = $_POST['transAmt'];
    }

    if(empty($_POST['transStatus'])){
        $transStatus = 100;
    } else{
        $transStatus = $_POST['transStatus'];
    }


    require_once '../includes/TransactionDbOperation.php';

    $db = new TransactionDbOperation();

    //inserting values
    if($db->createTransaction($msfID, $transType,$transAmt, $transStatus)){
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