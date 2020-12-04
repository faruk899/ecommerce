<?php

function fetchCategoryTreeList($parent = 1, $user_tree_array = '') {


    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ecommerce";

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT DISTINCT cr.ParentcategoryId
            FROM category c
            INNER JOIN  catetory_relations cr ON c.id = cr.ParentcategoryId
            ORDER BY cr.ParentcategoryId ASC";

    $query = $conn->query($sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_object($query)) {

//            var_dump('aaaa');
//            var_dump($row);
//            echo "<br/>";

            $sql2 = "SELECT c.id category_id, c.Name category_name, cr.ParentcategoryId
            FROM category c
            INNER JOIN  catetory_relations cr ON c.id = cr.ParentcategoryId
            WHERE 1 AND cr.ParentcategoryId = $row->ParentcategoryId
            GROUP BY cr.ParentcategoryId
            ORDER BY category_id ASC";

            $query2 = $conn->query($sql2);
            if (mysqli_num_rows($query2) > 0) {
                $user_tree_array[] = "<ul>";
                while ($row2 = mysqli_fetch_object($query2)) {

                    print_r($row2);
                    echo "<br/>";

                    $user_tree_array[] = "<li>" . $row2->name . "</li>";
                    $user_tree_array = fetchCategoryTreeList($row2->category_id, $user_tree_array);
                }
                $user_tree_array[] = "</ul>";
            }
        }
    }


    if (!is_array($user_tree_array))
    $user_tree_array = array();


  return $user_tree_array;
}
?>