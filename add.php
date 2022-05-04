<?php

    include('./config/db_connect.php');

    $email = $title = $features = $price = '';
    
    // if(isset($_GET['submit'])) {
    //     echo $_GET['email'];
    //     echo $_GET['title'];
    //     echo $_GET['features'];
    //     echo $_GET['price'];
    // };
   
    $errors = array(
        'email' => '', 
        'title' => '',
        'features' => '',
        'price' => ''
    ); 
    
    if(isset($_POST['submit'])) {
        if (empty($_POST['email'])) {
            $errors['email'] = 'Please enter a valid email!';
        } else {
            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Please enter a valid email!';
            } 
        }
        
        if (empty($_POST['title'])) {
            $errors['title'] = 'Title is required!';
        } else {
            $title = $_POST['title'];
        }
        
        if (empty($_POST['features'])) {
            $errors['features'] = 'At lease one feature is required!';
        } else {
           $features = $_POST['features'];
        }
        
        if (empty($_POST['price'])) {
            $errors['price'] = 'Price is required!';
        } else {
            $price = $_POST['price'];
        };

        // if($errors['email'] == '' && $errors['title'] == '' && $errors['features'] == '' && $errors['price'] == '') {
        //     echo 'new pizza submited!';
        //     header('Location: /');
        // }

        if(!array_filter($errors)) {
            // save data in the database

            $email = mysqli_real_escape_string($dbConnection, $_POST['email']);
            $title = mysqli_real_escape_string($dbConnection, $_POST['title']);
            $features = mysqli_real_escape_string($dbConnection, $_POST['features']);
            $price = mysqli_real_escape_string($dbConnection, $_POST['price']);
            
            // create a query to add data into db
            $sql = "INSERT INTO products(email, title, features, price) VALUES('$email', '$title', '$features', '$price')";

            // save to db and check

            if(mysqli_query($dbConnection, $sql)) {
                // redirect if saved in db
                header('Location: index.php');
            } else {
                // error when not saved in db
                echo "query error: " . mysqli_error($dbConnection);
            }

        } 

        
    };

?>
<!DOCTYPE html>
<html lang="en">

<?php include('./components/header.php') ?>

<section>
    <div class="container">
        <h4 class="h4 pt-3 text-center">Add your product</h4>
        <form action="add.php" method="POST">

            <div class="mb-3">
                <label class="form-label" for="email">Your Email:</label>
                <input class="form-control" id="email" type="email" name="email"
                    value="<?php echo htmlspecialchars($email) ;?>">
                <?php if($errors['email'] != '') { ;?>
                <div class="alert alert-warning mt-1">
                    <?php echo $errors['email']; ?>
                </div>
                <?php }; ?>
            </div>

            <div class="mb-3">
                <label class="form-label" for="title">Product title:</label>
                <input class="form-control" id="title" type="text" name="title"
                    value="<?php echo htmlspecialchars($title); ?>">

                <?php if($errors['title'] != '') { ;?>
                <div class="alert alert-warning mt-1">
                    <?php echo $errors['title']; ?>
                </div>
                <?php }; ?>

            </div>

            <div class="mb-3">
                <label class="form-label" for="features">Product Features (comma separatred):</label>
                <input class="form-control" id="features" type="text" name="features"
                    value="<?php echo htmlspecialchars($features); ?>">
                <?php if($errors['features'] != '') { ;?>
                <div class=" alert alert-warning mt-1">
                    <?php echo $errors['features']; ?>
                </div>
                <?php }; ?>
            </div>

            <div class="mb-3">
                <label class="form-label" for="price">Product Price:</label>
                <input class="form-control" id="price" type="number" name="price"
                    value="<?php echo htmlspecialchars($price) ;?>">
                <?php if($errors['price'] != '') { ;?>
                <div class=" alert alert-warning mt-1">
                    <?php echo $errors['price']; ?>
                </div>
                <?php }; ?>
            </div>

            <input class="btn btn-secondary" type="submit" name="submit">
        </form>
    </div>
</section>

<?php include('./components/footer.php') ?>

</html>
