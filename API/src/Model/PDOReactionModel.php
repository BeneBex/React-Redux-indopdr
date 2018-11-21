<?php

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

    public function getReactionById($messageId)
        {
            $pdo = $this->connection->getPdo();

            $statement = $pdo->prepare('SELECT * FROM reactions WHERE MessageID=:id');
            $statement->bindParam(':id', $messageId, \PDO::PARAM_INT);

            $statement->execute();
            $reaction = null;

            $databaseData = $statement->fetchAll();
            for ($i = 0; $i < count($databaseData); $i++) {
                        $reaction = $databaseData[$i];

                        if ($reaction !== null) {
                            $reactions[] = ['Id' => $reaction[0], 'MessageId' => $reaction[1], 'Content' => $reaction[2]];
                        }
            }

            return $reactions;
        }
}