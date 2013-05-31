<?php

// src/Walker/Entity/Article.php
namespace Nuup\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;


/** @ODM\Document(collection="users") */
class User {
    
    /** @ODM\Id */
    private $id;

    /** @ODM\String */
    private $username;

    /** @ODM\String */
    private $password;

    /** @ODM\String */
    private $email;

    /** @ODM\String */
    private $roles;


    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return self
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get username
     *
     * @return string $username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get password
     *
     * @return string $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set roles
     *
     * @param string $roles
     * @return self
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * Get roles
     *
     * @return string $roles
     */
    public function getRoles()
    {
        return $this->roles;
    }
}
