<?php 

include ('config/db_connect.php');

    if(isset($_GET['id'])) {
        // assign an id from what the user enetered
        $id =  mysqli_real_escape_string($dbConnection, $_GET['id']);

        // make a sql query to get all columns of a product with the id
        $sql = "SELECT * FROM products WHERE id=$id";

        // make a query
        $results = mysqli_query($dbConnection, $sql);

        // change result to assoc array
        $product = mysqli_fetch_assoc($results);

        mysqli_free_result($results);
        mysqli_close($dbConnection);


    }

?>

<!DOCTYPE html>
<html lang="en">

<?php include('components/header.php'); ?>

<div class="container">
    <div class="row">
        <h1 class="h1 pt-3 pb-3 text-center">
            <?php echo htmlspecialchars($product['title']); ?>
        </h1>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-md-8 mb-4">
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
                    <small>
                        Created at
                        <?php echo htmlspecialchars($product['created_at']) ;?> by
                        <?php echo htmlspecialchars($product['email']) ;?>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('components/footer.php') ?>

</html>
