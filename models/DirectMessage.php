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

    

    /**
     * Get the value of sender
     */ 
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set the value of sender
     *
     * @return  self
     */ 
    public function setSender($sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get the value of receiver
     */ 
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set the value of receiver
     *
     * @return  self
     */ 
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of sendingDateTime
     */ 
    public function getSendingDateTime()
    {
        return $this->sendingDateTime;
    }

    /**
     * Set the value of sendingDateTime
     *
     * @return  self
     */ 
    public function setSendingDateTime($sendingDateTime)
    {
        $this->sendingDateTime = $sendingDateTime;

        return $this;
    }
}
?>