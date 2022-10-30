<?php namespace App\Controllers\api;

use App\Controllers\BaseAPIController;


class Gpsapi extends BaseAPIController
{
    
    private $gpsmtr = null;
    private $gpsobject = null;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->gpsmtr = model('gps/gpsmtr', true, $this->db);
        
        $this->global_data["tb_columns"] = $this->gpsmtr->tb_columns;
        $this->global_data["columns"] = $this->gpsmtr->tb_columns["columns"];
        //---------------check API & Secret------------------//
        $request = \Config\Services::request();
        $header = $request->getHeaders();
        //$data = $request->getBody();
        //echo 'header:'.print_r($header,true).' body:'.print_r($data,true);
        $authorization = $request->getHeader('authorization');
        $apikey = null;
        $apisecret = null;
        
        $authorization_ar = explode(":", $authorization);
        //echo "count:".count($authorization_ar)." ar:".print_r($authorization_ar,true);
        if(count($authorization_ar) != 3):
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
        
        $apikey = str_replace(" ", "" , $authorization_ar[1]);
        $apisecret = str_replace(" ", "" , $authorization_ar[2]);
        
        $gpsobject_ar = $this->gpsmtr->where(array('apikey'=>$apikey,'apisecret'=>$apisecret,'active'=>'Y') )->findAll();
        
        if(count($gpsobject_ar) == 0):
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        else:
            $this->gpsobject = $gpsobject_ar[0];
        endif;
        //---------------end of check API & Secret------------------//
    }
    
    /* GPS API 
     *  - Engine Start 
     *  - Upload GPS information
     *  - Engine Stop
     *  - Battery Status upload
     * */
    
	public function engine(){
	    /* event_id = yyyymmddhhmmss + gps_id
	     * Type: engine
	     * Engine start = s
	     * Engine down = d
	     * */

	    $data["response"] = array();
	    $gpsevent = model('gps/gpsevent', true, $this->db);
	    
	    $json_post = json_decode($this->request->getBody());
	    //echo print_r($json_post,true);
	    
	    if (json_last_error() === JSON_ERROR_NONE && isset($json_post->engine)):// JSON is valid
	        
	        $insert_data = [
	            'event_id' => date('YmdHis').$this->gpsobject['gps_id'],
	            'gps_id' => $this->gpsobject['gps_id'],
	            'type' => 'engine',
	            'data' => $json_post->engine,
	            'createdt' => $this->cur_datetime,
	            'createby' => $this->request->getIPAddress()
	        ];
	        
	        $gpsevent->insert($insert_data);
	        $data["response"] = $this->cur_datetime.' engine Uploaded!';
	    else:
	       log_message('info', 'json_post:'.print_r($json_post,true));
	       error_log('gpsapi->engine->json_post:'.print_r($json_post,true), 0);
	       $data["response"] = lang("general_lang.error-004");
	    endif;
	    
	    echo json_encode($data);
	}
	
	public function gpsinfo(){
	    /* track_id = yyyymmddhhmmss + gps_id
	     * type = info
	     * 
	     * */
	    $data["response"] = array();
	    $gpstrack = model('gps/gpstrack', true, $this->db);
	    
	    $json_post = json_decode($this->request->getBody());
	    //echo print_r($json_post,true);
	    
	    if (json_last_error() === JSON_ERROR_NONE && isset($json_post->longitude)):// JSON is valid
	    
    	    $insert_data = [
    	        'track_id' => date('YmdHis').$this->gpsobject['gps_id'],
    	        'gps_id' => $this->gpsobject['gps_id'],
    	        'cur_datetime' => date('Y-m-d H:i:s'),
    	        'type' => 'info',
    	        'latitude' => $json_post->latitude,
    	        'longitude' => $json_post->longitude,
    	        'altitude' => $json_post->altitude,
    	        'speed' => $json_post->speed,
    	        'heading' => null,
    	        'climb' => $json_post->climb,
    	        'status' => json_encode($json_post),
    	    ];
    	    
    	    $gpstrack->insert($insert_data);
    	    //echo print_r($insert_data,true);
    	    $data["response"] = $this->cur_datetime.' gpsinfo Uploaded!';
	    else:
	       log_message('info', 'json_post:'.print_r($json_post,true));
	       error_log('gpsapi->gpsinfo->json_post:'.print_r($json_post,true), 0);
	       $data["response"] = lang("general_lang.error-004");
	    endif;
	    
	    echo json_encode($data);
	}
	
	public function batterystatus(){
	    /* event_id = yyyymmddhhmmss + gps_id + Type
	     * Type: battery
	     * 
	     * */
	    //echo 'batterystatus';
	    $data["response"] = array();
	    $gpsevent = model('gps/gpsevent', true, $this->db);
	    
	    $json_post = json_decode($this->request->getBody());
	    
	    if (json_last_error() === JSON_ERROR_NONE && isset($json_post->battery)):// JSON is valid
	    
    	    $insert_data = [
    	        'event_id' => date('YmdHis').$this->gpsobject['gps_id'],
    	        'gps_id' => $this->gpsobject['gps_id'],
    	        'type' => 'battery',
    	        'data' => $json_post->battery,
    	        'createdt' => $this->cur_datetime,
    	        'createby' => $this->request->getIPAddress()
    	    ];
	    
	       $gpsevent->insert($insert_data);
	       $data["response"] = $this->cur_datetime.' batterystatus Uploaded!';
	    else:
	       log_message('info', 'json_post:'.print_r($json_post,true));
	       error_log('gpsapi->batterystatus->json_post:'.print_r($json_post,true), 0);
	       $data["response"] = lang("general_lang.error-004");
	    endif;
	    
	    echo json_encode($data);
	}
	
}
