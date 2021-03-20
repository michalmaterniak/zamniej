<?php

namespace App\Controller\Admin\Api\Links;

use App\Application\Links\GSCIndexes\ConvertFileToArray;
use App\Application\Links\GSCIndexes\OverrideGSCIndexes;
use App\Controller\Admin\Api\AbstractController;
use Exception;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

class GSCIndexesController extends AbstractController
{
    /**
     * @param RequestStack $requestStack
     * @param ConvertFileToArray $convertFileToArray
     * @param OverrideGSCIndexes $gscIndexes
     * @Route("/admin/api/links/uploadStateIndexesFile", name="admin-api-links-uploadStateIndexesFile", methods={"POST"})
     */
    public function uploadStateIndexesFile(
        RequestStack $requestStack,
        ConvertFileToArray $convertFileToArray,
        OverrideGSCIndexes $gscIndexes
    )
    {
        $success = true;
        try {
            if ($requestStack->getCurrentRequest()->files->count() > 0) {
                $convertFileToArray->loadFile(
                    $requestStack->getCurrentRequest()->files->get('file')
                );
                $gscIndexes->updateGSCIndexes($convertFileToArray->getRecords());
                $success = $gscIndexes->getGscIndexesRecords()->count() > 0;

            } else {
                $success = false;
            }
        } catch (Exception $exception) {
            $success = false;
        }

        return $this->json(
            [
                'success' => $success
            ]
        );

    }
}
