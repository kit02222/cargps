<?php namespace App\Models\config;

use CodeIgniter\Model;

class homemtr extends Model {
    
    protected $table      = 'homemtr';
    protected $primaryKey = 'home_id';
    
    protected $returnType = 'array';
    protected $allowedFields = ['name','description','createdt','createby','modifydt','modifyby'];
    
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
        "tb_name" => "homemtr",
        "primary_key" => "home_id",
        "auto_increment" => "Y",
        "columns" => array(
            "home_id" => array("type"=>"int", "size"=>"5", "allow_null"=>"N", "allow_edit" => "N"),
            "name" => array("type"=>"string", "size"=>"255", "allow_null"=>"N", "allow_edit" => "Y"),
            "description" => array("type"=>"string", "size"=>"500", "allow_null"=>"Y", "allow_edit" => "Y"),
            "createdt" => array("type"=>"datetime", "size"=>null, "allow_null"=>"N", "allow_edit" => "N"),
            "createby" => array("type"=>"string", "size"=>"50", "allow_null"=>"N", "allow_edit" => "N"),
            "modifydt" => array("type"=>"datetime", "size"=>"5", "allow_null"=>"Y", "allow_edit" => "N"),
            "modifyby" => array("type"=>"string", "size"=>"5", "allow_null"=>"Y", "allow_edit" => "N"),
        )
    );
}

