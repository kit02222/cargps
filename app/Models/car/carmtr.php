<?php namespace App\Models\car;

use CodeIgniter\Model;

class carmtr extends Model {
    
    protected $table      = 'carmtr';
    protected $primaryKey = 'car_id';
    
    protected $returnType = 'array';
    protected $allowedFields = ['name', 'description','lisense_num','active','createdt','createby','modifydt','modifyby'];
    
    protected $useTimestamps = false;
    protected $createdField  = 'createddt';
    protected $updatedField  = 'updateddt';
    
    protected $useSoftDeletes = false;
    protected $deletedField  = '';
    
    protected $validationRules    = [
        'name'     => 'required',
        'lisense_num'        => 'required'
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    public $tb_columns = array(
        "tb_name" => "carmtr",
        "primary_key" => "car_id",
        "auto_increment" => "Y",
        "columns" => array(
            "car_id" => array("type"=>"int", "size"=>"10", "allow_null"=>"N", "allow_edit" => "N"), 
            "name" => array("type"=>"string", "size"=>"255", "allow_null"=>"N", "allow_edit" => "Y"),
            "description" => array("type"=>"string", "size"=>"500", "allow_null"=>"Y", "allow_edit" => "Y"), 
            "lisense_num" => array("type"=>"string", "size"=>"20", "allow_null"=>"N", "allow_edit" => "Y"), 
            "active" => array("type"=>"checkbox", "size"=>null, "allow_null"=>"Y", "allow_edit" => "Y" ,"value" => "Y"),
            
            "createdt" => array("type"=>"datetime", "size"=>null, "allow_null"=>"N", "allow_edit" => "N"),
            "createby" => array("type"=>"string", "size"=>"50", "allow_null"=>"N", "allow_edit" => "N"),
            "modifydt" => array("type"=>"datetime", "size"=>"5", "allow_null"=>"Y", "allow_edit" => "N"),
            "modifyby" => array("type"=>"string", "size"=>"5", "allow_null"=>"Y", "allow_edit" => "N"),
        )
    );
}


