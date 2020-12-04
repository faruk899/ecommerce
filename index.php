<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
</head>
<body>

<div style="padding: 20px">
    <a href="task_2.php"><strong>Task 2</strong></a>
</div>

<?php
include 'db_config.php';

$sql = "SELECT c.id category_id, c.name category_name, count( i.Number ) product_count
FROM category c
INNER JOIN  item_category_relations icr ON c.id = icr.categoryId
INNER JOIN item i ON icr.ItemNumber = i.Number
GROUP BY c.Name
ORDER BY product_count DESC";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo '<table>';
    echo '<tr>';
    echo '<th>Category Name</th>';
    echo '<th>Total Items</th>';
    echo '</tr>';

    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row["category_name"] . '</td>';
        echo '<td>' . $row["product_count"] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo "0 results";
}

$conn->close();
?>

</body>
</html>