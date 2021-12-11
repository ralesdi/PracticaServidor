<?php
class DirectMessage extends DataBaseModel{
    protected $sender;
    protected $receiver;
    protected $content;
    protected $sendingDateTime;

    public function __construct($sender="",$receiver="",$content="",$sendingDateTime=null)
    {
        $this->sender = strtolower( filter_var($sender,FILTER_SANITIZE_STRING) );
        $this->receiver = strtolower(  filter_var($receiver,FILTER_SANITIZE_STRING) );
        $this->content = filter_var($content,FILTER_SANITIZE_STRING);
        $this->sendingDateTime =  filter_var($sendingDateTime,FILTER_SANITIZE_STRING);
    }

    public function validSender(){
        return DataBaseModel::valid("/^[a-z0-9]{3,15}$/",$this->sender,"Sender error");
    }

    public function validReceiver(){
        return DataBaseModel::valid("/^[a-z0-9]{3,15}$/",$this->receiver,"Receiver error");
    }

    public function validContent(){
        return null;
    }

    public function validsendingDateTime(){
        return null;
    }

    
}
?>