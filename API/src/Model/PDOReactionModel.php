<?php
/**
 * Created by PhpStorm.
 * User: jornevanhelvert
 * Date: 20/09/2018
 * Time: 12:11
 */

namespace App\Model;

use http\Exception\InvalidArgumentException;
use Respect\Validation\Validator as v;

class PDOReactionModel implements ReactionModel
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function placeReaction($parameters)
    {
        $pdo = $this->connection->getPdo();

        $reaction = $parameters['reaction'];
        if(!v::stringType()->notEmpty()->validate($reaction)){
            throw new InvalidArgumentException();
        };
        $messageId = $parameters['messageId'];
        if(!v::digit()->notEmpty()->validate($messageId)){
            throw new InvalidArgumentException();
        };

        $statement = $pdo->prepare('INSERT INTO reactions (MessageID, Content) VALUES (?, ?)');
        $statement->bindValue(1, $messageId, \PDO::PARAM_INT);
        $statement->bindValue(2, $reaction, \PDO::PARAM_STR);

        $statement->execute();

        return bin2hex($reaction.$messageId);
    }
}