<?php

namespace App\Controller\Admin;

use \App\Utils\View;

class Index {
        
    public static function getindex($title, $content){
        return View::render('admin/index', [
            'title' => $title,
            'content' => $content
        ]);
    }

}