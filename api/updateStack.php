<?php
/**
 * Created by PhpStorm.
 * User: atom1
 * Date: 10/28/17
 * Time: 1:30 PM
 */

$response = array();

$stackID = $amount =  "";

if($_SERVER['REQUEST_METHOD']=='POST'){

    //getting values


    if(empty($_POST['stackID'])){
        $stackID = 1111;
    } else{
        $stackID = $_POST['stackID'];
    }

    if(empty($_POST['amount'])){
        $amount = 50;
    } else{
        $amount = $_POST['amount'];
    }

    /*if(empty($_POST['stackCurrent'])){
        $stackCurrent = 1;
    } else{
        $stackCurrent = $_POST['stackCurrent'];
    }*/

    require_once '../includes/StackDbOperation.php';

    $db = new StackDbOperation();

    //updating values
    if($db->updateStack($stackID,$amount)){
        $response['error']=false;
        $response['message'] = 'Stack updated successfully';
    } else{
        $response['error'] = true;
        $response['message'] = 'Could not update stack';
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