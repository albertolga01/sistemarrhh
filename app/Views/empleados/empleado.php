<?= 
    $this->extend('layout/dashboard-layout');
    $this->section('content');    
?>


    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Empleados
            
                    <a href="<?= base_url('crearEmpleado') ?>">
                        <button type="button" class="btn btn-success addUser">
                            <i class="nav-icon fas fa-user-plus"></i>   AGREGAR 
                        </button>
                    </a>                          
                </h6>
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

                    <table class="table table-bordered" id="tablaEmpleados" width="100%" cellspacing="0">
                        <thead>
                            <tr>                                
                                <th>Nombre </th>
                                <th>Area </th>    
                                <th>Puesto </th>
                                <th>Fecha Ingreso </th>  
                                <th>Editar </th> 
                                <th>Dar de Baja</th>                                                                                     
                            </tr>
                        </thead>
                        <tbody>  
                            <?php foreach($empleados as $empleados): ?>   
                                <?php  
                                    $fechaIngreso = new DateTime($empleados['fechaIngreso']);
                                ?>                                                                    
                            <tr>                                                                
                                <td><?= $empleados['nombre'];?></td>
                                <td><?= $empleados['area'];?></td>
                                <td><?= $empleados['puesto'];?></td> 
                                <td><?= $fechaIngreso->format("Y-m-d");?></td> 
                                <td>                                                     
                                   <a href="<?= base_url('editEmpleado/'.$empleados['id']);?>"><button type="submit" name="edit_btn" class="btn btn-info"><i class="nav-icon fa fa-address-card "></i>  EDITAR</button></a>                           
                                </td>          
                                <td>         
                                    <button onclick="mensajeBaja('<?= base_url('deleteEmpleado/'.$empleados['id']).'/'.session('id');?>')" type="submit" id="delete_btn" name="delete_btn" class="btn btn-danger"> <i class="nav-icon fa fa-user-times"></i>  BAJA</button>
                                </td>                                                     
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
            var table = $("#tablaEmpleados").DataTable({
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

        function mensajeBaja(url){
            Swal.fire({
                title:'Desea dar de Baja el Trabajador?',
                text:'El Trabajador pasara al apartado de Baja!',
                icon:'warning',
                showCancelButton:true,
                cancelButtonColor: '#d33',
                confirmButtonText:'Si, Dar de Baja'
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

