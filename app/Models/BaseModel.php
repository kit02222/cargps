<?php
namespace App\Models;

use CodeIgniter\Model;

class BaseModel extends Model
{
    function __construct()
    {
        parent::__construct($this->tb_columns);
    }

    
}
