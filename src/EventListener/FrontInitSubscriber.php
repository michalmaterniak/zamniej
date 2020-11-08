<?php
namespace App\EventListener;

use App\Application\SiteWide\InitFront;
use App\Twig\TemplateVars;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class FrontInitSubscriber implements EventSubscriberInterface
{
    /**
     * @var InitFront $initFront
     */
    protected $initFront;

    /**
     * @var TemplateVars $templateVars
     */
    protected $templateVars;
    /**
     * FrontInitSubscriber constructor.
     * @param InitFront    $initFront
     * @param TemplateVars $templateVars
     */
    public function __construct(
        InitFront       $initFront,
        TemplateVars    $templateVars
    ) {
        $this->initFront = $initFront;
        $this->templateVars = $templateVars;
    }

    public static function getSubscribedEvents() : array
    {
        // return the subscribed events, their methods and priorities
        return [
            KernelEvents::REQUEST => [
                ['requestStart', 1],
            ],
        ];
    }

    public function requestStart(RequestEvent $requestEvent)
    {
        if ($requestEvent->isMasterRequest() && $requestEvent->getRequest()->headers->get('initfront')) {
            $this->templateVars->insert('initFront', $this->initFront->getInitFront());
        }
    }
}
