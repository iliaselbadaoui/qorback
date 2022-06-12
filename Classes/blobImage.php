<?php

class blobImage
{
    private $file;
    private $binaryContent;
    private $properties;
    private $type;

    /**
     * @param $nativeFile
     */
    public function __construct($nativeFile)
    {
        $this->file = $nativeFile;
        $this->binaryContent = addslashes(file_get_contents($nativeFile));
        $this->properties = getimagesize($nativeFile);
        $this->type = $this->properties['mime'];
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return string
     */
    public function getBinaryContent(): string
    {
        return $this->binaryContent;
    }

    /**
     * @return array|false
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }



}