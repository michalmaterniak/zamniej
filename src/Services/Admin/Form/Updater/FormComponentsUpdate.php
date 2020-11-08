<?php
namespace App\Services\Admin\Form\Updater;

use App\Services\Admin\Form\Updater\Fields\Complex\PhotoUpdater;
use App\Services\Admin\Form\Updater\Fields\Interfaces\FiledResourceUpdater;
use App\Services\Admin\Form\Updater\Fields\SimpleUpdater;

class FormComponentsUpdate
{
    /**
     * @var SimpleUpdater $simpleUpdater
     */
    protected $simpleUpdater;

    /**
     * @var PhotoUpdater $photoUpdater
     */
    protected $photoUpdater;



    public function getUpdater(string $type) : FiledResourceUpdater
    {
        switch ($type) {
            case 'photo':
                return $this->photoUpdater;
            default:
                return $this->simpleUpdater;
        }
    }

    /**
     * @return SimpleUpdater
     */
    public function getSimpleUpdater(): SimpleUpdater
    {
        return $this->simpleUpdater;
    }

    /**
     * @param SimpleUpdater $simpleUpdater
     * @required
     */
    public function setSimpleUpdater(SimpleUpdater $simpleUpdater): void
    {
        $this->simpleUpdater = $simpleUpdater;
    }

    /**
     * @return PhotoUpdater
     */
    public function getPhotoUpdater(): PhotoUpdater
    {
        return $this->photoUpdater;
    }

    /**
     * @param PhotoUpdater $photoUpdater
     * @required
     */
    public function setPhotoUpdater(PhotoUpdater $photoUpdater): void
    {
        $this->photoUpdater = $photoUpdater;
    }
}
