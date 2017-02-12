<?php

namespace DevrestoBundle\Entity\App;

use Doctrine\ORM\Mapping as ORM;

/**
 * Purchase
 *
 * @ORM\Table(name="app_purchase")
 * @ORM\Entity(repositoryClass="DevrestoBundle\Repository\App\PurchaseRepository")
 */
class Purchase
{
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
     * @var string
     *
     * @ORM\Column(name="products", type="text")
     */
    private $products;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;


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
     * @return Purchase
     */
    public function setuser_id($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getuser_id()
    {
        return $this->userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set products
     *
     * @param string $products
     *
     * @return Purchase
     */
    public function setProducts($products)
    {
        $this->products = $products;

        return $this;
    }

    /**
     * Get products
     *
     * @return string
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Purchase
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime
     */
    public function getCreated_at()
    {
        return $this->createdAt;
    }
}

