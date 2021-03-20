<?php

namespace App\Application\Links\GSCIndexes;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;

class ConvertFileToArray
{
    /**
     * @var ArrayCollection $array
     */
    protected $array;

    /**
     * @var File $file
     */
    protected $file;

    public function loadFile(File $file)
    {
        $this->file = $file;
    }

    public function getRecords()
    {
        $this->convertFile();
        return $this->array;
    }

    protected function convertFile()
    {
        $this->array = new ArrayCollection();

        if ($this->file->getRealPath()) {

            $nrRow = 1;
            $file = fopen($this->file->getRealPath(), 'r');

            while (($data = fgetcsv($file)) !== false) {
                if ($nrRow++ === 1) {
                    continue;
                }

                $this->array->add(
                    new class ($data[0], $data[1]) {
                        public $url;
                        public $datetime;

                        public function __construct(string $url, string $datetime)
                        {
                            $this->url = $url;
                            $this->datetime = new DateTime($datetime);
                        }
                    }
                );
            }

        }
    }
}
