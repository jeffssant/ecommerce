<?php 

namespace Ecommerce\Model ;

use Ecommerce\DB\Sql ;
use Ecommerce\Model ;
use \Ecommerce\Mailer;



class Category extends Model{ 

    public static function listAll()
    {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_categories ORDER BY descategory");
    }

    public function save()
    {
        $sql = new Sql();

		$results = $sql->select("CALL sp_categories_save(:idcategory, :descategory)", array(
			":idcategory"=>$this->getidcategory(),
			":descategory"=>$this->getdescategory(),			
		));

		$this->setData($results[0]);

    }

    public function get($idcategoty)
    {
        $sql = new Sql();
        $results =  $sql->select("SELECT * FROM tb_categories WHERE idcategory = :idcategory ORDER BY descategory",[
            ":idcategory"=>$idcategoty,
        ]);

        $this->setData($results[0]);
    }

    public function delete() 
    {
        $sql = new Sql();
        $sql->query("DELETE FROM tb_categories WHERE idcategory = :idcategory",[
            ":idcategory"=>$this->getidcategory(),
        ]);
    }
    
}