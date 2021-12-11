<?php
/**
 * userEntity.php
 * @author elapp
 */
class UserEntity{

    protected $idUser;

    protected $gender;

    protected $pseudo;
    
    protected $lastname;
    
    protected $firstname;
    
    protected $description;
    
    protected $birthDate;
    
    protected $deliveryAddress;

    protected $billingAddress;

    protected $tel;

    protected $mobile;

    protected $email;

    protected $password;
    
    protected $createdAt;

    function getIdUser() { 
        return $this->idUser; 
    } 

    function setIdUser($idUser) {  
        $this->idUser = $idUser; 
    } 

    function getGender() { 
        return $this->gender; 
    } 

    function setGender($gender) {  
        $this->gender = $gender; 
    } 

    function getPseudo() { 
        return $this->pseudo; 
    } 

    function setPseudo($pseudo) {  
        $this->pseudo = $pseudo; 
    } 

    function getLastname() { 
        return $this->lastname; 
    } 

    function setLastname($lastname) {  
       $this->lastname = $lastname; 
    } 

    function getFirstname() { 
        return $this->firstname; 
    } 

    function setFirstname($firstname) {  
       $this->firstname = $firstname; 
    } 

    function getDescription() { 
        return $this->description; 
    } 

    function setDescription($description) {  
        $this->description = $description; 
    } 

    function getBirthDate() { 
        return $this->birthDate; 
    } 

    function setBirthDate($birthDate) {  
        $this->birthDate = $birthDate; 
    } 

    function getDeliveryAddress() { 
        return $this->deliveryAddress; 
    } 
    
    function setDeliveryAddress($deliveryAddress) {  
        $this->deliveryAddress = $deliveryAddress; 
    } 
    
    function getBillingAddress() { 
        return $this->billingAddress; 
    } 
    
    function setBillingAddress($billingAddress) {  
        $this->billingAddress = $billingAddress; 
    }

    function getTel() { 
        return $this->tel; 
    } 

    function setTel($tel) {  
        $this->tel = $tel; 
    } 

    function getMobile() { 
        return $this->mobile; 
    } 

    function setMobile($mobile) {  
        $this->mobile = $mobile; 
    } 

    function getEmail() { 
        return $this->email; 
    } 

    function setEmail($email) {  
        $this->email = $email; 
    } 

    function getPassword() { 
        return $this->password; 
    } 

    function setPassword($password) {  
       $this->password = $password; 
    }  

    function getCreatedAt() { 
        return $this->createdAt; 
    } 

    function setCreatedAt($createdAt) {  
       $this->createdAt = $createdAt; 
    }

}



	

	
?>