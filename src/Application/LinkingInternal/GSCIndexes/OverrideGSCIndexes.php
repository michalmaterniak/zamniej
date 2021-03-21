<?php
namespace App\Application\LinkingInternal\GSCIndexes;

use App\Application\Locale\FinderSubpageBySlug;
use App\Entity\Entities\GSC\GSCIndexes;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class OverrideGSCIndexes
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    /**
     * @var ArrayCollection|GSCIndexes[] $gscIndexesRecords
     */
    protected $gscIndexesRecords;

    /**
     * @var FinderSubpageBySlug $finderSubpageBySlug
     */
    protected FinderSubpageBySlug $finderSubpageBySlug;

    public function __construct(
        EntityManagerInterface $entityManager,
        FinderSubpageBySlug $finderSubpageBySlug
    )
    {
        $this->entityManager = $entityManager;
        $this->gscIndexesRecords = new ArrayCollection();

        $this->finderSubpageBySlug = $finderSubpageBySlug;
    }

    /**
     * @param ArrayCollection $records
     */
    public function updateGSCIndexes($records)
    {
        if ($records->count() === 0) {
            return;
        }

        try {

            $this->entityManager->beginTransaction();

            $this->clearGSCIndexes();

            foreach ($records as $record) {
                $subpage = $this->finderSubpageBySlug->getSubpageByUrl(
                    $record->url
                );

                if (!$subpage) {
                    continue;
                }

                $record = new GSCIndexes(
                    $record->url,
                    $record->datetime,
                    $subpage
                );

                $this->entityManager->persist($record);

                $this->gscIndexesRecords->add($record);

            }


            $this->entityManager->flush();
            $this->entityManager->commit();

        } catch (Exception $exception) {
            $this->entityManager->rollback();

        }
    }

    protected function clearGSCIndexes()
    {
        $query = $this->entityManager->createQuery(
            "DELETE FROM " . GSCIndexes::class
        );

        $query->execute();
    }

    /**
     * @return GSCIndexes[]|ArrayCollection
     */
    public function getGscIndexesRecords()
    {
        return $this->gscIndexesRecords;
    }
}
