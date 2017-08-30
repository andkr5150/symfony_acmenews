<?php

declare(strict_types=1);

namespace Acme\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;


/**
 * db_news
 *
 * @ORM\Entity
 */
class db_news
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
     * @var \DateTime
     *
     * @ORM\Column(name="datePublic", type="datetime")
     */
    private $datePublic;


    /**
     * @var boolean
     *
     * @ORM\Column(name="publication", type="boolean")
     */
    private $publication;


    /**
     * @var string
     *
     * @ORM\Column(name="shortText", type="string", length=255)
     */
    private $shortText;

    /**
     * @var string
     *
     * @ORM\Column(name="allText", type="text")
     */
    private $allText;

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get datePublic
     *
     * @return \DateTime
     */
    public function getDatePublic()
    {
        return $this->datePublic;
    }

    /**
     * Get publication
     *
     * @return bool
     */
    public function getPublication(): bool
    {
        return (bool)$this->publication;
    }

    /**
     * Get shortText
     *
     * @return string
     */
    public function getShortText(): string
    {
        return (string)$this->shortText;
    }

    /**
     * Get allText
     *
     * @return string
     */
    public function getAllText()
    {
        return $this->allText;
    }

    /**
     * Set datePublic
     *
     * @param \DateTime $datePublic
     *
     * @return db_news
     */
    public function setDatePublic(\DateTime $datePublic): db_news
    {
        $this->datePublic = $datePublic;

        return $this;
    }

    /**
     * @param bool $publication
     *
     * @return db_news
     */
    public function setPublication($publication): db_news
    {
        $this->publication = $publication;
        return $this;
    }

    /**
     * @param string $shortText
     *
     * @return db_news
     */
    public function setShortText($shortText): db_news
    {
        $this->shortText = $shortText;

        return $this;
    }

    /**
     * @param string $allText
     *
     * @return db_news
     */
    public function setAllText($allText): db_news
    {
        $this->allText = $allText;

        return $this;
    }

}
