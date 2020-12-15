<?php
namespace App\Entity\Traits;

use App\Entity\Entities\Homepages\Homepages;
use App\Entity\Entities\Subpages\Resources;
use ErrorException;

trait ControllersTraits
{
    protected static $controllers = null;
    protected static function parseResource($className)
    {
        $key = $className;
        $key = str_replace('App\Entity\Entities\\', '', $key);
        $key = str_replace('Translation', '', $key);
        $key = strtolower($key);
        $key = str_replace('\\', '_', $key);

        return $key;
    }
    protected static function setControllers()
    {
        static::$controllers = [];

        static::$controllers[static::parseResource(Homepages::class)] = [
            0 => 'Homepages\Homepages',
        ];
        static::$controllers[static::parseResource(Products::class)] = [
            0 => 'Products\Products',
        ];
        static::$controllers[static::parseResource(Categories::class)] = [
            0 => 'CategoriesType\CategoriesType',
        ];
        static::$controllers[static::parseResource(Producers::class)] = [
            0 => 'Producers\Producers',
        ];
        static::$controllers[static::parseResource(Shops::class)] = [
            0 => 'Shops\Shops',
        ];
    }

    public static function getController($resourceClass, ?int $controller = 0)
    {
        if (is_object($resourceClass) && $resourceClass instanceof Resources) {
            $resourceClass = get_class($resourceClass);
        }
        $resourceClass = static::parseResource($resourceClass);
        if (!static::$controllers) {
            static::setControllers();
        }

        if ($controller === null) {
            $controller = 0;
        }


        if (!empty(static::$controllers[$resourceClass][$controller])) {
            return static::$controllers[$resourceClass][$controller];
        } else {
            throw new ErrorException('controller not found');
        }
    }
    public static function getTypePage($resourceClass, ?int $controller = 0)
    {
        return str_replace('\\', '-', ControllersTraits::getController($resourceClass, $controller));
    }
}
