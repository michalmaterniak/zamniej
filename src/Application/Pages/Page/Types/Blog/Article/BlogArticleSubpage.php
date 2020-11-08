<?php
namespace App\Application\Pages\Page\Types\Blog\Article;

use App\Application\Pages\Page\PageSubpage;
use App\Services\Photos\Photo;
use App\Services\Photos\PhotoModify;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class BlogArticleSubpage
 * @package App\Application\Pages\Page\Types\Blog\Article
 * @method BlogArticleComponents getComponents() : BlogArticleComponents
 */
class BlogArticleSubpage extends PageSubpage
{
    /**
     * @var Photo $header
     */
    protected $header;

    public function __construct(BlogArticleComponents $components)
    {
        parent::__construct($components);
    }

    /**
     * @return Photo
     */
    public function getPhoto()
    {
        return $this->getComponents()->getPhoto()->createModelPhoto(
            $this->getSubpage()->getPhoto('header')
        );
    }

    /**
     * @return PhotoModify
     * @Groups({"resource"})
     */
    public function getHeader()
    {
        return $this->getPhoto()->getModifiedPhoto('fit', 870, 480);
    }
}
