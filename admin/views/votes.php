
<?php
    ob_start();
?>
<div class='container'>
    <h3>votes</h3>
    
    <div class='text-center'>
      <a href='votes/ajouter' class='btn btn-info btn-rounded btn-sm'>Nouveau<i
          class='fas fa-plus-square ml-1'></i></a>
    </div>
    <table id='dt-less-columns' class='table table-striped table-bordered' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th class="th-sm">utilisateurs_id</th>
                <th class="th-sm">cours_id</th>
                <th class="th-sm">promotions_id</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
                for($i = 0; $i < count($data); $i++){
            ?>
                <tr>
                    <td><?=$data[$i]["utilisateurs_id"]?></td>
                    <td><?=$data[$i]["cours_id"]?></td>
                    <td><?=$data[$i]["promotions_id"]?></td>        <td>
                        <a href="votes/modifier/<?=$data[$i]["id"]?>" class="btn btn-outline-success btn-sm m-0 waves-effect"><i class="fas fa-edit" aria-hidden="true"></i></a>
                        <a href="controllers/votes.php?action=delete&id=<?=$data[$i]["id"]?>" class="btn btn-outline-danger btn-sm m-0 waves-effect"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>
            <?php
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
        
                <th>utilisateurs_id</th>
                <th>cours_id</th>
                <th>promotions_id</th>
            <th>Actions</th>
            </tr>
        </tfoot>
  </table>
</div>
<?php
    $content = ob_get_clean();
    require_once 'includes/template.php';