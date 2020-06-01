
<?php
    ob_start();
?>
<div class='container'>
    <h3>utilisateurs</h3>
    
    <div class='text-center'>
      <a href='utilisateurs/ajouter' class='btn btn-info btn-rounded btn-sm'>Nouveau<i
          class='fas fa-plus-square ml-1'></i></a>
    </div>
    <table id='dt-less-columns' class='table table-striped table-bordered' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th class="th-sm">nom_complet</th>
                <th class="th-sm">login</th>
                <th class="th-sm">password</th>
                <th class="th-sm">email</th>
                <th class="th-sm">categorie_id</th>
                <th class="th-sm">domaine_id</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
                for($i = 0; $i < count($data); $i++){
            ?>
                <tr>
                    <td><?=$data[$i]["nom_complet"]?></td>
                    <td><?=$data[$i]["login"]?></td>
                    <td><?=$data[$i]["password"]?></td>
                    <td><?=$data[$i]["email"]?></td>
                    <td><?=$data[$i]["categorie_id"]?></td>
                    <td><?=$data[$i]["domaine_id"]?></td>        <td>
                        <a href="utilisateurs/modifier/<?=$data[$i]["id"]?>" class="btn btn-outline-success btn-sm m-0 waves-effect"><i class="fas fa-edit" aria-hidden="true"></i></a>
                        <a href="controllers/utilisateurs.php?action=delete&id=<?=$data[$i]["id"]?>" class="btn btn-outline-danger btn-sm m-0 waves-effect"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>
            <?php
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
        
                <th>nom_complet</th>
                <th>login</th>
                <th>password</th>
                <th>email</th>
                <th>categorie_id</th>
                <th>domaine_id</th>
            <th>Actions</th>
            </tr>
        </tfoot>
  </table>
</div>
<?php
    $content = ob_get_clean();
    require_once 'includes/template.php';