<?php namespace App\Models\config;

use CodeIgniter\Model;

class menumtr extends Model {
    
    protected $table      = 'menumtr';
    protected $primaryKey = 'menu_id';
    
    protected $returnType = 'array';
    protected $allowedFields = ['sub_menu_id','sequence','name','description','menu_style','createdt','createby','modifydt','modifyby'];
    
    protected $useTimestamps = false;
    protected $createdField  = 'createddt';
    protected $updatedField  = 'updateddt';
    
    protected $useSoftDeletes = false;
    protected $deletedField  = '';
    
    protected $validationRules    = [
        'sub_menu_id'     => 'required',
        'sequence'        => 'required',
        'name'        => 'required',
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    public $tb_columns = array(
        "tb_name" => "menumtr",
        "primary_key" => "menu_id",
        "auto_increment" => "Y",
        "columns" => array(
            "menu_id" => array("type"=>"int", "size"=>"5", "allow_null"=>"N", "allow_edit" => "N"),
            "sub_menu_id" => array("type"=>"int", "size"=>"5", "allow_null"=>"Y", "allow_edit" => "Y"),
            "sequence" => array("type"=>"int", "size"=>"5", "allow_null"=>"N", "allow_edit" => "Y"),
            "name" => array("type"=>"string", "size"=>"255", "allow_null"=>"N", "allow_edit" => "Y"),
            "description" => array("type"=>"string", "size"=>"255", "allow_null"=>"Y", "allow_edit" => "Y","allow_spec"=>"Y"),
            "menu_style" => array("type"=>"string", "size"=>"255", "allow_null"=>"Y", "allow_edit" => "Y"),
            "createdt" => array("type"=>"datetime", "size"=>null, "allow_null"=>"N", "allow_edit" => "N"),
            "createby" => array("type"=>"string", "size"=>"50", "allow_null"=>"N", "allow_edit" => "N"),
            "modifydt" => array("type"=>"datetime", "size"=>"5", "allow_null"=>"Y", "allow_edit" => "N"),
            "modifyby" => array("type"=>"string", "size"=>"5", "allow_null"=>"Y", "allow_edit" => "N"),
        )
    );
}


