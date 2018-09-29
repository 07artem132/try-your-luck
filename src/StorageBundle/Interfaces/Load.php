<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 29.09.2018
 * Time: 16:53
 */

namespace StorageBundle\Interfaces;

/**
 * Interface Load
 * @package StorageBundle\Interfaces
 */
interface Load {
	/**
	 * @param string $key
	 *
	 * @return mixed
	 */
	public function load(string $key );
}