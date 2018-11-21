<?php

namespace App\Model;

interface ReactionModel
{
    public function placeReaction($parameters);
    public function getReactionById($messageId);
}

