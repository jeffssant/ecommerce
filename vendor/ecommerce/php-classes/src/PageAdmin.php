<?php 

namespace Ecommerce;
use Rain\Tpl;


class PageAdmin extends Page{
    public function __construct($opts = array(), $tpl_dir = "/views/admin/")
    {
        parent::__construct($opts, $tpl_dir); // Herda o metodo construct da classe Page
    }
    
}