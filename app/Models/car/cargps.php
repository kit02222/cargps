<?php namespace App\Models\car;

use CodeIgniter\Model;

class cargps extends Model {
    
    protected $table      = 'cargps';
    protected $primaryKey = 'car_id';
    
    protected $returnType = 'array';
    protected $allowedFields = ['car_id','gps_id', 'createdt','createby','modifydt','modifyby'];
    
    protected $useTimestamps = false;
    protected $createdField  = 'createddt';
    protected $updatedField  = 'updateddt';
    
    protected $useSoftDeletes = false;
    protected $deletedField  = '';
    
    protected $validationRules    = [
        'car_id'     => 'required',
        'gpsid'        => 'required'
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    public $tb_columns = array(
        "tb_name" => "cargps",
        "primary_key" => array("car_id","gps_id"),
        "auto_increment" => "N",
        "columns" => array(
            "car_id" => array("type"=>"select","allow_null"=>"N", "allow_edit" => "Y","key" => "car_id_q", "tablename" => "carmtr"),
            "gps_id" => array("type"=>"select","allow_null"=>"N", "allow_edit" => "Y","key" =>"gps_id_q", "tablename" => "gpsmtr"),
            "car_name" => array("type"=>"display"),
            "gps_name" => array("type"=>"display"),
            "createdt" => array("type"=>"datetime", "size"=>null, "allow_null"=>"N", "allow_edit" => "N"),
            "createby" => array("type"=>"string", "size"=>"50", "allow_null"=>"N", "allow_edit" => "N"),
            "modifydt" => array("type"=>"datetime", "size"=>"5", "allow_null"=>"Y", "allow_edit" => "N"),
            "modifyby" => array("type"=>"string", "size"=>"5", "allow_null"=>"Y", "allow_edit" => "N"),
        )
    );
}


