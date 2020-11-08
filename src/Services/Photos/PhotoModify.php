<?php
namespace App\Services\Photos;

use App\Entity\Entities\System\Files;
use Symfony\Component\Serializer\Annotation\Groups;

class PhotoModify
{
    /**
     * @var Files $original
     * @Groups({"resource"})
     */
    protected $original;

    /**
     * @var string $modifyPath
     * @Groups({"resource"})
     */
    protected $modifyPath;

    /**
     * PhotoModify constructor.
     * @param Files  $original
     * @param string $modifyPath
     */
    public function __construct(Files $original, string $modifyPath)
    {
        $this->original = $original;
        $this->modifyPath = $modifyPath;
    }

    /**
     * @return string
     */
    public function getModifyPath(): string
    {
        return $this->modifyPath;
    }

    /**
     * @return Files
     */
    public function getOriginal(): Files
    {
        return $this->original;
    }
}
