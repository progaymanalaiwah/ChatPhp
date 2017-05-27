<?php 
session_start();
use App\classes\chatRoom;

require("config.php");
require($class."class.Message.php");
require($class."class.ChatRoom.php");

$type = $_POST['type'];
$chatRoom  = new chatRoom($_POST['roomName']); 


if($type === "sendMessage")
{    
    $message = new Message($_SESSION[$_POST['roomName']],$_POST['roomName'],$_SESSION[$_POST['roomName'].'NumberRow']);    
    echo $message->sendMessage($_POST['message']) . $message->messgesMe();
 
}
elseif($type === "addUser")
{

    if(!$chatRoom->checkNameRoom())
    {
        $chatRoom->addChatRoom();
    }
    
    # Array COntent Color Users
    $colorList = array("#F0D879","#119780","#F79D2D","#1F6ED4","#C2390D","#16335F","#EFA7A7","#8AE1FC","#FFF4C5","#600473","#037365","#F06966","#FAD6A6","#00A6ED");
    $Username  = $_POST['Username'];
    $roomID    = $chatRoom->selectRoomID($_POST['roomName']); # Return Room ID 
    $index     = rand(0,count($colorList) - 1);
    $Color     = $colorList[$index];
    $date      = date("Ymdhis");

    $con->Insert("users","userName,_date,color,roomID","?,?,?,?",[$Username,$date,$Color,$roomID]);
    $userID = end($con->Select("userID","users",1,"OBJ","username = ?",[$Username]));
    $_SESSION[$_POST['roomName']] = [
                                        "userID"    =>$userID->userID,
                                        "Username"  =>$Username,
                                        "Color"     =>$Color,
                                        "roomID"    =>$roomID,
                                        "_date"     =>$date
                                    ];
    $_SESSION[$_POST['roomName'].'NumberRow'] = 0; 

    }
elseif ($type == "showMessages")
{
    $message = new Message($_SESSION[$_POST['roomName']],$_POST['roomName'],$_SESSION[$_POST['roomName'].'NumberRow']);    
    echo $message->showMessages();
    
}