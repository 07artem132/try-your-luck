<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 29.09.2018
 * Time: 16:43
 */

namespace StorageBundle\Interfaces;

/**
 * Interface Save
 * @package StorageBundle\Interfaces
 */
interface Save {
	/**
	 * @param string $key
	 * @param mixed  $val
	 * @param int $expire
	 * @return mixed
	 */
	public function save( string $key, $val , int $expire);
}
