<?php
namespace App\Application\Pages\Page\Types\Shops\Seo\Methods;

use App\Application\Pages\Resource\Seo\Methods\PageSeoMethod as GlobalPageSeoMethod;

/**
 * Class PageSeoMethod
 * @package App\Application\Pages\Page\Types\Shops\Seo\Methods
 */
class LetterSeoMethod extends GlobalPageSeoMethod
{
    protected $name = 'letter';

    /**
     * @param null $value
     * @return string
     */
    public function getValue($value = null): string
    {
        $letter = $this->requestData->getValue($this->name);
        $matches = null;
        if (strlen($letter) === 1 && preg_match_all('/^([a-z]|[A-Z]|[0-9])$/', $letter, $matches)) {
            if ($this->requestData->checkIfExist($this->name)) {
                switch ($this->requestData->getValue($this->name)) {
                    case '0' :
                        return '\'0-9\'';
                    default :
                        return '\'' . mb_strtoupper($this->requestData->getValue($this->name)) . '\'';
                }

            }
        }
        return '';
    }
}
