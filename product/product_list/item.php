<?php
class Product {
  private $id;
  private $name;
  private $image;
  private $introduce;
  private $price;
  private $count;
 
  public function __construct($id, $name, $image, $introduce, $price) {
    $this->id = $id;
    $this->name = $name;
    $this->image = $image;
    $this->introduce = $introduce;
    $this->price = $price;
  }

  public function getId(){
    return $this->id;
  }

  public function getName(){
    return $this->name;
  }
  
  public function getImage(){
    return $this->image;
  }
  
  public function getIntroduce(){
    return $this->introduce;
  }

  public function getTaxIncludedPrice() {
    return floor($this->price * 1.08);
  }
  
  public function getOrderCount() {
    return $this->count;
  }
  
  public function setOrderCount($count) {
    $this->count = $count;
  }

  public function sum() {
    return $this->getTaxIncludedPrice() * $this->count;
  }

  

}
?>