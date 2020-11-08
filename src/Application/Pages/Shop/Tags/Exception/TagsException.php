<?php
namespace App\Application\Pages\Shop\Tags\Exception;

class TagsException extends \ErrorException
{
    public static function tagExist()
    {
        return new self("Podany tag już istnieje");
    }

    public static function tagisNotDefinedInRequest()
    {
        return new self("Tag nie został zdefiniowany");
    }
}
