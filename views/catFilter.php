
   <?php
   echo '
   <form action="' . constant("URL") . 'dashboard" " method="post">
   <select name="catFilter">';

        foreach($this->categories as $category){
            echo '
            <option value="'.$category->category_id.'"> '. $category->category_name .'</option>';

        }
     echo ' </select> 
     <input type="submit">
        </form>
            <hr>';

?>