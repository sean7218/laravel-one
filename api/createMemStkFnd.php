<?php
/**
 * Created by PhpStorm.
 * User: atom1
 * Date: 8/21/17
 * Time: 6:55 PM
 */

$response = array();

$memID = $stackID = $fndSrcID = $memStatus = "";

if($_SERVER['REQUEST_METHOD']=='POST'){

    //getting values


    if(empty($_POST['memID'])){
        $memID = 100;
    } else{
        $memID = $_POST['memID'];
    }

    if(empty($_POST['stackID'])){
        $stackID = 100;
    } else{
        $stackID = $_POST['stackID'];
    }

    if(empty($_POST['fndSrcID'])){
        $fndSrcID = 100;
    } else{
        $fndSrcID = $_POST['fndSrcID'];
    }

    if(empty($_POST['memStatus'])){
        $memStatus = 100;
    } else{
        $memStatus = $_POST['memStatus'];
    }


    require_once '../includes/MemStkFndDbOperation.php';

    $db = new MemStkFndDbOperation();

    //inserting values
    if($db->createMemStkFnd($memID, $stackID,$fndSrcID, $memStatus)){
        $response['error']=false;
        $response['message'] = 'MemStkFnd added successfully';
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