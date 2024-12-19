<?php
class MessageController
{
    private $messageModel;

    public function __construct($messageModel)
    {
        $this->messageModel = $messageModel;
    }

    public function afficherMessages()
    {
        $messages = $this->messageModel->getMessages();
        include 'app/views/messages/list.php';
    }
}
