<?php
class Category {

    public $category_id;
    public $category_name;

    function __costruct($category_id,$category_name){
        $this->category_id = $category_id;
        $this->category_name = $category_name;
    }
}
?>