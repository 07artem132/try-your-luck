<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use GenerateNumberBundle\GenerateNumberBundle;
Use LuckyBundle\Traits\IsGoodNumberTrait;
use StorageBundle\StorageBundle;
use AppBundle\Entity\User;
use AppBundle\Entity\UserNumber;

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

		$data = json_decode( $this->storage->cookie()->load( 'number' ) );

		if ( empty( $data ) ) {
			$number = GenerateNumberBundle::Generate();
			$diff   = 60 * 60 * 1;

			$this->storage->cookie()->save( 'number', json_encode( [
				'number' => $number,
				'renew'  => time() + 60 * 60 * 1
			] ), 60 * 60 * 1 );

			$user = $this->getDoctrine()->getRepository( User::class )->findOneBy( [ 'ip' => $_SERVER['REMOTE_ADDR'] ] );

			if ( empty( $user ) ) {
				$user = new User();
				$user->setIp( $_SERVER['REMOTE_ADDR'] )
				     ->setUpdatedAt( new \DateTime( 'now' ) )
				     ->setCreatedAt( new \DateTime( 'now' ) );
			} else {
				$user->setUpdatedAt( new \DateTime( 'now' ) );
			}


			$UserNumber = new UserNumber();
			$UserNumber
				->setNumber( $number )
				->setUser( $user )
				->setUpdatedAt( new \DateTime( 'now' ) )
				->setCreatedAt( new \DateTime( 'now' ) );

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist( $user );
			$entityManager->persist( $UserNumber );
			$entityManager->flush();

		} else {
			$diff   = $data->renew - time();
			$number = $data->number;
		}

		if ( $this->IsGoodNumber( $number ) ) {
			$message = 'и тебе сегодня повезло так как твое число: ' . $number;
		} else {
			$message = 'сегодня наверное не твой день,так как твое число: ' . $number;
		}

		return $this->render( 'default/index.html.twig', [
			'message'             => $message,
			'diff'                => $diff,
			'ip'                  => $_SERVER['REMOTE_ADDR'],
			'previousNumberForIP' => $this->previousNumberForIP( $_SERVER['REMOTE_ADDR'] )
		] );
	}


	public function previousNumberForIP( $ip ) {
		$entityManager = $this->getDoctrine()->getManager();
		$query         = $entityManager->createQuery( 'SELECT n.number
FROM AppBundle:User u LEFT JOIN AppBundle:UserNumber n  WITH u.id = n.userId  where u.ip= :ipaddress order by n.createdAt DESC ' )->setParameter( 'ipaddress', $ip )->setMaxResults( 2 );

		return $query->getResult()[1]['number'];
	}
}
