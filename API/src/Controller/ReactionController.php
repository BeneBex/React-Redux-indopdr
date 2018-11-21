<?php
namespace App\Controller;

use App\Model\ReactionModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ReactionController extends AbstractController
{
    private $reactionModel;
    public function __construct(ReactionModel $reactionModel)
    {
        $this->reactionModel = $reactionModel;
    }
    /**
     * @Route("/reaction", methods={"POST"}, name="placeReactionOnMessageId")
     */
    public function placeReactionOnMessageId(Request $request)
    {
        $statuscode = 200;
        $token = null;
        $parameters = json_decode($request->getContent(), true);
        try {
            $token = $this->reactionModel->placeReaction($parameters);
        } catch (\InvalidArgumentException $exception) {
            $statuscode = 400;
        } catch (\PDOException $exception) {
            $statuscode = 500;
            var_dump($exception);
        }
        return new JsonResponse($token, $statuscode);
    }

     /**
         * @Route("/reaction/{id}", methods={"GET"}, name="getReactionById")
         */
        public function getReactionById(int $id)
        {
            $statuscode = 200;
            $reactions[] = null;

            try {
                        $reactions = $this->reactionModel->getReactionById($id);

                        if ($reactions === null) {
                            $statuscode = 404;
                        }
                    } catch (\InvalidArgumentException $exception) {
                        $statuscode = 400;
                    } catch (\PDOException $exception) {
                        $statuscode = 500;
                    }

            return new JsonResponse($reactions, $statuscode);
        }
}