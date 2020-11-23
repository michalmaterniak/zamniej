<?php

namespace App\Services\System\EntityServices\Updater;

class SimpleEntityUpdater extends EntityUpdater
{
    public function update(array $properties)
    {
        $this->properties = $properties;
        foreach ($this->properties as $key => $property) {
            $setter = $this->getSetterMethod($key);
            if ($setter)
                $this->updateValue($property, $setter);
        }
    }
}
