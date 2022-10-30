<?php namespace App\Models\config;

use CodeIgniter\Model;

class usrmenu extends Model {
    
    protected $table      = 'usrmenu';
    protected $primaryKey = 'usr_id';
    
    protected $returnType = 'array';
    protected $allowedFields = ['usr_id','menu_id', 'read','write','delete','createdt','createby','modifydt','modifyby'];
    
    protected $useTimestamps = false;
    protected $createdField  = 'createddt';
    protected $updatedField  = 'updateddt';
    
    protected $useSoftDeletes = false;
    protected $deletedField  = '';
    
    protected $validationRules    = [
        'usr_id'     => 'required',
        'menu_id'        => 'required'
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    public $tb_columns = array(
        "tb_name" => "usrmenu",
        "primary_key" => array("usr_id","menu_id"),
        "auto_increment" => "N",
        "columns" => array(
            "usr_id" => array("type"=>"select","allow_null"=>"N", "allow_edit" => "Y","key" => "user_id_q", "tablename" => "usrmtr"),
            "menu_id" => array("type"=>"select","allow_null"=>"N", "allow_edit" => "Y","key" =>"menu_id_q", "tablename" => "menumtr"),
            "usr_name" => array("type"=>"display"),
            "menu_name" => array("type"=>"display"),
            "read" => array("type"=>"checkbox", "size"=>null, "allow_null"=>"Y", "allow_edit" => "Y" ,"value" => "Y"),
            "write" => array("type"=>"checkbox", "size"=>null, "allow_null"=>"Y", "allow_edit" => "Y","value" => "Y"),
            "delete" => array("type"=>"checkbox", "size"=>null, "allow_null"=>"Y", "allow_edit" => "Y","value" => "Y"),
            "createdt" => array("type"=>"datetime", "size"=>null, "allow_null"=>"N", "allow_edit" => "N"),
            "createby" => array("type"=>"string", "size"=>"50", "allow_null"=>"N", "allow_edit" => "N"),
            "modifydt" => array("type"=>"datetime", "size"=>"5", "allow_null"=>"Y", "allow_edit" => "N"),
            "modifyby" => array("type"=>"string", "size"=>"5", "allow_null"=>"Y", "allow_edit" => "N"),
        )
    );
}


