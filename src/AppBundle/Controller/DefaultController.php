<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use GenerateNumberBundle\GenerateNumberBundle;
Use LuckyBundle\Traits\IsGoodNumberTrait;
use StorageBundle\StorageBundle;

class DefaultController extends Controller {
	use IsGoodNumberTrait;
	private $storage;

	function __construct() {
		$this->storage = new StorageBundle();
	}

	/**
	 * @Route("/", name="homepage")
	 */
	public function indexAction( Request $request ) {
		$number = $this->storage->cookie()->load( 'number' );

		if ( empty( $number ) ) {
			$number = GenerateNumberBundle::Generate();
			$this->storage->cookie()->save( 'number', $number, 60 * 60 * 1 );
		}

		if ( $this->IsGoodNumber( $number ) ) {
			$message = 'Да ты счастливчик, твое число: ' . $number;
		} else {
			$message = 'Сегодня наверное не твой день, твое число: ' . $number;
		}

		return $this->render( 'default/index.html.twig', [
			'message' => $message,
		] );
	}
}
