<?php namespace App\Controllers\config;

use App\Controllers\BaseController;


class Menuctr extends BaseController
{
    
    private $menumtr = null;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->menumtr = model('config/menumtr', true, $this->db);
        
        $this->global_data["tb_columns"] = $this->menumtr->tb_columns;
        $this->global_data["columns"] = $this->menumtr->tb_columns["columns"];
        $this->global_data["class"] = "config/menuctr";
        $this->global_data["view_path"] = "config/menu/";
        $this->global_data["lang_path"] = "config/menumtr_lang";
    }
    
	public function index()
	{
	    //return view('main/index', $this->global_data);
	    $this->global_data["body"] = view($this->global_data["view_path"].'index', $this->global_data);
	    return view('index',$this->global_data);
	}
	
	public function iud_index(){
	    
	    $data = array("html" =>"");
	    
	    $flag_ctr = $this->request->getPost('flag');
	    $ajax_data_ar = json_decode($this->request->getPost('data'), true);
	    if(count($ajax_data_ar)> 0 )
	        $ajax_data_ar = $ajax_data_ar[0];
	        
	        $this->global_data["flag"] = $flag_ctr;
	        $this->findmasterq_for_view();
	        
	        if(isset($flag_ctr) && $flag_ctr == "i"):
	            $data["html"] = view($this->global_data["view_path"].'form', $this->global_data );
	        elseif(($flag_ctr == "u" || $flag_ctr == "d") && $this->check_array_key($this->menumtr->tb_columns["primary_key"], $ajax_data_ar)):
	        
    	        $search_par = array();
    	        if(is_array($this->menumtr->tb_columns["primary_key"])):
        	        foreach ($this->menumtr->tb_columns["primary_key"] as $m_pk):
        	           $search_par[$m_pk] = $ajax_data_ar[$m_pk];
        	        endforeach;
        	    else:
        	       $search_par = array($this->menumtr->tb_columns["primary_key"]=>$ajax_data_ar[$this->menumtr->tb_columns["primary_key"]]);
                endif;
                
    	        //$this->index_data["result_q"] = $this->menumtr->baseselectQuery($search_par);
    	        $builder = $this->db->table($this->menumtr->table);
    	        $this->global_data["result_q"] = $builder->getWhere($search_par);
    	        $data["html"] = view($this->global_data["view_path"].'form', $this->global_data );
	        
	        else:
    	        $data["html"] = lang("sql_lang.error-001");
    	        $data["html"] .= '<pre>'.print_r($ajax_data_ar,true).'</pre>';
	        endif;
	        
	        echo json_encode($data);
	        
	}
	
	private function check_array_key($primary_key_ar,$data){
	    if(is_array($primary_key_ar)):
    	    foreach($primary_key_ar as $pk):
        	    if(!array_key_exists($pk, $data))
        	        return false;
        	endforeach;
    	else:
    	   if(!array_key_exists($primary_key_ar, $data))
        	    return false;
    	endif;
    	
    	return true;
	}
	
	private function findmasterq_for_view(){
	    
	    if(is_array($this->menumtr->tb_columns["primary_key"])):
	    
    	    $column_ar = $this->menumtr->tb_columns["columns"];
    	    
    	    foreach ($column_ar as $key => $column):
        	    if($column["type"] == "select"):
        	       $this->global_data["select_q"][$column["key"]] = $this->db->table($column["tablename"])->get();
        	    endif;
    	    endforeach;
	    
	    endif;
	    
	}
	
	//------------Start Ajax call------------------//
	
	public function select(){
	    
	    //$sql = "select um.*,(select name from usrmtr where um.usr_id = usrmtr.usr_id ) as usr_name,(select name from menumtr where um.menu_id = menumtr.menu_id ) as menu_name from usrmenu um";
	    //$data["data"] = $this->db->query($sql,array())->getResult('array');
	    $data["data"] = $this->menumtr->findAll();
	    echo json_encode($data);
	    
	}
	
	public function insert(){
	    
	    $data = $this->baseinsertQuery($this->request->getPost());
	    
	    //$data = array("result"=>false,"message"=>$this->lang->line("error-002"));
	    //$data = array("result"=>false,"message"=>$message["message"]);
	    echo json_encode($data);
	    
	}
	
	public function update(){
	    
	    //$data = array("result"=>false,"message"=>$this->lang->line("error-002"));
	    $data = $this->baseupdateQuery($this->request->getPost());
	    echo json_encode($data);
	    
	}
	
	public function delete(){
	    
	    $data = $this->basedeleteQuery($this->request->getPost());
	    echo json_encode($data);
	    
	}

}
