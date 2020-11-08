<?php
namespace App\Controller\Front\Api\Pages\Contact;

use App\Controller\Front\Api\AbstractController;
use App\Services\Mailer\Mails\FormMailer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @return JsonResponse
     * @Route(
     *  "/page/api/pages/contact/contact",
     *  name="page-api-pages-contact-contact",
     *  methods={"POST|GET"}
     *     )
     */
    public function contact(FormMailer $formMailer)
    {
        try {
            $formMailer->sendMail();

            return $this->json([
                'success' => true,
            ]);
        } catch (\ErrorException $errorException) {
            return $this->json([
                'success' => false,
            ]);
        }
    }
}
