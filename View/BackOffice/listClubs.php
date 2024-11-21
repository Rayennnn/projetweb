<?php
include ('../../Controller/clubC.php');
$clubC = new Clubc();
$list = $clubC->getAllClubs();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <table border="1">
    <tr> 
        <th> ID </th>
        <th> Nom du Club </th>
        <th> Description </th> 
        <th> Date de Création </th> 
        <th> Catégorie </th> 
        <th> Lieu </th> 
        <th> Logo </th> 
        <th> Lien </th>
        <th> Action </th>

    </tr> 
    <?php 
        foreach ($list as $club)
    {
    ?>
    <tr>
        <td><?php echo $club['id_club']; ?></td>
        <td><?php echo $club['nom_club']; ?></td>
        <td><?php echo $club['description']; ?></td>
        <td><?php echo $club['date_creation']; ?></td>
        <td><?php echo $club['categorie']; ?></td>
        <td><?php echo $club['lieu']; ?></td>
        <td>
        <img src="<?php echo $club['logo']; ?>" alt="Logo indisponible" style="max-width: 100px; height: auto;">
        </td>
        <td><a href="<?php echo $club['lien']; ?>" target="_blank">Visiter</a></td>
        <td><a href="deleteClub.php?id_club=<?php echo $club['id_club']; ?>">Delete</a></td>
    </tr>
    <?php
    }
    ?>
</table>
    










</body>
</html>