<?php namespace App\Models\config;

use CodeIgniter\Model;

class usrmtr extends Model {
    
    protected $table      = 'usrmtr';
    protected $primaryKey = 'usr_id';
    
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
        "tb_name" => "usrmtr",
        "primary_key" => "usr_id",
        "auto_increment" => "N",
        "columns" => array(
            "usr_id" => array("type"=>"string", "size"=>"255", "allow_null"=>"N", "allow_edit" => "Y"),
            "name" => array("type"=>"string", "size"=>"255", "allow_null"=>"N", "allow_edit" => "Y"),
            "description" => array("type"=>"string", "size"=>"500", "allow_null"=>"Y", "allow_edit" => "Y"),
            "lastlogin" => array("type"=>"datetime", "size"=>null, "allow_null"=>"Y", "allow_edit" => "N"),
            "createdt" => array("type"=>"datetime", "size"=>null, "allow_null"=>"N", "allow_edit" => "N"),
            "createby" => array("type"=>"string", "size"=>"50", "allow_null"=>"N", "allow_edit" => "N"),
            "modifydt" => array("type"=>"datetime", "size"=>null, "allow_null"=>"Y", "allow_edit" => "N"),
            "modifyby" => array("type"=>"string", "size"=>"5", "allow_null"=>"Y", "allow_edit" => "N"),
        )
    );
}

