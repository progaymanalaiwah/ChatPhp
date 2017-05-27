<?php namespace App\classes;

class chatRoom
{
    private $NameChatRoom;
    private $con;
    private $CheckNameRoom;
    public function __construct($NameChatRoom)
    {
        global $con;
        $this->NameChatRoom  = $this->filterNameRoom($NameChatRoom);
        $this->con           = $con;
        $this->checkNameRoom = $this->checkNameRoom();
        


    }

    /*
     * Function Filter Variable NameChatRoom Of 
     * Sql Injection And Other Dangers
    */
    private function filterNameRoom($NameChatRoom)
    {
        $NameChatRoom = htmlspecialchars($NameChatRoom);
        return $NameChatRoom;
    }

    /*
      * Function Check Name Room Of Database Or Not
     */
    public function checkNameRoom()
    {
        $_date         = date("Ymdhis");
        $result = $this->con->CheckOnData('nameRoom','chatRoom',$this->NameChatRoom);
        if ($result){

            $stmt  = $this->con->pdo->prepare("UPDATE chatRoom SET _date= ? WHERE nameRoom = ?");
            $stmt->execute(array($_date,$this->NameChatRoom));
        }
        return $result;
    }

    public function addChatRoom()
    {
        $_date         = date("Ymdhis");
        $this->con->Insert("chatRoom","nameRoom,_date","?,?",[$this->NameChatRoom,$_date]);
    }

    public function selectRoomID($NameRoom)
    {
        $nameRoom = $this->con->Select("roomID","chatRoom","","OBJ","nameRoom = ?",[$NameRoom]);
        return $nameRoom->roomID;
    }
}