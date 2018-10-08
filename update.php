<?php

    require 'database.php';

    if(!empty($_GET['id']))
    {
            $id = checkInput($_GET['id']);
    }

    $nameError = $descriptionError = $priceError = $categoryError = $name = $description = $price = $category = "";

    if(!empty($_POST))
    {
        $name = checkInput($_POST['name']);
        $description = checkInput($_POST['description']);
        $price = checkInput($_POST['price']);
        $category = checkInput($_POST['category']);
        $isSuccess = true;

        if(empty($name))
        {
            $nameError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($description))
        {
            $descriptionError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($price))
        {
            $priceError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($category))
        {
            $categoryError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }

            if($isSuccess)
            {
                $db = Database::connect();
                if($isImageUpdated)
                {
                    $statement = $db->prepare("UPDATE items set name = ?, description = ?, price = ?, category = ?, WHERE id = ?");
                    $statement->execute(array($name,$description,$price,$category,$id));
                }
                else
                {
                    $statement = $db->prepare("UPDATE items set name = ?, description = ?, price = ?, category = ? WHERE id = ?");
                    $statement->execute(array($name, $description,$price,$category,$id));
                }
                Database::disconnect();
                header("Location: index.php");
            }

    }
    else
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM articless WHERE id = ?");
        $statement->execute(array($id));
        $item = $statement->fetch();
        $name = $item['name'];
        $description = $item['description'];
        $price = $item['price'];
        $category = $item['category'];
        Database::disconnect();
    }

    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Stock Épicerie</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale-1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type="text/css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container admin">
            <h1 class="text-logo">Stock Épicerie</h1>
            <div class="row">
                <div class="col-sm-6">
                    <h1><strong>Modifier un Article </strong></h1>
                    <br>
                    <form class="form" role="form" action="<?php echo 'update.php?id=' . $id; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Nom:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name; ?>">
                            <span class="help-inline"><?php echo $nameError; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description; ?>">
                            <span class="help-inline"><?php echo $descriptionError; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="price">Prix: (en €)</label>
                            <input type="number"  step="0.01" class="form-control" id="price" name="price" placeholder="Prix" value="<?php echo $price; ?>">
                            <span class="help-inline"><?php echo $priceError; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="category">Catégorie:</label>
                            <select class="form-control" id="category" name="category">
                                <?php
                                    $db = Database::connect();
                                    foreach ($db->query('SELECT * FROM categories') as $row)
                                    {
                                        if($row['id'] == $category)
                                            echo '<option selected="selected" value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                        else
                                            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';	
                                    }
                                    Database::disconnect();
                                ?>	
                            </select>
                            <span class="help-inline"><?php echo $categoryError; ?></span>
                            </div>
                            <br>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                                <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                            </div>	
                    </form>
                </div>  
            </div>
        </div>
    </body>
</html>




