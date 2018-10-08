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
                <h2>Saisie de mouvement</h2>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Type de mouvement</th>
                            <th>Sens du mouvement</th>
                            <th>Article</th>
                            <th>Quantité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            require 'database.php';

                            $db = Database::connect();
                            $statement = $db->query('SELECT articles.name, directions.name AS direction, movement_types.name AS movement_type, articles.name, movements.quantity 
                                                                            FROM ((movement_types
                                                                            INNER JOIN directions ON movement_types.direction_id = directions.id)
                                                                            INNER JOIN articles ON movement_types.id = articles.id)
                                                                            INNER JOIN movements ON movement_types.id = movements.id');
                                                                                 
                            while($motionCapture = $statement->fetch())
                            {
                                echo '<tr>';
                                echo '<td>' . $motionCapture['movement_type'] . '</td>';
                                echo '<td>' . $motionCapture['direction'] . '</td>';
                                echo '<td>' . $motionCapture['name'] . '</td>';
                                echo '<td>' . $motionCapture['quantity'] . '</td>';
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