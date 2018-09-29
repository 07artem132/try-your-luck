<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * UserNumber
 *
 * @ORM\Table(name="user_number")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserNumberRepository")
 */
class UserNumber
{
	use TimestampableTrait;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number;


	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="numbers")
	 * @ORM\JoinColumn(nullable=true)
	 */
	private $user;

	public function getUser(): User
	{
		return $this->user;
	}

	public function setUser(User $user)
	{
		$this->user = $user;
		return $this;

	}



	/**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return UserNumber
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return UserNumber
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }
}

