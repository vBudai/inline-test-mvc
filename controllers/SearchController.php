<?php

namespace controllers;

use base\BaseController;
use models\CommentModel;
use models\PostModel;
use views\SearchView;

class SearchController extends BaseController
{

    public function __construct()
    {
        $this->view = new SearchView();
    }


    // Вывод постов и комментариев по их тексту
    public function index(): void
    {
        if(!isset($_GET['body']) || strlen($_GET['body']) <= 3){
            $this->view->showSearchPage();
            return ;
        }

        $searchedCommentBody = urldecode($_GET['body']);

        // Поиск комментариев в БД
        $commentsModel = new CommentModel();
        $comments = $commentsModel->search(['postId', 'body'], 'body', $searchedCommentBody);
        if(!is_array($comments)){ // Если комментарии не были найдены
            $this->view->showSearchPage();
            return ;
        }

        /** Я решил объединить все комментарии по их постам, то есть в массив вида:
         * 0 => [
         *      ['id'] => "id поста",
         *      ['title'] => "",
         *      ['comments'] => [] (тут body всех комментариев)
         * ]
         * 1 => ...
         */

        // Считывание постов, к которым принадлежат комментарии
        $postsModel = new PostModel();
        $posts = [];
        $foundPosts = []; // Уже считанные посты
        $commentsSize = count($comments);

        for($i = 0; $i < $commentsSize; $i++) {
            // Был ли запрос в БД на пост с таким ID
            $postOrder = array_search($comments[$i]['postId'], $foundPosts);

            // Если пост с этим id не был считан, то он записывается в общий массив posts, иначе комментарий записывается в posts в ячейку комментариев
            if($postOrder === false){
                $post = $postsModel->select(['id', 'title'], ['id' => $comments[$i]['postId']]);
                $posts[] = [
                    'id' => $post[0]['id'],
                    'title' => $post[0]['title'],
                    'comments' => [
                        $comments[$i]['body']
                    ],
                ];
                $foundPosts[] = '' . $comments[$i]['postId'];
            }
            else
                $posts[$postOrder]['comments'][] = $comments[$i]['body'];
        }

        $this->view->showSearchPage($posts);

    }


}