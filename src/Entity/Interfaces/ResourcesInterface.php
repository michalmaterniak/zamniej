<?php
namespace App\Entity\Interfaces;

use App\Entity\Entities\Subpages\Resources;

interface ResourcesInterface
{
    /**
     * @return Resources
     */
    public function getResource(): Resources;

    /**
     * @param Resources $resource
     */
    public function setResource(Resources $resource): void;

    /**
     * @return int
     */
    public function getId() : int;

    /**
     * @return string
     */
    public function getName() : string;

    public function __construct(string $name);
}
