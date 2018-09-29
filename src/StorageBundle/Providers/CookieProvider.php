<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 29.09.2018
 * Time: 16:45
 */

namespace StorageBundle\Providers;

use StorageBundle\Interfaces\Load;
use StorageBundle\Interfaces\Save;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;

class CookieProvider implements Save, Load {
	private $request, $response;

	function __construct() {
		$this->request  = Request::createFromGlobals();
		$this->response = new Response();
	}

	/**
	 * @param string $key
	 * @param mixed $val
	 * @param int $expire
	 *
	 * @return $this
	 */
	public function save( string $key, $val, int $expire ): CookieProvider {
		$this->response->headers->setCookie( new Cookie( $key, $val, time() + $expire ) );
		$this->response->send();
		return $this;
	}

	/**
	 * @param string $key
	 *
	 * @return mixed
	 */
	public function load( string $key ) {
		return $this->request->cookies->get( $key,null );
	}

}