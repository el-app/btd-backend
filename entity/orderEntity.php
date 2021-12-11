<?php
/**
 * orderEntity.php
 * @author elapp
 */
class OrderEntity{

    protected $idOrder;

    protected $idUser;

    protected $idProduct;

    protected $quantity;

    protected $price;
    
    protected $createdAt;

    function getIdOrder() { 
        return $this->idOrder; 
    } 

    function setIdOrder($idOrder) {  
        $this->idOrder = $idOrder; 
    } 

    function getIdUser() { 
        return $this->idUser; 
    } 

    function setIdUser($idUser) {  
        $this->idUser = $idUser; 
    } 

    function getIdProduct() { 
        return $this->idProduct; 
    } 

    function setIdProduct($idProduct) {  
        $this->idProduct = $idProduct; 
    } 

    function getQuantity() { 
        return $this->quantity; 
    } 

    function setQuantity($quantity) {  
        $this->quantity = $quantity; 
    } 

    function getPrice() { 
        return $this->price; 
    } 

    function setPrice($price) {  
        $this->price = $price; 
    } 

    function getCreatedAt() { 
        return $this->createdAt; 
    } 

    function setCreatedAd($createdAt) {  
        $this->createdAt = $createdAt; 
    } 

}

	
?>