<?php namespace App\Models\gps;

use CodeIgniter\Model;

class gpstrack extends Model {
    
    protected $table      = 'gpstrack';
    protected $primaryKey = 'track_id';
    
    protected $returnType = 'array';
    protected $allowedFields = ['track_id','gps_id','cur_datetime','type','latitude','longitude','altitude','speed','heading','climb','status'];
    
    protected $useTimestamps = false;
    protected $createdField  = 'createddt';
    protected $updatedField  = 'updateddt';
    
    protected $useSoftDeletes = false;
    protected $deletedField  = '';
    
    protected $validationRules    = [
        'track_id'     => 'required',
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    public $tb_columns = array(
        "tb_name" => "gpstrack",
        "primary_key" => "track_id",
        "auto_increment" => "N",
        "columns" => array(
            "track_id" => array("type"=>"string", "size"=>"50", "allow_null"=>"N", "allow_edit" => "Y"), 
            "gps_id" => array("type"=>"select","allow_null"=>"N", "allow_edit" => "Y","key" =>"gps_id_q", "tablename" => "gpsmtr"),
            "gps_name" => array("type"=>"display"),
            "cur_datetime" => array("type"=>"datetime", "size"=>null, "allow_null"=>"Y", "allow_edit" => "Y"),   
            "type" => array("type"=>"string", "size"=>"30", "allow_null"=>"Y", "allow_edit" => "Y"), 
            
            "latitude" => array("type"=>"string", "size"=>"10", "allow_null"=>"Y", "allow_edit" => "Y" ),
            "longitude" => array("type"=>"string", "size"=>"10", "allow_null"=>"Y", "allow_edit" => "Y" ),
            "altitude" => array("type"=>"string", "size"=>"10", "allow_null"=>"Y", "allow_edit" => "Y" ),
            "speed" => array("type"=>"string", "size"=>"10", "allow_null"=>"Y", "allow_edit" => "Y" ),
            "heading" => array("type"=>"string", "size"=>"10", "allow_null"=>"Y", "allow_edit" => "Y" ),
            "climb" => array("type"=>"string", "size"=>"10", "allow_null"=>"Y", "allow_edit" => "Y" ),
            "status" => array("type"=>"string", "size"=>"255", "allow_null"=>"Y", "allow_edit" => "Y" ),
          
        )
    );
    
}


