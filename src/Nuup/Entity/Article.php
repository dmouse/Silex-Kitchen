<?php

// src/Nuup/Entity/Article.php
namespace Nuup\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;


/** @ODM\Document(collection="articles") */
class Article {
    
    /** @ODM\Id */
    private $id;

    /** @ODM\String */
    private $title;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function __toString(){
        return $this->title;
    }

}
