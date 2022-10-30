<?php namespace App\Controllers;

class Ssoctr extends BaseNonLoginController
{
    private $db = null;
    
	public function index()
	{

	    if(null != $this->session->get('user_id'))
	        return redirect()->to(base_url().'/mainctr');
	    else
	       return view('sso/index',$this->global_data);
	}
	
	public function logout(){
	    $newdata = [
	        'synology_id'  => null,
	        'user_id'     => null,
	        'user_fullname' => null
	    ];
	    $this->session->set($newdata);
	    return view('sso/logout',$this->global_data);
	    //$this->session->destroy();
	    //return redirect()->to(base_url());
	}
	
	
	public function checkSession(){
	    
	    $data["result"] = (null != $this->session->get('user_id')?true:false);
	    echo json_encode($data);
	    
	}

	public function checklogin(){
	    
	    /* Get login status information
	     * {"status":"not_login","state":"fgwq09gcvcg"}
	     *  {status : 'login',access_token: 'ABCDE'}
	     *  {status : 'ERR_STRING'} */
	    
	    /* Get login information using token
	     Example:
	     curl
	     http://[DSMOauthServer:5000]/webman/sso/SSOAccessToken.cgi?action=��exchange��&access_token=��ABCDE��&app_id=��asfsffsdfsdf3e��
	     Response:
	     If the token is correct:
	     { success : true,
	     data :{
	     user_id : 1024 ,
	     user_name : john
	     }
	     }
	     If any unexpected errors occurred:
	     {
	     success: false,
	     error: 'ERR_STRING'
	     }
	     */
	    $client = \Config\Services::curlrequest();
	    $this->db = \Config\Database::connect();
	    $userModel = model('usrmodel', true, $this->db);
	    
	    /*$response = $client->request('GET', 'https://api.github.com/user', [
	        'auth' => ['user', 'pass']
	    ]);
	    */
	    
	    /* login -1: fail
	     *        1: success
	     *        
	     * */
	    $data = $this->request->getPost('data');
	    $post_data = array(
	        'login' => -1,
	        'message' => null
	    );
	    
	    if(isset($data)):
	    
    	    $json = json_decode($data);
    	    $session_usr_id = $this->session->get('user_id');
    	    
    	    if($json->status == 'login' && null == $session_usr_id):
    	    
        	    $access_token = $json->access_token;
        	    $get_user_url = getenv('oauthserver_url').'/webman/sso/SSOAccessToken.cgi?action=exchange&access_token='.$access_token.'&app_id='.getenv('app_id').'';
        	    //echo $get_user_url;
        	    
        	    $response = $client->request('GET',$get_user_url,['version' => 1.0]);
        	    //echo $response->getStatusCode();
        	    //echo $response->getHeader('Content-Type');
        	    //echo $response->getBody();
        	    
        	    if(null !== ($response->getBody())):

        	    $user_json = json_decode($response->getBody());

            	    //---------get user details from synology------------//
            	    if($user_json->success == true):
            	    
            	    $post_data['message'] = 'You are not allowed to access this system. Please contact administrator.';
            	    $data = $user_json->data;
            	    
            	    $user_id = $data->user_id;
            	    $user_name = $data->user_name;
            	    //---------check local db access---------------//
            	    $usr_q = $userModel->find($user_name);
            	    //echo '$usr_q:'.print_r($usr_q,true);
            	    
            	    if(count($usr_q) > 0):
                	    $fname = $usr_q['name'];
                	    //---------create session---------------------//
                	    /*set_userdata("user_id",$user_id);
                	    set_userdata("user_name",$user_name);
                	    set_userdata("user_fullname",$fname);*/
                	    
                	    $newdata = [
                	        'synology_id'  => $user_id,
                	        'user_id'     => $user_name,
                	        'user_fullname' => $fname
                	    ];
                	    $this->session->set($newdata);
                	    
                	    //echo 'session:'. $this->session->get('user_name');
                	    //---------end of create session-------------//
                	    $userModel->update($user_name, array('lastlogin' => $this->cur_datetime));
                	    
                	    $post_data['login'] = '1';
                	    $post_data['message'] = base_url().'/mainctr';
                	    
            	    endif;

            	    //---------end of check local db access---------------//
            	    
            	    //$post_data['message'] = $user_id.':'.$user_name;
        	    else:
        	       $post_data['message'] = $user_json->error;
        	    endif;
        	    //---------end of get user details from synology------------//
        	    else: //if(isset($user_json)): else
        	       $post_data['message'] = 'if(isset($user_json)): else ';
        	    endif; //if(isset($user_json)):
        	elseif ($json->status = 'not_login'):
        	    $post_data['message'] = 'Your account is not valid';
    	    else: //ERR_STRING
    	       $post_data['message'] = $json->status;
    	    endif;
	    endif;
	    echo json_encode($post_data);
	}
	

}
