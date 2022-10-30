<?php namespace App\Models\config;

use CodeIgniter\Model;

class globalvaluemtr extends Model {
    
    protected $table      = 'globalvalue';
    protected $primaryKey = 'g_id';
    
    protected $returnType = 'array';
    protected $allowedFields = ['name','description','typefor','code','code_value','createdt','createby','modifydt','modifyby'];
    
    protected $useTimestamps = false;
    protected $createdField  = 'createddt';
    protected $updatedField  = 'updateddt';
    
    protected $useSoftDeletes = false;
    protected $deletedField  = '';
    
    protected $validationRules    = [
        'name'     => 'required',
       
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    public $tb_columns = array(
        "tb_name" => "globalvalue",
        "primary_key" => "g_id",
        "auto_increment" => "Y",
        "columns" => array(
            "g_id" => array("type"=>"int", "size"=>"3", "allow_null"=>"N", "allow_edit" => "N"),
            "name" => array("type"=>"string", "size"=>"255", "allow_null"=>"N", "allow_edit" => "Y"),
            "description" => array("type"=>"string", "size"=>"500", "allow_null"=>"Y", "allow_edit" => "Y"),
            "typefor" => array("type"=>"string", "size"=>"50", "allow_null"=>"Y", "allow_edit" => "Y"),
            "code" => array("type"=>"string", "size"=>"255", "allow_null"=>"N", "allow_edit" => "Y"),
            "code_value" => array("type"=>"string", "size"=>"500", "allow_null"=>"N", "allow_edit" => "Y"),
            "createdt" => array("type"=>"datetime", "size"=>null, "allow_null"=>"N", "allow_edit" => "N"),
            "createby" => array("type"=>"string", "size"=>"50", "allow_null"=>"N", "allow_edit" => "N"),
            "modifydt" => array("type"=>"datetime", "size"=>"5", "allow_null"=>"Y", "allow_edit" => "N"),
            "modifyby" => array("type"=>"string", "size"=>"5", "allow_null"=>"Y", "allow_edit" => "N"),
        )
    );
}
