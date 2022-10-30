<?php namespace App\Models\gps;

use CodeIgniter\Model;

class gpsevent extends Model {
    
    protected $table      = 'gpsevent';
    protected $primaryKey = 'event_id';
    
    protected $returnType = 'array';
    protected $allowedFields = ['event_id','gps_id','type','data','createdt','createby'];
    
    protected $useTimestamps = false;
    protected $createdField  = 'createddt';
    protected $updatedField  = 'updateddt';
    
    protected $useSoftDeletes = false;
    protected $deletedField  = '';
    
    protected $validationRules    = [
        'type'     => 'required',
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    public $tb_columns = array(
        "tb_name" => "gpsevent",
        "primary_key" => "event_id",
        "auto_increment" => "N",
        "columns" => array(
            "event_id" => array("type"=>"string", "size"=>"255", "allow_null"=>"N", "allow_edit" => "Y"), 
            "gps_id" => array("type"=>"select","allow_null"=>"N", "allow_edit" => "Y","key" =>"gps_id_q", "tablename" => "gpsmtr"),
            "type" => array("type"=>"string", "size"=>"50", "allow_null"=>"N", "allow_edit" => "Y"),   
            "data" => array("type"=>"string", "size"=>"500", "allow_null"=>"Y", "allow_edit" => "Y"), 

            "createdt" => array("type"=>"datetime", "size"=>null, "allow_null"=>"N", "allow_edit" => "N"),
            "createby" => array("type"=>"string", "size"=>"50", "allow_null"=>"N", "allow_edit" => "N"),
        )
    );
    
}


