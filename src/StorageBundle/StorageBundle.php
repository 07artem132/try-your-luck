<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 29.09.2018
 * Time: 16:39
 */

namespace StorageBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class StorageBundle
 * @package StorageBundle
 * @method \StorageBundle\Providers\CookieProvider cookie();
 */
class StorageBundle extends Bundle {
	public function __call( $name, $arguments ) {
		$name = 'StorageBundle\Providers\\' . ucfirst( $name ) . 'Provider';
		if ( empty( $arguments ) ) {
			return new $name();
		}

		return new $name( $arguments );
	}

}