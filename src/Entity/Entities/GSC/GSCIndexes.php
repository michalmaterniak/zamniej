<?php

namespace App\Entity\Entities\GSC;

use App\Entity\Entities\Subpages\Subpages;
use App\Entity\Interfaces\EntityInterface;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * GSCIndexes
 * @ORM\Table(name="gsc_indexes")
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\GSC\GSCIndexesRepository")
 */
class GSCIndexes implements EntityInterface
{
    /**
     * @var int $idIndex
     * @ORM\Column(name="id_index", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $idIndex;

    /**
     * @var string $url
     * @ORM\Column(name="url", type="string", length=700, nullable=false)
     */
    protected $url;

    /**
     * @var Subpages $subpage
     * @ORM\ManyToOne(targetEntity="App\Entity\Entities\Subpages\Subpages")
     * @ORM\JoinColumn(name="subpage_id", referencedColumnName="id_subpage", nullable=true)
     */
    protected $subpage;

    /**
     * @var DateTime $datetime
     * @ORM\Column(name="datetime", type="datetime", nullable=false)
     */
    protected $datetime;

    public function __construct(string $url, DateTime $datetime, Subpages $subpage)
    {
        $this->url = $url;
        $this->datetime = $datetime;
        $this->subpage = $subpage;
    }

    /**
     * @return int
     */
    public function getIdIndex(): int
    {
        return $this->idIndex;
    }

    /**
     * @param int $idIndex
     */
    public function setIdIndex(int $idIndex): void
    {
        $this->idIndex = $idIndex;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return DateTime
     */
    public function getDatetime(): DateTime
    {
        return $this->datetime;
    }

    /**
     * @param DateTime $datetime
     */
    public function setDatetime(DateTime $datetime): void
    {
        $this->datetime = $datetime;
    }

}
