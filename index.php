<?php 

include('./config/db_connect.php');

// mysql query to select columns from table
$sql = 'SELECT id, title, features, email, price FROM products ORDER BY created_at';

// make query and get results mysqli_query(connection, query, resultmode)
$result = mysqli_query($dbConnection, $sql);

// fetch the resulting rows as an array
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

// clear the result from memory
mysqli_free_result($result);

// close the connection with the database
mysqli_close($dbConnection);

// print_r("<pre>");
// print_r($products);
// print_r("</pre>");

// https://www.youtube.com/watch?v=WGuyxGJW9hs&list=PL4cUxeGkcC9gksOX3Kd9KPo-O68ncT05o&index=26

?>
<!DOCTYPE html>
<html lang="en">

<?php include('./components/header.php') ?>

<div class="container">
    <div class="row">
        <h1 class="h1 pt-3 pb-3 text-center">Products</h1>
    </div>
    <div class="row">
        <?php foreach($products as $product) :?>
        <div class="col-sm-6 col-md-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold "><?php echo ucfirst(htmlspecialchars($product['title'])) ;?></h5>
                    <ul class="list-group list-group-flush">
                        <?php foreach(explode(',',$product['features']) as $feature) : ;?>
                        <li class="list-group-item ps-0">
                            <?php echo ucwords(htmlspecialchars($feature)) ;?>
                        </li>
                        <?php endforeach ;?>
                    </ul>
                    <p class="fw-bold card-text">Price: <?php echo htmlspecialchars($product['price']) ;?> PLN</p>
                    <a href="#" class=" btn btn-primary">More info</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>


<?php include('./components/footer.php') ?>

</html>
