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
        <div class="container site">
            <div class="row">
                <h1 class="text-logo">Stock Épicerie</h1>
                <h2><strong>Liste des articles </strong><a href="insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h2>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Article</th>
                            <th>Prix</th>                                  
                            <th>Action</th>
                        </tr>
                    </thead>
                        <?php

                            require 'database.php';
                            $db = Database::connect();
                           
                            $statement = $db->query('SELECT `name`, `sales_price` FROM `articles`');
                            
                            while($listItem = $statement->fetch())
                            {
                                echo '<tr>';
                                echo '<td>' . $listItem['name'] . '</td>';
                                echo '<td>' . $listItem['sales_price'] . '</td>';
                                echo '<td width="240">';
                                echo ' ';
                                echo '<a class="btn btn-primary" href="update.php?id=' . $listItem['id'] . '"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete.php?id=' . $listItem['id'] . '"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>'; 
                                echo '</td>';
                                echo '</tr>';
                            }
                            Database::disconnect();
                        ?>
                    </tbody>
                </table>
                <div class="form-actions">
                    <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                </div>
            </div>
        </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>