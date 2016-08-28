<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Exclude;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser 
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	public function __construct()
	{
		parent::__construct();
		// your own logic
	}
	
	/**
	 * @Expose()
	 */
	protected $username;
	
	
	/**
	 * @Exclude()
	 * @ORM\OneToMany(targetEntity="Notice", mappedBy="user")
	 */
	protected $notices;

    /**
     * Add notice
     *
     * @param \AppBundle\Entity\Notice $notice
     *
     * @return User
     */
    public function addNotice(\AppBundle\Entity\Notice $notice)
    {
        $this->notices[] = $notice;

        return $this;
    }

    /**
     * Remove notice
     *
     * @param \AppBundle\Entity\Notice $notice
     */
    public function removeNotice(\AppBundle\Entity\Notice $notice)
    {
        $this->notices->removeElement($notice);
    }

    /**
     * Get notices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotices()
    {
        return $this->notices;
    }
}
