<?php 

namespace Ecommerce;
use Rain\Tpl;


class Page{

    private $tpl;
    private $options = [];
    private $defaults = [
        'data' => []
    ];

    public function __construct($opts = array() , $tpl_dir = "/views/") // get header data
    {
        // Configurações padrão
        // Config RainTPL      
        $config = array(
            "tpl_dir"       => $_SERVER['DOCUMENT_ROOT'].$tpl_dir,
            "cache_dir"     => $_SERVER['DOCUMENT_ROOT']."/views-cache/",
            "debug"         => false // set to false to improve the speed
           );
           
        Tpl::configure( $config );

        // create the Tpl object
        $this->tpl = new Tpl;
        
        
        
        $this->options = array_merge($this->defaults ,  $opts);  // Se houver opts prevalece
        $this->setData($this->options['data']);   //função para pegar as variaves - linha 51

        $this->tpl->draw('header');
        

    }


    public function setTpl($name, $data = array(), $returnHtml = false)
    {
        // Setar o conteudo do Body.
        $this->setData($data);     //Metodo para pegar as variaves - linha 51

        return $this->tpl->draw($name, $returnHtml);   
    }

    
    private function setData($data = array()) // Get page data
    {
        // Pegar as variaveis vinda do Index via rota
        foreach ($this->options['data'] as $key => $value) {
            $this->tpl->assign($key, $value);
         }
    }

    public function __destruct(){
        $this->tpl->draw('footer'); // get footer data
    }
}