<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\ArticleModel;

/**
* 
*/
class ArticleController extends Controller
{
    /**
    * 
    */
    public function getNewArticle($request, $response)
    {
        return $this->view->render($response, 'admin/article-new.twig');
    }

    /**
    * 
    */
    public function postNewArticle($request, $response)
    {
        $request = $request->getParsedBody();

        $this->validator->rule('required', ['title', 'content']);

        if ($this->validator->validate()) {
            $article = new ArticleModel;
            $article->title      = $request['title'];
            $article->content    = $request['content'];
            $article->save();

            return $response->withRedirect($this->router->pathFor('admin.article.list'));
        } else {
            $_SESSION['errors'] = $this->validator->errors();
            $_SESSION['old']    = $request;

            return $response->withRedirect($this->router->pathFor('admin.article.new'));
        }
    }

    /**
    * 
    */
    public static function getArticleList()
    {
        return ArticleModel::orderBy('id', 'DESC')->where('deleted', 0)->get();
    }

    /**
    * 
    */
    public function getArticleListAdmin($request, $response)
    {
        $article = self::getArticleList();

        return $this->view->render($response, 'admin/article-list.twig', ['article' => $article]);
    }

    /**
    * 
    */
    public function getEditArticle($request, $response, $args)
    {
        $article = ArticleModel::where('id', $args['id'])->first();

        return $this->view->render($response, 'admin/article-edit.twig', ['article' => $article]);
    }

    /**
    * 
    */
    public function postEditArticle($request, $response, $args)
    {
        $request = $request->getParsedBody();

        $this->validator->rule('required', ['title', 'content']);

        if ($this->validator->validate()) {
            $article = ArticleModel::where('id', $args['id'])->first();
            $article->title    = $request['title'];
            $article->content  = $request['content'];
            $article->update();

            return $response->withRedirect($this->router->pathFor('admin.article.list'));
        } else {
            $_SESSION['errors'] = $this->validator->errors();
            $_SESSION['old']    = $request;

            return $response->withRedirect($this->router->pathFor('admin.article.edit', ['id' => $args['id']]));
        }
    }

    /**
    * 
    */
    public function getArticleTrash($request, $response)
    {
        $data['trash'] = ArticleModel::orderBy('id', 'DESC')->where('deleted', 1)->get();

        return $this->view->render($response, 'admin/article-trash.twig', ['data' => $data]);
    }

    /**
    * 
    */
    public function setSoftDeleteArticle($request, $response, $args)
    {
        $article = ArticleModel::find($args['id']);
        $article->deleted = 1;
        $article->update();

        return $response->withRedirect($this->router->pathFor('admin.article.list'));
    }

    /**
    * 
    */
    public function setHardDeleteArticle($request, $response, $args)
    {
        $article = ArticleModel::find($args['id']);
        $article->delete();

        return $response->withRedirect($this->router->pathFor('admin.article.trash'));
    }

    /**
    * 
    */
    public function getArticleRestore($request, $response, $args)
    {
        $article = ArticleModel::find($args['id']);
        $article->deleted = 0;
        $article->update();

        return $response->withRedirect($this->router->pathFor('admin.article.trash'));
    }
}