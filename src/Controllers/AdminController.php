<?php

namespace App\Controllers;

use Core\Controller;

/**
* 
*/
class AdminController extends Controller
{
    /**
    * 
    */
    public function index($request, $response)
    {
        return $this->view->render($response, 'admin/home.twig');
    }
}