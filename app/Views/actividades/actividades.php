<?= 
    $this->extend('layout/dashboard-layout');
    $this->section('content');    
?>


    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Actividades</h6>
            </div>

            <div class="card-body">
            
                <div class="table-responsive">
                    
                    <table border="0" cellspacing="5" cellpadding="5">
                        <tbody>
                            <tr>
                                <td style="font-weight: 700;">Filtrar por fecha</td>
                                <td style="font-weight: 700;">Desde:</td>
                                <td><input type="text" id="min" name="min"></td>
                                <td style="font-weight: 700;">Hasta:</td>
                                <td><input type="text" id="max" name="max"></td>
                            </tr>
                     
                        </tbody>
                    </table>

                    <table class="table table-bordered" id="tablaActividades" width="100%" cellspacing="0">
                        <thead>
                            <tr>                                
                                <th>Usuario </th>
                                <th>Fecha del Cambio </th>    
                                <th>Cambio </th>                                                                                                        
                            </tr>
                        </thead>
                        <tbody>   
                            <?php foreach($actividades as $actividades): ?>           
                                <?php  
                                    $fechaCambio= new DateTime($actividades['fechaCambio']);
                                ?>                                                             
                            <tr>                                                                
                                <td><?= $actividades['username'];?></td>
                                <td><?= $fechaCambio->format("Y-m-d");?></td>  
                                <td><?= $actividades['cambio'];?></td>                                                                                                                                                      
                            </tr>                           
                            <?php endforeach;?>               
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!--SCRIPT PARA HACER DATATABLE LA TABLA -->
    <script language= javascript type= text/javascript>      
        var minDate, maxDate; 
        
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                var min = minDate.val();
                var max = maxDate.val();    
                var date = new Date( data[2] );  
                if (
                    ( min === null && max === null ) ||
                    ( min === null && date <= max ) ||
                    ( min <= date   && max === null ) ||
                    ( min <= date   && date <= max )
                ) {
                    return true;
                }
                return false;
            }
        );
 
        $(document).ready(function() {
            // Create date inputs
            minDate = new DateTime($('#min'), {
                format: 'YYYY-MM-DD'
            });
            maxDate = new DateTime($('#max'), {
                format: 'YYYY-MM-DD'
            });

            // DataTables initialisation
            var table = $("#tablaActividades").DataTable({
                            columnDefs:[{
                            targets: "_all"        
                            }],
                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                            }                                
                        });
            // Refilter the table
            $('#min, #max').on('change', function () {
                table.draw();
            });
        });


    </script>

<?= 
    $this->endSection();
?>
