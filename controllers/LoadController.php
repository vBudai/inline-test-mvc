<?php

namespace controllers;

use base\BaseController;
use models\CommentModel;
use models\PostModel;
use views\LoadView;

class LoadController extends BaseController
{

    private const API = 'https://jsonplaceholder.typicode.com';
    private const COMMENTS_METHOD = '/comments';
    private const POSTS_METHOD = '/posts';

    public function __construct()
    {
        $this->view = new LoadView();
    }

    // Загрузка постов и комментариев
    public function index(): void
    {
        // Получение постов с API
        $link = self::API . self::POSTS_METHOD;
        $posts = $this->getDataFromApi($link);
        $postsCount = count($posts);

        $i = null;

        // Загрузка постов в БД
        $postModel = new PostModel();
        for($i = 0; $i < $postsCount; ++$i)
            $postModel->insert($posts[$i]);
        $loadedPostsCount = $i;


        // Получение комментариев с API
        $link = self::API. self::COMMENTS_METHOD;
        $comments = $this->getDataFromApi($link);
        $commentsCount = count($comments);

        // Загрузка комментариев в БД
        $commentsModel = new CommentModel();
        for($i = 0; $i < $commentsCount; ++$i)
            $commentsModel->insert($comments[$i]);
        $loadedCommentsCount = $i;

        // Вывод сообщения
        $message = "Загружено $loadedPostsCount постов и $loadedCommentsCount комментариев";
        $this->view->echo($message);
    }

    private function getDataFromApi(string $link)
    {
        if(!$link)
            return null;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $link);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

}