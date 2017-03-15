<?php

$homeController     = 'App\Controllers\HomeController:';
$articleController  = 'App\Controllers\ArticleController:';
$adminController    = 'App\Controllers\AdminController:';

$app->get('/', $homeController . 'index')->setName('home');

$app->get('/admin', $adminController . 'index')->setName('admin.home');

$app->get('/admin/article/new', $articleController . 'getNewArticle')->setName('admin.article.new');
$app->post('/admin/article/new', $articleController . 'postNewArticle');

$app->get('/admin/article/list', $articleController . 'getArticleListAdmin')->setName('admin.article.list');

$app->get('/admin/article/{id}/edit', $articleController . 'getEditArticle')->setName('admin.article.edit');
$app->post('/admin/article/{id}/edit', $articleController . 'postEditArticle');

$app->get('/admin/article/{id}/delete', $articleController . 'setSoftDeleteArticle');
$app->get('/admin/article/{id}/hard-delete', $articleController . 'setHardDeleteArticle');

$app->get('/admin/article/{id}/restore', $articleController . 'getArticleRestore')->setName('admin.article.restore');

$app->get('/admin/article/trash', $articleController . 'getArticleTrash')->setName('admin.article.trash');
