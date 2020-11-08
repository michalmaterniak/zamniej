<?php
namespace App\Application\Pages\Shop\Opinions\Factory;

use App\Application\Pages\Shop\Rating\Factory\FactoryRating;
use App\Application\Pages\Shop\Shop;
use App\Entity\Entities\Shops\Opinions\ShopOpinions;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class FactoryOpinions
{
    /**
     * @var ShopOpinions $comment
     */
    protected $comment;

    /**
     * @var Shop $shop
     */
    protected $shop;

    /**
     * @var FactoryRating $factoryRating
     */
    private $factoryRating;

    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;
    /**
     * @var ValidatorInterface $validator
     */
    private $validator;

    public function __construct(
        FactoryRating           $factoryRating,
        EntityManagerInterface  $entityManager,
        ValidatorInterface      $validator
    ) {
        $this->factoryRating =  $factoryRating;
        $this->entityManager =  $entityManager;
        $this->validator =      $validator;
    }
    abstract protected function updateComment() : void;
    abstract protected function factoryComment() : void;

    private function factoryRating(Shop $shop, int $rating)
    {
        $this->factoryRating->addRating($shop, $rating);
    }
    public function factory(Shop $shop) : ShopOpinions
    {
        $this->shop = $shop;
        $this->factoryComment();
        if (!$this->comment) {
            $this->comment = new ShopOpinions($this->shop->getSubpage()->getSubpage());
        }

        $this->updateComment();
        $this->validate();

        $this->entityManager->persist($this->comment);
        $this->entityManager->flush();

        return $this->comment;
    }

    protected function update(string $name, string $comment, int $rating)
    {
        $this->factoryRating($this->shop, $rating);
        $this->comment->setName($name);
        if (!$comment) {
            $this->comment->setAccepted(true);
        } else {
            $this->comment->addPriority();
        }
        $this->comment->setComment($comment);
        $this->comment->setRating($rating);
    }

    protected function validate()
    {
        $errors = $this->validator->validate($this->comment);

        foreach ($errors as $error) {
            /**
             * @var ConstraintViolation $error
             */
            throw new \ErrorException($error->getMessage());
        }
    }
}
