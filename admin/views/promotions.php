
<?php
    ob_start();
?>
<div class='container'>
    <h3>promotions</h3>
    
    <div class='text-center'>
      <a href='promotions/ajouter' class='btn btn-info btn-rounded btn-sm'>Nouveau<i
          class='fas fa-plus-square ml-1'></i></a>
    </div>
    <table id='dt-less-columns' class='table table-striped table-bordered' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th class="th-sm">designation</th>
                <th class="th-sm">domaines_id</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
                for($i = 0; $i < count($data); $i++){
            ?>
                <tr>
                    <td><?=$data[$i]["designation"]?></td>
                    <td><?=$data[$i]["domaines_id"]?></td>        <td>
                        <a href="promotions/modifier/<?=$data[$i]["id"]?>" class="btn btn-outline-success btn-sm m-0 waves-effect"><i class="fas fa-edit" aria-hidden="true"></i></a>
                        <a href="controllers/promotions.php?action=delete&id=<?=$data[$i]["id"]?>" class="btn btn-outline-danger btn-sm m-0 waves-effect"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>
            <?php
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
        
                <th>designation</th>
                <th>domaines_id</th>
            <th>Actions</th>
            </tr>
        </tfoot>
  </table>
</div>
<?php
    $content = ob_get_clean();
    require_once 'includes/template.php';