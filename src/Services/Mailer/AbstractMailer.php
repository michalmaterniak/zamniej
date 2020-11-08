<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 06.10.18
 * Time: 22:04
 */
namespace App\Services\Mailer;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig\Environment;

abstract class AbstractMailer
{
    protected $emailsType = [];


    protected $sendFrom = "powiadomienia@commit-m.pl";
    protected static $instance;

    /**
     * @var \Swift_Mailer $mailer
     */
    protected $mailer;

    /**
     * @var ContainerInterface $container.
     */
    protected $container;

    /**
     * @var Environment $twig
     */
    protected $twig;

    /**
     * @var EntityManager $entityManager
     */
    protected $entityManager;

    /**
     * @var \Swift_Transport_EsmtpTransport$transport
     */
    protected $transport;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->mailer = $this->container->get('swiftmailer.mailer.default');

        $this->transport = $this->container->get('swiftmailer.mailer.default.transport.real');

        $this->twig = $this->container->get('twig');
        /**
         * @var EntityManager $entityManager
         */
        $this->entityManager = $this->container->get('doctrine.orm.default_entity_manager');
    }
    protected function __clone()
    {
    }

    protected function mail($emailTo, string $subject, string $body, $immediately = false)
    {
        try {
            $message = (new \Swift_Message())
                ->setFrom($this->sendFrom)
                ->setTo($emailTo)
                ->setSubject($subject)

                ->addPart(
                    $body,
                    'text/html'
                    //                    'charset=utf-8'
                );
            /*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'emails/registration.txt.twig',
                    array('name' => $name)
                ),
                'text/plain'
            )
            */
            if ($immediately) {
                $this->transport->send($message, $failures);
            } else {
                $this->mailer->send($message, $failures);
            }
        } catch (\Exception $exception) {
            //dump($exception);
        }
    }
}
