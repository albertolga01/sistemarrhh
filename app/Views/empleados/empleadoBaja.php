<?= 
    $this->extend('layout/dashboard-layout');
    $this->section('content');    
?>


    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Empleados dados de Baja</h6>
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
                    
                    <table class="table table-bordered" id="tablaBajaEmpleados" width="100%" cellspacing="0">
                        <thead>
                            <tr>                                
                                <th>Nombre </th>
                                <th>Area </th>    
                                <th>Puesto </th>
                                <th>Fecha Baja </th>  
                                <th>Editar </th> 
                                <th>Alta</th>                                                        
                            </tr>
                        </thead>
                        <tbody>  
                            <?php foreach($empleados as $empleados): ?>         
                                <?php  
                                    $fechaBaja= new DateTime($empleados['fechaBaja']);
                                ?>                                      
                            <tr>                                
                                <td><?= $empleados['nombre'];?></td>
                                <td><?= $empleados['area'];?></td>
                                <td><?= $empleados['puesto'];?></td> 
                                <td><?= $fechaBaja->format("Y-m-d");?></td> 
                                <td>                                                     
                                   <a href="<?= base_url('editEmpleado/'.$empleados['id']);?>"><button type="submit" name="edit_btn"  class="btn btn-info"><i class="nav-icon fa fa-address-card "></i>  INFO</button></a>                           
                                </td>          
                                <td>                                             
                                    <button onclick="mensajeAlta('<?= base_url('altaEmpleado/'.$empleados['id']);?>')" type="submit" id="alta_btn" name="alta_btn" class="btn btn-success"> <i class="nav-icon fa fa-user-plus"></i>  ALTA</button>
                                </td>                     
                            </tr>   
                            <?php endforeach;?> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script language= javascript type= text/javascript>
        var minDate, maxDate; 
        
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                var min = minDate.val();
                var max = maxDate.val();    
                var date = new Date( data[3] );  
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
            var table = $("#tablaBajaEmpleados").DataTable({
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

        function mensajeAlta(url){
            console.log(url);
            Swal.fire({
                title:'Desea dar de Alta el Trabajador?',
                text:'El Trabajador pasara al apartado de Empleados!',
                icon:'warning',
                showCancelButton:true,
                cancelButtonColor: '#d33',
                confirmButtonText:'Si, Dar de Alta'
            }).then((result) =>{
                if(result.isConfirmed){
                    window.location.href = url;
                
                }
            });   
        }
    </script>

<?= 
    $this->endSection();
?>