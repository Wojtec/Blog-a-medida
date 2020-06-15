<?php
require_once 'models/entities/category.php';

class categorymodel extends model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCategoryById($category_id)
    {
        try
        {
            $query = $this->db->connect()->query('select * from categories where category_id = ' . $category_id . '');
            $row = $query->fetch();
            $category = new category();
            $category->category_id = $row['category_id'];
            $category->category_name = $row['category_name'];
            return $category;
        }
        catch(PDOException $e)
        {
            echo "sql error " . $e.getMessage();
            return null;
        }
    }

    public function getCategories()
    {
        $categories = [];

        try
        {
            $query = $this->db->connect()->query('
            select * from categories;');

            if (!$query) return [];
            
            while($row = $query->fetch()){
                $category = new category();
                $category->category_id = $row['category_id'];
                $category->category_name = $row['category_name'];
                array_push($categories, $category);
            }

            return $categories;
        }
        
        catch(PDOException $e)
        {
            echo "sql error " . $e.getMessage();
            return [];
        }
    }

    public function editCategory($categoryId, $categoryName)
    {
        try
        {
            $query = $this->db->connect()->prepare('update categories set category_name = "' . $categoryName . '" where category_id = ' . intval($categoryId) . '');

            $query->execute();
        }
        catch(PDOException $e)
        {
            echo "sql error " . $e.getMessage();
        }
    }

    public function removeCategory($categoryId)
    {
        try
        {
            $query = $this->db->connect()->prepare('delete from categories where category_id = ' . intval($categoryId) . '');

            $query->execute();
        }
        catch(PDOException $e)
        {
            echo "sql error " . $e.getMessage();
        }
    }

    public function createCategory($categoryName)
    {
        try
        {
            $qstr = 'insert into categories (category_name) values ("' . $categoryName . '")';
            $query = $this->db->connect()->prepare($qstr);

            $query->execute();
        }
        catch(PDOException $e)
        {
            echo "sql error " . $e.getMessage();
        }
    }
}

?>