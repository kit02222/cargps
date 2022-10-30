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

class BaseNonLoginController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['session','url'];
	protected $cur_datetime = "";
	protected $session = "";
	protected $global_data = array();

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);
        //echo 'hello mother class';
		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
		$this->cur_datetime = date('Y-m-d H:i:s');
		$this->session = \Config\Services::session();
		$this->global_data["session"] = $this->session;
		
		$ip_address = $this->request->getIPAddress();
		//echo $ip_address;
		if((ENVIRONMENT == 'production')):
		  if(!$this->ipMatch($ip_address,'192.168.0.0/24'))
		    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	    endif;
	}
	
	public function ipMatch($ip, $cidrs, &$match = null) {
	    foreach((array) $cidrs as $cidr) {
	        list($subnet, $mask) = explode('/', $cidr);
	        if(((ip2long($ip) & ($mask = ~ ((1 << (32 - $mask)) - 1))) == (ip2long($subnet) & $mask))) {
	            $match = $cidr;
	            return true;
	        }
	    }
	    return false;
	}

}
