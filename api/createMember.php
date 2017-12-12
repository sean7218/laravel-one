<?php
/**
 * Created by PhpStorm.
 * User: atom1
 * Date: 7/19/17
 * Time: 11:27 AM
 */

$response = array();

$memName = $memEmail = $memPhone = "";

if($_SERVER['REQUEST_METHOD']=='POST'){

    //getting values


    if(empty($_POST['name'])){
        $memName = "ANTDefault";
    } else{
        $memName = $_POST['name'];
    }

    if(empty($_POST['name'])){
        $memEmail = "AntDefault";
    } else{
        $memEmail = $_POST['email'];
    }

    if(empty($_POST['name'])){
        $memPhone = 5555555;
    } else{
        $memPhone = $_POST['phone'];
    }

    require_once '../includes/MemberDbOperation.php';

    $db = new MemberDbOperation();

    //inserting values
    if($db->createMember($memName,$memPhone,$memEmail)){
        $response['error']=false;
        $response['message'] = 'Member added successfully';
    } else{
        $response['error'] = true;
        $response['message'] = 'Could not add member';
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