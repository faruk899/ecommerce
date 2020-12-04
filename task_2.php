<?php
error_reporting(E_ALL & ~E_NOTICE);

include 'db_config.php';

require_once 'functions.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Task 2</title>
</head>
<body>
<div id="container">
    <div id="body">
        <div style="padding: 20px">
            <a href="index.php"><strong>Task 1</strong></a>
        </div>

        <article>
            <div class="height20"></div>
            <h4>Data</h4>
            <ul>
                <?php
                $res = fetchCategoryTreeList();
                foreach ($res as $r) {
                    echo  $r;
                }
                ?>
            </ul>
        </article>
    </div>
</div>
</body>
</html>
