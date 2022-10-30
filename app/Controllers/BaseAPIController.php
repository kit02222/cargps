<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

class BaseAPIController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['url'];
	protected $cur_datetime = "";
	//protected $session = "";
	protected $global_data = array();
	protected $db = null;

	/**
	 * Constructor.
	 */
	public function __construct()
	{
	}
	
	
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();

		$this->cur_datetime = date('Y-m-d H:i:s');
		
		//$this->session = \Config\Services::session();
		//$this->global_data["session"] = $this->session;
		$this->db = \Config\Database::connect();
		
	}
	
	public function baseinsertQuery($data){
	    
	    $this->result_ar = $this->checkdatacolumn($data);
	    $sub_tb_columns = $this->global_data["tb_columns"];
	    
	    if($this->result_ar["status"]):
	    
    	    $tablename = $sub_tb_columns["tb_name"];
    	    $pk = $sub_tb_columns["primary_key"];
    	    $auto_increment = $sub_tb_columns["auto_increment"];
    	    $columns = $sub_tb_columns["columns"];
    	    
    	    if($this->have_duplicate($data) && $auto_increment=="N"):
        	    $this->result_ar["status"] = false;
        	    $this->result_ar["message"] = lang("sql_lang.sql-error-004");
    	    else:
        	    $set_ar = array();
        	    
        	    foreach ($data as $key => $data_value):
        	    
            	    foreach ($columns as $columns_key => $column):
                	    if($columns_key == $key ):
                	       $set_ar[$key] = $data_value;
                	       break;
                	    endif;
            	    endforeach;
        	    
        	    endforeach;
        	    
        	    $builder = $this->db->table($tablename);
        	    $query = $builder->insert($set_ar);
        	    
        	    
        	    if($this->db->affectedRows() > 0):
            	    $this->result_ar["status"] = true;
            	    $this->result_ar["message"] = 'inserted.';
        	    else:
            	    $this->result_ar["status"] = false;
            	    $this->result_ar["message"] = lang("sql_lang.sql-error-001");
        	    endif;
        	endif;//if($this->check_duplicate($data)):
	    endif;
	    
	    return $this->result_ar;
	}
	
	public function baseupdateQuery($data){
	    
	    $this->result_ar = $this->checkdatacolumn($data);
	    $sub_tb_columns = $this->global_data["tb_columns"];
	    
	    if($this->result_ar["status"]):
    	    
	       $tablename = $sub_tb_columns["tb_name"];
	       $pk = $sub_tb_columns["primary_key"];
	       $auto_increment = $sub_tb_columns["auto_increment"];
	       $columns = $sub_tb_columns["columns"];
    	    
    	    $set_ar = array();
    	    $where_ar = array();
    	    
    	    foreach ($data as $key => $data_value):
    	    
        	    if(is_array($pk) && in_array($key, $pk)):
        	       $where_ar[$key] = $data_value;
        	    elseif($key == $pk):
        	       $where_ar[$key] = $data_value;
        	    endif;
        	    
        	    foreach ($columns as $columns_key => $column):
        	       if($columns_key == $key && $columns_key != $pk):
        	           $set_ar[$key] = $data_value;
        	           break;
        	       endif;
        	    endforeach;
    	    
    	    endforeach;
    	    
    	    $builder = $this->db->table($tablename);
    	    $builder->set($set_ar);
    	    $builder->where($where_ar);
    	    $query = $builder->update();
    	    
    	    
    	    if($this->db->affectedRows()  > 0):
        	    $this->result_ar["status"] = true;
        	    $this->result_ar["message"] = 'updated.';
    	    else:
        	    $this->result_ar["status"] = false;
        	    $this->result_ar["message"] = lang("sql_lang.sql-error-002");
    	    endif;
	    endif;
	    
	    return $this->result_ar;
	}
	
	public function basedeleteQuery($data){
	    
	    $this->result_ar = $this->checkdatacolumn($data);
	    $sub_tb_columns = $this->global_data["tb_columns"];
	    
	    if($this->result_ar["status"]):
	    
    	    $tablename = $sub_tb_columns["tb_name"];
    	    $pk = $sub_tb_columns["primary_key"];
    	    $auto_increment = $sub_tb_columns["auto_increment"];
    	    $columns = $sub_tb_columns["columns"];
    	    
    	    $where_ar = array();
    	    
    	    foreach ($data as $key => $data_value):
        	    
        	    if(is_array($pk) && in_array($key, $pk)):
        	       $where_ar[$key] = $data_value;
        	    elseif($key == $pk):
        	       $where_ar[$key] = $data_value;
        	    endif;
        	    
    	    endforeach;
    	    
    	    $builder = $this->db->table($tablename);
    	    $builder->where($where_ar);
    	    $query = $builder->delete();
    	    
    	    if($this->db->affectedRows() > 0):
    	       $this->result_ar["status"] = true;
    	       $this->result_ar["message"] = 'Deleted.';
    	    else:
    	       $this->result_ar["status"] = false;
    	       $this->result_ar["message"] =  lang("sql_lang.sql-error-003");
    	    endif;
	    endif;
	    
	    return $this->result_ar;
	}
	
    //-------------------------verification---------------------//
	private function have_duplicate($data){
	    
	    $sub_tb_columns = $this->global_data["tb_columns"];
	    
	    $tablename = $sub_tb_columns["tb_name"];
	    $pk = $sub_tb_columns["primary_key"];
	    
	    $where_ar = array();
	    
	    foreach ($data as $key => $data_value):
	    
    	    if(is_array($pk) && in_array($key, $pk)):
    	        $where_ar[$key] = $data_value;
    	    elseif($key == $pk):
    	        $where_ar[$key] = $data_value;
    	    endif;
	    
	    endforeach;
	    //echo print_r($where_ar,true);
	    $builder = $this->db->table($tablename);
	    $query = $builder->getWhere($where_ar);
	    
	    if(count($query->getResultArray()) > 0)
	        return true;
	    else
	       return false;
	}
	
	private function checkdatacolumn($data){
	    
	    $sub_tb_columns = $this->global_data["tb_columns"];
	    
	    $columns = $sub_tb_columns["columns"];
	    $primary_key = $sub_tb_columns["primary_key"];
	    $auto_increment = $sub_tb_columns["auto_increment"];
	    $flag = $data["flag"];
	    $message = "Passed BaseController => checkdatacolumn";
	    
	    foreach ($columns as $key => $column):
	    
    	    $type = $column["type"];
    	    
    	    if ($auto_increment == "Y" && $key == $primary_key)
    	        continue;
    	        
    	    if(in_array($type, array("display")))
    	        continue;
    	            
    	    $allow_null = $column["allow_null"];
    	            
    	    switch(strtoupper($flag)){
    	                
    	       case 'I':
    	       case 'U':
    	                    
    	                if(!isset($data[$key]) && $allow_null=='N' )
    	                    return array("status"=> false,"message"=> $key." should contained in the dataset.");
    	                        
    	                if(!isset($data[$key]) && !$this->checktype($type,$data[$key]))
    	                    return array("status"=> false,"message"=> $key."(".$data[$key].") incorrect format ".$type);
    	                    break;
    	      case 'D':break;    
    	            }
	    endforeach;
	            
	    return array("status"=> true,"message"=> $message);
	            
	}
	
	private function checktype($type, $data){
	    
	    switch($type){
	        case 'int': if(is_int($data)) return true;
	        case 'string':if(is_string($data)) return true;
	        case 'date':if($this->validateDate($data, 'Y-m-d')) return true;
	        case 'datetime':if($this->validateDate($data, 'Y-m-d H:i:s')) return true;
	    }
	    
	    return false;
	}
	
	private function validateDate($date, $format = 'Y-m-d H:i:s')
	{
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}
	
	
	//-------------------------end of verification------------------//
}
