<?php 
#session_destroy(); 
class Message
{
    private $msg;
    private $Username;
    private $Color;
    private $con;
    public function __construct($roomInfo,$roomName,$NumberRow)
    {
        global $con;
        $this->con       = $con; 
        $this->Username  = $roomInfo['Username']; 
        $this->Color     = $roomInfo['Color'];
        $this->roomID    = $roomInfo['roomID'];
        $this->userID    = $roomInfo['userID'];
        $this->NumberRow = $NumberRow;
        $this->_date     = $roomInfo['_date'];
        $this->roomName  = $roomName;
    }
 
    # Function Filter Messages
    private function filterMessge($msg)
    {

        $msg = htmlspecialchars($msg);
        return $msg;
    }

    # Function Show Messages Me
    public function messgesMe()
    {
        $message = 
        '
        <div class="msg">
            <span class="nameUser" style="color:'.$this->Color.'">'.$this->Username.'</span>
            <div class="msg-content">'. $this->msg.'</div>
            <div class="clear"></div>        
        </div>
        ';
        return $message;
    }

    # Function Send Messages And Insert Messages To Database
    public function sendMessage($msg)
    {   
        $this->msg      = $this->filterMessge($msg);
        $date = date("Ymdhis");
        $sendMsg = $this->con->Insert("messages","msg,_date,roomID,userID","?,?,?,?",array($this->msg,$date,$this->roomID,$this->userID));
        if (!$sendMsg)
            $this->msg  = "Not Send Messages";
    }

    public function showMessages()
    {        

       $stmt = $this->con->pdo->prepare("SELECT 
                                            messages.msg,messages.msgID,messages._date ,users.userName,users.color ,users.userID
                                          FROM 
                                            messages
                                          INNER JOIN chatRoom ON
                                          chatRoom.roomID =  messages.roomID                                         
                                          INNER JOIN users ON
                                          messages.userID = users.userID
                                          WHERE messages.msgID >  $this->NumberRow and messages.roomID = $this->roomID
                                        ");

        $stmt->execute(array($this->roomID));
        $msgInfo = $stmt->fetchAll(PDO::FETCH_OBJ);
        if ($msgInfo)
            $_SESSION[$this->roomName.'NumberRow'] =  end($this->con->Select("*","messages",1,"OBJ","msgID",[$this->roomID]))->msgID;

        $_SESSION[$this->roomName] = [
                                        "userID"    => $this->userID,
                                        "Username"  => $this->Username,
                                        "Color"     => $this->Color,
                                        "roomID"    => $this->roomID,
                                        "_date"     => $this->_date
                                    ];
        $message = "";
        foreach($msgInfo as $msg)
        {
            if($msg->userID != $this->userID && $msg->_date > $this->_date){
                $message.=
                '
                    <div class="msg">
                        <span class="nameUser" style="color:'.$msg->color.'">'.$msg->userName.'</span>
                        <div class="msg-content">'. $msg->msg.'</div>
                        <div class="clear"></div>        
                    </div>
                ';
            }
        }
        return $message;
    }
}