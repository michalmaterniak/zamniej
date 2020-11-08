<?php
namespace App\Twig;

use App\Twig\Interfaces\TemplateInterface;
use Doctrine\Common\Collections\ArrayCollection;

class TemplateVars implements TemplateInterface
{
    /**
     * @var ArrayCollection $vars
     */
    protected $vars;

    public function __construct()
    {
        $this->vars = new ArrayCollection();
    }

    public function insert(string $key, $value) : void
    {
        $this->vars->set($key, $value);
    }

    /**
     * @return ArrayCollection
     */
    public function getVars(): ArrayCollection
    {
        return $this->vars;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getVar(string $key)
    {
        return $this->getVars()->get($key);
    }
}
