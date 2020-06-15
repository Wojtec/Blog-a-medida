<?php
   echo '
   <form action="' . constant("URL") . 'dashboard/filterPosts" " method="get">
   <select name="category_id">';

        foreach($this->categories as $category){
            echo '
            <option value="'.$category->category_id.'"> '. $category->category_name .'</option>';

        }
     echo ' </select> 
     <input type="submit">
        </form>
            <hr>';

?>