<?php
/**
 * Created by PhpStorm.
 * User: jornevanhelvert
 * Date: 18/09/2018
 * Time: 11:41
 */

namespace App\Model;

interface MessageModel
{
    public function getAllMessages();
    public function getMessageById($id);
    public function getMessageByPartialContent($keywords);
    public function upvoteMessageByMessageId($messageId);
    public function downvoteMessageByMessageId($messageId);
    public function getMessageByCategory($keywords);
    public function getMessageByPartialContentAndCategory($keywords, $id);
    public function postMessage($parameters);
    public function getMessageByUser($user);
}
