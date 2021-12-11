<?php
/**
 * productEntity.php
 * @author elapp
 */
class ProductEntity{

    protected $idProduct;

    protected $brand;

    protected $name;

    protected $description;

    protected $color;

    protected $price;

    protected $stock;

    protected $category;

    protected $image;
    
    protected $createdAt;

    function getIdProduct() { 
        return $this->idProduct; 
    } 

    function setIdProduct($idProduct) {  
        $this->idProduct = $idProduct; 
    }
   
    function getBrand() { 
        return $this->brand; 
    } 

    function setBrand($brand) {  
        $this->brand = $brand; 
    } 

    function getName() { 
        return $this->name; 
    } 

    function setName($name) {  
        $this->name = $name; 
    } 

    function getDescription() { 
        return $this->description; 
    } 

    function setDescription($description) {  
        $this->description = $description; 
    } 

    function getColor() { 
        return $this->color; 
    } 

    function setColor($color) {  
        $this->color = $color; 
    } 

    function getPrice() { 
        return $this->price; 
    } 

    function setPrice($price) {  
        $this->price = $price; 
    } 

    function getStock() { 
        return $this->stock; 
    } 

    function setStock($stock) {  
        $this->stock = $stock; 
    } 

    function getCategory() { 
        return $this->Category; 
    } 

    function setCategory($Category) {  
        $this->Category = $Category; 
    } 

    function getImage() { 
        return $this->image; 
    } 

    function setImage($image) {  
        $this->image = $image; 
    } 

    function getCreatedAt() { 
        return $this->createdAt; 
    } 

    function setCreatedAt($createdAt) {  
        $this->createdAt = $createdAt; 
    } 

}


?>