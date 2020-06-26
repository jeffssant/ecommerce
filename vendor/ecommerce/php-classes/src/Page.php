<?php 

namespace Ecommerce;
use Rain\Tpl;


class Page{

    private $tpl;
    private $options = [];
    private $defaults = [
        'data' => []
    ];

    public function __construct($opts = array()) // get header data
    {

        $this->options = array_merge($this->defaults ,  $opts);        

        // Config RainTPL
        $config = array(
            "tpl_dir"       => $_SERVER['DOCUMENT_ROOT']."/ecommerce/views/",
            "cache_dir"     => $_SERVER['DOCUMENT_ROOT']."/ecommerce/views-cache/",
            "debug"         => false // set to false to improve the speed
           );

        Tpl::configure( $config );

        // create the Tpl object
        $this->tpl = new Tpl;
        
        

        $this->setData($this->options['data']);        

        $this->tpl->draw('header');
        

    }



    public function setTpl($name, $data = array(), $returnHtml = false)
    {
        $this->setData($data);     

        return $this->tpl->draw($name, $returnHtml);   
    }

    
    private function setData($data = array()) // Get page data
    {
        foreach ($this->options['data'] as $key => $value) {
            $this->tpl->assign($key, $value);
         }
    }

    public function __destruct(){
        $this->tpl->draw('footer'); // get footer data
    }
}