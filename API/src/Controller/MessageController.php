<?php

namespace App\Controller;

use App\Model\MessageModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/message/content/{keywords}/category/{name}", methods={"GET"}, name="getMessageByPartialContentAndCategoryId")
     */
    public function getByPartialContentAndCategoryId($keywords, $name)
    {
        $statuscode = 200;
        $message = null;

        try {
            $message = $this->messageModel->getMessageByPartialContentAndCategory($keywords, $name);

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
     * @Route("/message/category/{name}", methods={"GET"}, name="getMessageByCategory")
     */
    public function getByCategory($name)
    {
        $statuscode = 200;
        $message = null;

        try {
            $message = $this->messageModel->getMessageByCategory($name);

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
            $messages = $this->messageModel->upvoteMessageByMessageId($id);
        } catch (\InvalidArgumentException $exception) {
            $statuscode = 400;
        } catch (\PDOException $exception) {
            $statuscode = 500;
        }

        return new JsonResponse($messages, $statuscode);
    }

    /**
     * @Route("/message/{id}/downvote", methods={"POST"}, name="downvoteMessageById")
     */
    public function downvoteMessage($id)
    {
        $statuscode = 200;
        $message = null;

        try {
            $messages = $this->messageModel->downvoteMessageByMessageId($id);
        } catch (\InvalidArgumentException $exception) {
            $statuscode = 400;
        } catch (\PDOException $exception) {
            $statuscode = 500;
        }

        return new JsonResponse($messages, $statuscode);
    }
}
