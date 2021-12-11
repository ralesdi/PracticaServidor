<?php
class DirectMessage extends DataBaseModel{
    protected $sender;
    protected $receiver;
    protected $content;
    protected $sendingDate;

    public function __construct($sender=0,$receiver=0,$content="",$sendingDate=null)
    {
        $this->$sender = $sender;
        $this->receiver = $receiver;
        $this->content = $content;
        $this->sendingDate = $sendingDate;
    }

    public function validSender(){
        return DataBaseModel::valid("/\d{8}[A-Z]/",$this->sender,"Sender error");
    }

    public function validReceiver(){
        return DataBaseModel::valid("/\d{8}[A-Z]/",$this->receiver,"Receiver error");
    }

    public function validContent(){
        return null;
    }

    public function validSendingDate(){
        return null;
    }

    
}
?>