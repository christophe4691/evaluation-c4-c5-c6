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
                <h2>Historique des mouvements</h2>
                <table class="table table-striped table-bordered">
                    <thead>
                            <tr>
                                <th>Date</th>
                                <th>Liste des mouvements</th>
                                <th>Articles</th>
                                <th>Quantité</th>
                            </tr>
                    </thead>
                    <tbody>
                        <?php

                            require 'database.php';
                            
                            $db = Database::connect();
                            $statement = $db->query('SELECT movements.date_time, movement_types.name AS movement_type, articles.name, movements.quantity 
                                                                            FROM ((movements
                                                                            INNER JOIN movement_types ON movements.movement_type_id = movement_types.id)
                                                                            INNER JOIN articles ON movements.article_id = articles.id)
                                                                            ORDER BY date_time DESC, movement_type DESC, name DESC, quantity DESC');
                            
                            while($historical = $statement->fetch())
                            {
                                echo '<tr>';
                                echo '<td>' . $historical['date_time'] . '</td>';
                                echo '<td>' . $historical['movement_type'] . '</td>';
                                echo '<td>' . $historical['name'] . '</td>';
                                echo '<td>' . $historical['quantity'] .'</td>';
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


