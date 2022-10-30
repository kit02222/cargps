<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class baseFilter implements FilterInterface
{
    private $session = '';
    
    public function before(RequestInterface $request)
    {
        // Do something here
        
        //---------------check ip subnet-----------------//
        $ip_address = $request->getIPAddress();
        if((ENVIRONMENT == 'production')):
            if(!$this->ipMatch($ip_address,'192.168.0.0/24')):
                 throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            endif;
        endif;
        //---------------end of check ip subnet-----------------//

        //---------------check session-------------------//
        $this->session = \Config\Services::session();
        $path = $request->uri->getPath();
        $user_id = $this->session->get('user_id');
        
        if(null == $user_id):
            //echo $request->uri->getPath();           // /path/to/page
            return redirect()->to(base_url());
            //echo 'return now';
        endif;
        //---------------end of check session-------------------//

        //---------------check menu permission------------------//
        if(!$this->loadOwnMenuPermission($user_id, $path)):
            return redirect()->to(base_url());
        endif;
        //---------------end of check menu permission------------------//
    }
    
    private function ipMatch($ip, $cidrs, &$match = null) {
        foreach((array) $cidrs as $cidr) {
            list($subnet, $mask) = explode('/', $cidr);
            if(((ip2long($ip) & ($mask = ~ ((1 << (32 - $mask)) - 1))) == (ip2long($subnet) & $mask))) {
                $match = $cidr;
                return true;
            }
        }
        return false;
    }
    
    private function loadOwnMenuPermission($user_id, $cur_path){
        /*
         Array{
         menu_id
         read`,
         write`,
         delete`,
         seq,
         class,
         method,
         sub_menu_id,
         }
         */
        
        $db = \Config\Database::connect();
        $usrmenu = model('config\usrmenu', true, $db);
       
        $menu_ar = array();
        
        $usrmen_q = $db->query("select
                                    um.usr_id,
                                    um.`read`,
                                    um.`write`,
                                    um.`delete`,
                                    m.menu_id,
                                    m.sub_menu_id,
                                    m.sequence,
                                    m.name,
                                    m.description,
                                    m.menu_style
                                from usrmenu um , menumtr m
                                    where um.menu_id = m.menu_id
                                    and um.usr_id = ?
                                order by m.sub_menu_id asc , m.sequence asc",
                                array($user_id));
        //$usrmen_q = $usrmenu->get_user_access($user_id);
        $havepremission = false;
        
        foreach ($usrmen_q->getResult('array') as $row):
            //check permission access & redirect to other path
            array_push($menu_ar, array("menu_id" => $row["menu_id"],
                "read" => $row["read"],
                "write" => $row["write"],
                "delete" => $row["delete"],
                "seq" => $row["sequence"],
                "class" => $row["description"],
                "method" => $row["menu_style"],
                "sub_menu_id" => $row["sub_menu_id"],
                "name" => $row["name"],
                "menus" => array(),
            ));
            
            if(strpos($row["description"], "/") > 0 ):
                $temp_class_name_ar = explode("/", $row["description"]);
                if(count($temp_class_name_ar) > 1):
                    //echo print_r($temp_class_name_ar,true);
                    //$correct_position = (count($temp_class_name_ar) == 1)?1:2;
                    $temp_class_name = $temp_class_name_ar[count($temp_class_name_ar)-1];
                    //echo 'temp_class_name:'.$temp_class_name;
                    //echo $temp_class_name .' == '. $cur_path.'<br> ';
                    if(strpos($cur_path, $temp_class_name) !==false ):
                        $havepremission = true;
                        $this->session->set("cur_menu", $row);
                    endif;
                endif;
            else:
                $temp_class_name = $row["description"];
                //echo $temp_class_name .' == '. $cur_path.'<br> ';
                if(strpos($cur_path, $temp_class_name) !==false ):
                    $havepremission = true;
                    $this->session->set("cur_menu", $row);
                endif;
            endif;

        endforeach;
        
        if(!$havepremission)
            $this->session->set("cur_menu", null);
            
        $this->session->set("menu", $menu_ar);
        //save menu into sesssion
        
        return $havepremission;
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
        echo 'after';
    }
}