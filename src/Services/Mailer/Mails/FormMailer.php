<?php
namespace App\Services\Mailer\Mails;

use App\Entity\Entities\Users\Users;
use App\Repository\Repositories\Users\UsersRepository;
use App\Services\Mailer\AbstractMailer;
use App\Services\System\Request\Retrievers\RequestDataManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class FormMailer extends AbstractMailer
{
    protected RequestStack $requestStack;
    protected Users $user;

    /**
     * @var RequestDataManager $requestDataManager
     */
    protected $requestDataManager;
    /**
     * @var array $formContent
     */
    protected $formContent;
    public function __construct(
        ContainerInterface  $container,
        RequestDataManager  $requestDataManager,
        UsersRepository     $usersRepository
    ) {
        parent::__construct($container);
        $this->user = $usersRepository->select()->findOneAdmin()->getResultOrNull();
        $this->requestDataManager = $requestDataManager;
    }
    public function validateContent()
    {
        foreach ($this->formContent as $key => $item) {
            $this->formContent[$key] = trim($item);
            $this->formContent[$key] = stripslashes($item);
            $this->formContent[$key] = htmlspecialchars($item);
        }
    }
    public function sendMail()
    {
        $this->formContent = $this->requestDataManager->getValue('form');
        $this->validateContent();
        $this->mail($this->user->getEmail(), "Wiadomość z formularza", $this->twig->render(
            'mails/formMessage.html.twig',
            [
                'form' => $this->formContent,
                'admin' => $this->user,
            ]
        ), true);
    }
}
