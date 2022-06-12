<?php

class Listing
{
    private $id;
    private $name;
    private $description;
    private $targetPrice;
    private $collectedFunds;
    private $dateEnd;
    private $user;

    /**
     * @param $id
     * @param $name
     * @param $description
     * @param $targetPrice
     * @param $collectedFunds
     * @param $dateEnd
     * @param $user
     */
    public function __construct($id, $name, $description, $targetPrice, $collectedFunds, $dateEnd, $user)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->targetPrice = $targetPrice;
        $this->collectedFunds = $collectedFunds;
        $this->dateEnd = $dateEnd;
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getTargetPrice()
    {
        return $this->targetPrice;
    }

    /**
     * @return mixed
     */
    public function getCollectedFunds()
    {
        return $this->collectedFunds;
    }

    /**
     * @return mixed
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @param mixed $targetPrice
     */
    public function setTargetPrice($targetPrice): void
    {
        $this->targetPrice = $targetPrice;
    }

    /**
     * @param mixed $collectedFunds
     */
    public function setCollectedFunds($collectedFunds): void
    {
        $this->collectedFunds = $collectedFunds;
    }

    /**
     * @param mixed $dateEnd
     */
    public function setDateEnd($dateEnd): void
    {
        $this->dateEnd = $dateEnd;
    }



}