<?php namespace App\Controllers;

class Mainctr extends BaseController
{
	public function index()
	{
	    //return view('main/index', $this->global_data);
	    $this->global_data["body"] = view('main/index', array());
	    return view('index',$this->global_data);
	}
	
	public function getGPStrackCount(){
	    
	    $data["havedata"] = false;
	    $data["chartdata"] = null;
	    
	    $barname = 'GPS Track';
	    $backgroundColor = 'rgb(102, 255, 102)';
	    $borderColor = 'rgb(102, 255, 102)';
	    $labels = array();
	    $labelsdata = array();
	    
	    $search_month = $this->request->getPost("month");
	    
	    if(isset($search_month)):
	       
    	    $sql = "select 
                    	date(gt.cur_datetime) as event_date,
                    	count(gt.track_id) as num_count
                    from gpstrack gt
                    	where date_format(gt.cur_datetime, '%m') = ".$search_month."
                    group by event_date";
    	    //echo 'search_month:'.$search_month;
    	    $query_ar = $this->db->query($sql,array())->getResult('array');
	    
    	    foreach ($query_ar as $obj):
    	    
        	    array_push($labels, $obj['event_date']);
        	    array_push($labelsdata, $obj['num_count']);
    	       
    	    endforeach;
    	    
    	    $data["chartdata"] = array(
    	        "labels" => $labels,
    	        "datasets" => array(
    	            array('label'=>$barname,'backgroundColor'=>$backgroundColor,'borderColor'=>$borderColor,'data'=>$labelsdata)
    	        )
    	    );
    	    
    	    $data["havedata"] = true;
    	    
	    endif;
	    echo json_encode($data);
	    
	}
	
	public function getGPSEventCount(){
	    
	    $data["havedata"] = false;
	    $data["chartdata"] = null;
	    
	    $barname = 'GPS Event';
	    $backgroundColor = 'rgb(153, 204, 255)';
	    $borderColor = 'rgb(153, 204, 255)';
	    $labels = array();
	    $labelsdata = array();
	    
	    $search_month = $this->request->getPost("month");
	    
	    if(isset($search_month)):
	       
    	    $sql = "select 
                    	date(ge.createdt) as event_date,
                    	count(ge.event_id) as num_count
                    from gpsevent ge
                    	where date_format(ge.createdt, '%m') = ".$search_month."
                    group by event_date";
    	    //echo 'search_month:'.$search_month;
    	    $query_ar = $this->db->query($sql,array())->getResult('array');
	    
    	    foreach ($query_ar as $obj):
    	    
        	    array_push($labels, $obj['event_date']);
        	    array_push($labelsdata, $obj['num_count']);
    	       
    	    endforeach;
    	    
    	    $data["chartdata"] = array(
    	        "labels" => $labels,
    	        "datasets" => array(
    	            array('label'=>$barname,'backgroundColor'=>$backgroundColor,'borderColor'=>$borderColor,'data'=>$labelsdata)
    	        )
    	    );
    	    
    	    $data["havedata"] = true;
    	    
	    endif;
	    echo json_encode($data);
	    
	}
	
	public function geteoc(){
	    
	    $data["havedata"] = false;
	    $data["chartdata"] = null;
	    
	    $barname = 'GPS Event';
	    $backgroundColor = 'rgb(51, 102, 255)';
	    $borderColor = 'rgb(51, 102, 255)';
	    $labels = array();
	    $labelsdata = array();
	    
	    $search_month = $this->request->getPost("month");
	    
	    if(isset($search_month)):
	    
    	    $sql = "select
                        ge.`data`,
                        	count(ge.event_id) as num_count
                        from gpsevent ge
                        	where date_format(ge.createdt, '%m') = ".$search_month."
                        	and ge.`type` = 'engine'
                        group by ge.`data`";
    	    //echo 'search_month:'.$search_month;
    	    $query_ar = $this->db->query($sql,array())->getResult('array');
    	    
    	    foreach ($query_ar as $obj):
    	    
        	    array_push($labels, $obj['data']);
        	    array_push($labelsdata, $obj['num_count']);
    	    
    	    endforeach;
    	    
    	    $data["chartdata"] = array(
    	        "labels" => $labels,
    	        "datasets" => array(
    	            array('label'=>$barname,'backgroundColor'=>$backgroundColor,'borderColor'=>$borderColor,'data'=>$labelsdata)
    	        )
    	    );
    	    
    	    $data["havedata"] = true;
    	    
	    endif;
	    echo json_encode($data);
	    
	}

}
