<?php namespace App\Models\gps;

use CodeIgniter\Model;

class gpsmtr extends Model {
    
    protected $table      = 'gpsmtr';
    protected $primaryKey = 'gps_id';
    
    protected $returnType = 'array';
    protected $allowedFields = ['name','description','active','apikey','apisecret','createdt','createby','modifydt','modifyby'];
    
    protected $useTimestamps = false;
    protected $createdField  = 'createddt';
    protected $updatedField  = 'updateddt';
    
    protected $useSoftDeletes = false;
    protected $deletedField  = '';
    
    protected $validationRules    = [
        'name'     => 'required',
        'active'        => 'required',
        'apikey'        => 'required',
        'apisecret'        => 'required'
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    public $tb_columns = array(
        "tb_name" => "gpsmtr",
        "primary_key" => "gps_id",
        "auto_increment" => "Y",
        "columns" => array(
            "gps_id" => array("type"=>"int", "size"=>"10", "allow_null"=>"N", "allow_edit" => "N"), 
            "name" => array("type"=>"string", "size"=>"255", "allow_null"=>"N", "allow_edit" => "Y"),   
            "description" => array("type"=>"string", "size"=>"500", "allow_null"=>"Y", "allow_edit" => "Y"), 
            "active" => array("type"=>"checkbox", "size"=>null, "allow_null"=>"Y", "allow_edit" => "Y" ,"value" => "Y"),
            "apikey" => array("type"=>"string", "size"=>"255", "allow_null"=>"N", "allow_edit" => "Y"), 
            "apisecret" => array("type"=>"string", "size"=>"255", "allow_null"=>"N", "allow_edit" => "Y"),   
            
            "createdt" => array("type"=>"datetime", "size"=>null, "allow_null"=>"N", "allow_edit" => "N"),
            "createby" => array("type"=>"string", "size"=>"50", "allow_null"=>"N", "allow_edit" => "N"),
            "modifydt" => array("type"=>"datetime", "size"=>"5", "allow_null"=>"Y", "allow_edit" => "N"),
            "modifyby" => array("type"=>"string", "size"=>"5", "allow_null"=>"Y", "allow_edit" => "N"),
        )
    );
}


