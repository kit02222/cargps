<?php namespace App\Models;

use CodeIgniter\Model;

class usrmodel extends Model {
    
    protected $table      = 'usrmtr';
    protected $primaryKey = 'usr_id';
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    
    protected $allowedFields = ['name', 'description','lastlogin','createdt','createby','modifydt','modifyby'];
    
    protected $useTimestamps = false;
    protected $createdField  = 'createddt';
    protected $updatedField  = 'updateddt';
    protected $deletedField  = '';
    
    protected $validationRules    = [
        'usr_id'     => 'required',
        'name'        => 'required'
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    private $tb_columns = array();
    

}


