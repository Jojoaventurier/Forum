<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class User extends Entity{

    private $id;
    private $userName;
    private $password;
    private $registrationDate;
    private $role;

    public function __construct($data){         
        $this->hydrate($data);        
    }

    /**
     * Get the value of id
     */ 
    public function getId(){
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id){
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of nickName
     */ 
    public function getUserName(){
        return $this->userName;
    }

    /**
     * Set the value of nickName
     *
     * @return  self
     */ 
    public function setUserName($userName){
        $this->userName = $userName;

        return $this;
    }

    
    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;
        
        return $this;
    }
    
    /**
     * Get the value of registrationDate
     */ 
    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }
    
    /**
     * Set the value of registrationDate
     *
     * @return  self
     */ 
    public function setRegistrationDate($registrationDate)
    {
        $this->registrationDate = $registrationDate;
        
        return $this;
    }
    
    
    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }
    
    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;
        
        return $this;
    }
    
    public function __toString() {
        return $this->userName;
    }
    
    public function hasRole($role) {
        if ($role == "ROLE_ADMIN") {
            return true;
        } else {
            return false;
        }
    }
}