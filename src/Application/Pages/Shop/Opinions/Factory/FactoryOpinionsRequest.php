<?php
namespace App\Application\Pages\Shop\Opinions\Factory;

use App\Application\Pages\Shop\Rating\Factory\FactoryRating;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FactoryOpinionsRequest extends FactoryOpinions
{
    /**
     * @var RequestPostContentData $requestPostContentData
     */
    protected $requestPostContentData;

    /**
     * @var RequestStack $requestStack
     */
    protected $requestStack;

    /**
     * @var array
     */
    protected $requestData;


    public function __construct(
        RequestStack            $requestStack,
        RequestPostContentData  $requestPostContentData,
        FactoryRating           $factoryRating,
        EntityManagerInterface  $entityManager,
        ValidatorInterface      $validator
    ) {
        parent::__construct($factoryRating, $entityManager, $validator);
        $this->requestPostContentData = $requestPostContentData;
        $this->requestStack = $requestStack;
    }
    protected function checkRequestData()
    {
        if (!$this->requestPostContentData->checkIfExist('comment')) {
            return false;
        }

        $this->requestData = $this->requestPostContentData->getValue('comment');
        if (!isset($this->requestData['comment']) || !isset($this->requestData['name']) || !isset($this->requestData['rating'])) {
            return false;
        }

        return true;
    }

    protected function factoryComment(): void
    {
        if (!$this->checkRequestData()) {
            throw new \ErrorException('Błąd podczas zapisu');
        }
    }

    protected function updateComment(): void
    {
        $this->update($this->requestData['name'], $this->requestData['comment'], $this->requestData['rating']);
        $this->comment->setIdentifyPerson();
        $this->comment->getIdentifyPerson()->setRequest($this->requestStack->getCurrentRequest()->server->all());
    }
}
