<?php
/**
 * categoryEntity.php
 * @author elapp
 */
class CategoryEntity {

    protected $idCategory;

    protected $name;

    function getIdCategory() { 
        return $this->idCategory; 
    } 

    function setIdCategory($idCategory) {  
        $this->idCategory = $idCategory; 
    } 

    function getName() { 
            return $this->name; 
    } 

    function setName($name) {  
        $this->name = $name; 
    } 
}
	
?>