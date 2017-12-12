<?php
/**
 * Created by PhpStorm.
 * User: atom1
 * Date: 7/23/17
 * Time: 5:21 PM
 */

$response = array();

$stackName = $stackGoal = $stackCurrent = "";

if($_SERVER['REQUEST_METHOD']=='POST'){

    //getting values


    if(empty($_POST['stackName'])){
        $stackName = "ANTDefault";
    } else{
        $stackName = $_POST['stackName'];
    }

    if(empty($_POST['stackGoal'])){
        $stackGoal = 1000;
    } else{
        $stackGoal = $_POST['stackGoal'];
    }

    if(empty($_POST['stackCurrent'])){
        $stackCurrent = 1;
    } else{
        $stackCurrent = $_POST['stackCurrent'];
    }

    require_once '../includes/StackDbOperation.php';

    $db = new StackDbOperation();

    //inserting values
    if($db->createStack($stackName,$stackGoal,$stackCurrent)){
        $response['error']=false;
        $response['message'] = 'Stack added successfully';
    } else{
        $response['error'] = true;
        $response['message'] = 'Could not add stack';
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