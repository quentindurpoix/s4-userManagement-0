<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<?php
/**
 * Created by PhpStorm.
 * User: Coco
 * Date: 18/01/2017
 * Time: 14:14
 */

$dbh = new PDO('mysql:host=localhost;dbname=phalcon-td0', 'root','');
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }else{
        $id=0;
    }

?>

<div class="container">
    </br></br>
    <legend>Role</legend>
    </br></br>
    <form method="POST" action="./">
        <input type="submit" name="ok" value="Voir tout les roles" >
    </form>
    </br></br></br></br>
    <table class="table  table-bordered">
        <tr>
            <th>Name</th>
            <th>Nb Users</th>
            <th>Actions</th>
        </tr>
        <?php

        $stmt = $dbh->prepare('SELECT name, count(idrole), role.id FROM role JOIN user ON user.idrole = role.id where role.id='.$id.' GROUP BY role.id, name');
        $stmt->execute();
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo '<tr><td> '.$result['name'].'<br></td><td> '.$result['count(idrole)'].'<br></td><td><a href="./update?id='.$result['id'].'"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a><a href="./delete?id='.$result['id'].'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></tr>';
        };

        ?>
    </table>
</div>
