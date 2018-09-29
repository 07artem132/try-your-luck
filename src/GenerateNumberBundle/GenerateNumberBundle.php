<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 29.09.2018
 * Time: 15:45
 */

namespace GenerateNumberBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class GenerateNumberBundle extends Bundle{
	public static function Generate(): int {
		return random_int( 1, 9999 );
	}
}