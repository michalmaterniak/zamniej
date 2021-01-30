<?php
namespace App\Entity\Entities\Affiliations;

use App\Entity\Entities\Subpages\Subpages;
use App\Entity\Interfaces\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class ShopsAffiliation
 * @ORM\Table(name="shops_affiliation",
 *    uniqueConstraints={
 *        @ORM\UniqueConstraint(name="name_type", columns={"name", "type"}),
 *        @ORM\UniqueConstraint(name="affiliation_external", columns={"affiliation_id", "external_id"})
 *      })
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="integer")
 * @ORM\DiscriminatorMap({
 *     0 = "App\Entity\Entities\Affiliations\Webepartners\WebepartnersPrograms",
 *     1 = "App\Entity\Entities\Affiliations\Convertiser\ConvertiserPrograms",
 * })
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Affiliations\ShopsAffiliationRepository")
 *
 * @UniqueEntity(
 *     fields={"name", "type"},
 *     message="Podana nazwa: {{ value }} w wybranej afiliacji jest już zajęta",
 *     entityClass="App\Entity\Entities\Affiliations\ShopsAffiliation"
 * )
 */

abstract class ShopsAffiliation implements EntityInterface
{
    /**
     * @var int $idShop
     * @ORM\Column(name="id_shop", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"resource-admin", "program-admin", "program-admin-list"})
     */
    protected $idShop;

    /**
     * @var string $name
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     * @Groups({"resource-admin", "program-admin", "program-admin-list"})
     */
    protected $name;

    /**
     * @var Subpages|null $resource
     * @ORM\ManyToOne(targetEntity="App\Entity\Entities\Subpages\Subpages", fetch="LAZY")
     * @ORM\JoinColumn(name="shop_id", referencedColumnName="id_subpage", nullable=true, onDelete="SET NULL")
     * @Groups({"program-admin", "program-admin-list"})
     */
    protected $subpage;

    /**
     * @var string|null $linkForce
     * @ORM\Column(name="link_force", type="string", length=700, nullable=true)
     * @Groups({"resource-admin", "program-admin"})
     */
    protected $linkForce = null;

    /**
     * @var bool $isNew
     * @ORM\Column(name="is_new", type="boolean", nullable=false)
     * @Groups({"resource-admin", "program-admin"})
     */
    protected $isNew = true;

    /**
     * @var Affiliations $affiliation
     * @ORM\ManyToOne(targetEntity="App\Entity\Entities\Affiliations\Affiliations")
     * @ORM\JoinColumn(name="affiliation_id", referencedColumnName="id_affiliation", nullable=false)
     * @Groups({"resource-admin", "program-admin", "program-admin-list"})
     */
    protected $affiliation;

    /**
     * @var string $externalId
     * @ORM\Column(name="external_id", type="string", length=700, nullable=true)
     * @Groups({"resource-admin", "program-admin"})
     */
    protected $externalId;

    /**
     * @var bool $enable
     * @ORM\Column(name="enable", type="boolean", nullable=false)
     * @Groups({"resource-admin", "program-admin", "program-admin-list"})
     */
    protected $enable;

    /**
     * @var string $urlLogo
     * @ORM\Column(name="url_logo", type="string", length=600, nullable=true)
     */
    protected $urlLogo = null;

    /**
     * @var int $redirectCount
     * @ORM\Column("resource-admin", name="redirect_count", type="integer", nullable=true)
     */
    protected $redirectCount = 0;

    abstract public function getCps() : float;

    abstract public function getCpc(): float;

    abstract public function setExternalId($id): void;

    /**
     * @return string
     * @Groups({"program-admin", "program-admin-list"})
     */
    abstract public function getTrackingUrl() : string;
    /**
     * @param string $name
     */
    abstract function setName(string $name): void;

    /**
     * @return int
     */
    public function getIdShop(): int
    {
        return $this->idShop;
    }

    /**
     * @param int $idShop
     */
    public function setIdShop(int $idShop): void
    {
        $this->idShop = $idShop;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Subpages|null
     */
    public function getSubpage(): ?Subpages
    {
        return $this->subpage;
    }

    /**
     * @return bool
     */
    public function hasSubpage(): bool
    {
        return (bool)$this->getSubpage();
    }

    /**
     * @param Subpages|null $subpage
     */
    public function setSubpage(?Subpages $subpage): void
    {
        $this->subpage = $subpage;
        if ($subpage) {
            $this->setIsNew(false);
        }
    }

    /**
     * @return string|null
     */
    public function getLinkForce(): ?string
    {
        return $this->linkForce;
    }

    /**
     * @param string|null $linkForce
     */
    public function setLinkForce(?string $linkForce): void
    {
        $this->linkForce = $linkForce;
    }

    /**
     * @return bool
     */
    public function isNew(): bool
    {
        return $this->isNew;
    }

    /**
     * @param bool $isNew
     */
    public function setIsNew(bool $isNew): void
    {
        $this->isNew = $isNew;
    }

    /**
     * @return Affiliations
     */
    public function getAffiliation(): Affiliations
    {
        return $this->affiliation;
    }

    /**
     * @param Affiliations $affiliation
     */
    public function setAffiliation(Affiliations $affiliation): void
    {
        $this->affiliation = $affiliation;
    }

    /**
     * @return bool
     */
    public function isEnable(): bool
    {
        return $this->enable;
    }

    /**
     * @param bool $enable
     */
    public function setEnable(bool $enable): void
    {
        $this->enable = $enable;
    }

    /**
     * @return string
     */
    public function getUrlLogo(): string
    {
        return $this->urlLogo;
    }

    /**
     * @param string $urlLogo
     */
    public function setUrlLogo(string $urlLogo): void
    {
        $this->urlLogo = $urlLogo;
    }


    /**
     * @return int
     */
    public function getRedirectCount(): int
    {
        return $this->redirectCount;
    }

    /**
     * @param int $redirectCount
     */
    public function setRedirectCount(int $redirectCount): void
    {
        $this->redirectCount = $redirectCount;
    }

    /**
     * @param int $count
     */
    public function addRedirect(int $count = 1): void
    {
        $this->redirectCount += $count;
    }

    /**
     * @return string
     */
    public function getExternalId(): string
    {
        return $this->externalId;
    }
}
