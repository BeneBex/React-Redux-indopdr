<?php

namespace App\Controller;

use App\Model\MessageModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    private $messageModel;

    public function __construct(MessageModel $messageModel)
    {
        $this->messageModel = $messageModel;
    }

    /**
     * @Route("/messages", methods={"GET"}, name="getAllMessages")
     */
    public function getAll()
    {
        $statuscode = 200;
        $messages[] = null;

        try {
            $messages = $this->messageModel->getAllMessages();

            if ($messages === null) {
                $statuscode = 404;
            }
        } catch (\InvalidArgumentException $exception) {
            $statuscode = 400;
        } catch (\PDOException $exception) {
            $statuscode = 500;
        }

        return new JsonResponse($messages, $statuscode);
    }

    /**
     * @Route("/message/{id}", methods={"GET"}, name="getMessageById")
     */
    public function getById($id)
    {
        $statuscode = 200;
        $message = null;

        try {
            $message = $this->messageModel->getMessageById($id);

            if ($message === null) {
                $statuscode = 404;
            }
        } catch (\InvalidArgumentException $exception) {
            $statuscode = 400;
        } catch (\PDOException $exception) {
            $statuscode = 500;
        }

        return new JsonResponse($message, $statuscode);
    }

    /**
     * @Route("/message/category/{keywords}", methods={"GET"}, name="getMessageByCategory")
     */
    public function getByCategory($keywords){
        $statuscode = 200;
        $message = null;

        try {
            $message = $this->messageModel->getMessageByCategory($keywords);

            if ($message === null) {
                $statuscode = 404;
            }
        } catch (\InvalidArgumentException $exception) {
            $statuscode = 400;
        } catch (\PDOException $exception) {
            $statuscode = 500;
        }

        return new JsonResponse($message, $statuscode);
    }

    /**
     * @Route("/message/content/{keywords}", methods={"GET"}, name="getMessageByPartialContent")
     */
    public function getByPartialContent($keywords)
    {
        $statuscode = 200;
        $message = null;

        try {
            $message = $this->messageModel->getMessageByPartialContent($keywords);

            if ($message === null) {
                $statuscode = 404;
            }
        } catch (\InvalidArgumentException $exception) {
            $statuscode = 400;
        } catch (\PDOException $exception) {
            $statuscode = 500;
        }

        return new JsonResponse($message, $statuscode);
    }

    /**
     * @Route("/message/user/{user}", methods={"GET"}, name="getMessageByUser")
     */
    public function getByUser($user){
        $statuscode = 200;
        $message = null;

        try {
            $message = $this->messageModel->getMessageByUser($user);
            if ($message === null) {
                $statuscode = 404;
            }
        } catch (\InvalidArgumentException $exception) {
            $statuscode = 400;
        } catch (\PDOException $exception) {
            $statuscode = 500;
        }

        return new JsonResponse($message, $statuscode);
    }

    /**
     * @Route("/message/content/{keywords}/category/{id}", methods={"GET"}, name="getMessageByPartialContentAndCategoryId")
     */
    public function getByPartialContentAndCategory($keywords, $id)
    {
        $statuscode = 200;
        $message = null;

        try {
            $message = $this->messageModel->getMessageByPartialContentAndCategory($keywords, $id);

            if ($message === null) {
                $statuscode = 404;
            }
        } catch (\InvalidArgumentException $exception) {
            $statuscode = 400;
        } catch (\PDOException $exception) {
            $statuscode = 500;
        }

        return new JsonResponse($message, $statuscode);
    }

    /**
     * @Route("/message/{id}/upvote", methods={"POST"}, name="upvoteMessageById")
     */
    public function upvoteMessage($id)
    {
        $statuscode = 200;
        $message = null;

        try {
            $message = $this->messageModel->upvoteMessageByMessageId($id);
        } catch (\InvalidArgumentException $exception) {
            $statuscode = 400;
        } catch (\PDOException $exception) {
            $statuscode = 500;
        }

        return new JsonResponse($message, $statuscode);
    }

    /**
     * @Route("/message/{id}/downvote", methods={"POST"}, name="downvoteMessageById")
     */
    public function downvoteMessage($id)
    {
        $statuscode = 200;
        $message = null;

        try {
            $message = $this->messageModel->downvoteMessageByMessageId($id);
        } catch (\InvalidArgumentException $exception) {
            $statuscode = 400;
        } catch (\PDOException $exception) {
            $statuscode = 500;
        }

        return new JsonResponse($message, $statuscode);
    }

    /**
     * @Route("/newMessage", methods={"POST"}, name="postMessage")
     */
    public function postMessage(Request $request){

        $statuscode = 200;
        $message=null;
        $parameters = json_decode($request->getContent(), true);
        try {
            $message=$this->messageModel->postMessage($parameters);
            if ($message === null) {
                $statuscode = 404;
            }
        } catch (\InvalidArgumentException $exception) {
            $statuscode = 400;
        } catch (\PDOException $exception) {
            $statuscode = 500;
            var_dump($exception);
        }

        return new JsonResponse($message, $statuscode);
    }
}
