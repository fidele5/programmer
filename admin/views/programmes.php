<?php
    ob_start();
?>
<!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <select id="promotion" class="form-control">
                              <option value="prepa">Preparatoire</option>
                              <option value="G1">G1</option>
                              <option value="G2">G2</option>
                              <option value="G3">G3</option>
                            </select>
                            <div class="table-responsive mb-4 mt-4">
                                <table id="html5-extension" class="table table-hover non-hover" style="width:125%">
                                    <thead>
                                        <tr>
                                            <th>Numero</th>
                                            <th>Intitule</th>
                                            <th>Voume horaire</th>
                                            <th>Categorie</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <script>
              var combo = document.getElementById('promotion');
              var selected = combo.value;
              var programme = <?=json_encode($programme)?>;
              var body = document.getElementById('table-body');
              var table = document.getElementById('html5-extension');

              var load_values = function(selection){

                const cours = programme[selection];
                const length = cours.length;
                table.removeChild(body);
                body = document.createElement("tbody");
                body.id = "table-body";
                table.append(body);

                for(var i=0; i<length; i++)
                {
                  var row = document.createElement('tr');
                  var col1 = document.createElement('td');
                  col1.appendChild(document.createTextNode(i+1));
                  row.appendChild(col1);
                  var col2 = document.createElement('td');
                  col2.appendChild(document.createTextNode(cours[i]["intitule"]));
                  row.appendChild(col2);
                  var col3 = document.createElement('td');
                  col3.appendChild(document.createTextNode(cours[i]["volhoraire"]));
                  row.appendChild(col3);
                  var col4 = document.createElement('td');
                  col4.appendChild(document.createTextNode(cours[i]["categorie_id"]));
                  row.appendChild(col4);
                  body.appendChild(row);
                }
              }

              load_values(selected);

              combo.addEventListener('change', function() {
                  load_values(this.value);
              }, true);

            </script>
<?php
    $content = ob_get_clean();
    require_once 'includes/template.php';