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


?>

<div class="container">
    </br></br>
    <legend>Roles</legend>
    </br></br>
    <form method="POST" action="./add">
        <input type="submit" name="ok" value="Ajouter un rôle.." >
    </form>
    </br></br></br></br>
    <table class="table  table-bordered">
        <tr>
            <th>Name <a href="?col=1&tri=up"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></a>
                <a href="?col=1&tri=down"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></a>
            </th>
            <th>Nb Users <a href="?col=2&tri=up"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></a>
                <a href="?col=2&tri=down"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></a></th>
            <th>Actions</th>
        </tr>
        <?php

        if(!isset($_GET['col'])||!isset($_GET['tri'])){
            $stmt = $dbh->prepare('SELECT name, count(idrole), role.id FROM role JOIN user ON user.idrole = role.id GROUP BY role.id, name ORDER by name');
        }else{
            if($_GET['col']=='1'){
                if($_GET['tri']=='up'){
                    $stmt = $dbh->prepare('SELECT name, count(idrole), role.id FROM role JOIN user ON user.idrole = role.id GROUP BY role.id, name ORDER by name');
                }else{
                    $stmt = $dbh->prepare('SELECT name, count(idrole), role.id FROM role JOIN user ON user.idrole = role.id GROUP BY role.id, name ORDER by name desc');
                }

            }else{
                if($_GET['tri']=='up'){
                    $stmt = $dbh->prepare('SELECT name, count(idrole), role.id FROM role JOIN user ON user.idrole = role.id GROUP BY role.id, name ORDER by count(idrole)');
                }else{
                    $stmt = $dbh->prepare('SELECT name, count(idrole), role.id FROM role JOIN user ON user.idrole = role.id GROUP BY role.id, name ORDER by count(idrole) desc');
                }
            }

        }

        $stmt->execute();
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo '<tr><td> '.$result['name'].'<br></td><td> '.$result['count(idrole)'].'<br></td><td><a href="./show?id='.$result['id'].'"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a><a href="./update?id='.$result['id'].'"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a><a href="./delete?id='.$result['id'].'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></tr>';
        };

        ?>
    </table>
</div>
