<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 29.09.2018
 * Time: 15:28
 */

namespace LuckyBundle\Traits;
/**
 * Trait IsGoodNumberTrait
 * @package LuckyBundle\Traits
 */
trait  IsGoodNumberTrait {

	/**
	 * @param int $number
	 *
	 * @return bool
	 */
	function IsGoodNumber( int $number ): bool {
		if ( $number % 2 == 0 ) {
			return true;
		} else {
			return false;
		}
	}
}