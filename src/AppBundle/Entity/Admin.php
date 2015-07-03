<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Admin
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Admin extends User
{
    /**
     * @var string
     *
     * @ORM\Column(name="nickName", type="string", length=255)
     */
    private $nickName;

    /**
     * Set nickName
     *
     * @param string $nickName
     * @return Admin
     */
    public function setNickName($nickName)
    {
        $this->nickName = $nickName;

        return $this;
    }

    /**
     * Get nickName
     *
     * @return string
     */
    public function getNickName()
    {
        return $this->nickName;
    }
}