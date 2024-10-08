<?= 
    $this->extend('layout/dashboard-layout');
    $this->section('content');    
?>

    <!--SCRIPT PARA HACER DATATABLE LA TABLA -->
    <script language= javascript type= text/javascript>
        $( document ).ready(function(){
            datosEmpleado();

        });
        function datosEmpleado(){
            $idEmpleado = $("#nombreEmpleado").val(); 
            $idEmpleado2 = $("#nombreEmpleadoUpdate").val(); 
                                   
            var content = <?php echo json_encode($empleados); ?>;
            var content2 = <?php echo json_encode($empleadosUpdate); ?>;

            var n = content.length; //obtienes la longitud           
            var n2 = content2.length; //obtienes la longitud     
            for(var i = 0;i<n;i++){
                if(content[i]['id'] == $idEmpleado){                                                            
                    document.getElementById("idEmpleado").value = content[i]['id'];                     
                }
                
            }  
            for(var i = 0;i<n2;i++){
                if(content2[i]['id'] == $idEmpleado2){                                                                                
                    document.getElementById("idEmpleado2").value = content2[i]['id']; 
                }
                
            }                         
        }

    </script>

 
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Hijos      
                    <?php if(session('tipo') != 3){?>        
                        <button type="button" class="btn btn-success addUser" data-toggle="modal" data-target="#ModalHijos">
                            <i class="nav-icon fas fa-baby-carriage	"></i>  + AGREGAR 
                        </button>   
                    <?php }?>                   
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
                        
                        <table class="table table-bordered" id="tablaHijos" width="100%" cellspacing="0">
                            <thead>
                                <tr>                                
                                    <th>Empleado </th>
                                    <th>Hijo</th>    
                                    <th>Fecha Nacimiento </th>    
                                    <th>Edad</th>  
                                    <?php if(session('tipo') != 3){?>  
                                        <th>Editar</th>
                                        <th>Eliminar </th>  
                                    <?php }?>                                                                                                                                       
                                </tr>
                            </thead>
                            <tbody>   
                                <?php foreach($hijos as $hijos): ?>                                      
                                    <?php                                    
                                        $nacimiento = new DateTime($hijos['fechaNacimiento']);
                                        $ahora = new DateTime(date("Y-m-d"));
                                        $edad = $ahora->diff($nacimiento);
                                        $edad = $edad->format("%y");
                                        
                                    ?>
                                    <tr>                                                              
                                        <td><?= $hijos['nombre'];?></td>
                                        <td><?= $hijos['nombreHijo'];?></td>                                                                  
                                        <td><?= $nacimiento->format("Y-m-d");?></td>                                      
                                        <td><?= $edad;?></td>
                                        <?php if(session('tipo') != 3){?>  
                                            <td><button type="button" class="btn btn-outline-info" 
                                                        onclick="editarHijo(<?=$hijos['id'];?>,'<?=$hijos['nombreHijo'];?>','<?=$hijos['fechaNacimiento'];?>',
                                                                    '<?=$hijos['idEmpleado'];?>')">                                        
                                                    <i class="nav-icon fas fa-edit"></i> Editar
                                                </button> 
                                            </td>                                             
                                            <td> 
                                                <button onclick="mensajeBaja('<?= base_url('eliminarHijo/'.$hijos['id']).'/'.session('id');?>')" type="submit" id="delete_btn" name="delete_btn" class="btn btn-outline-danger"> <i class="nav-icon fas fa-trash-alt"></i> Eliminar</button>                                        
                                            </td>  
                                        <?php }?>   
                                    </tr>                           
                                <?php endforeach;?> 
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal AGREGAR HIJOS -->
    <div class="modal fade" id="ModalHijos" tabindex="-1" role="dialog" aria-labelledby="ModalHijos" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header formulario-agregar">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar Hijos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url('/guardarHijo')?>">
                    <div class="modal-body"> 

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="input">Empleado</label>
                                <select id="nombreEmpleado" class="form-control" name="nombreEmpleado" require onchange="datosEmpleado()">
                                    <?php foreach($empleados as $empleados): ?>  
                                        <option value=<?= $empleados['id'];?>><?= $empleados['nombre'];?></option>
                                    <?php endforeach;?> 
                                </select>
                            </div>                    
                        </div>  

                        <input type="hidden" name="idEmpleado" id="idEmpleado">      

                        <input type="hidden" name="Username" id="Username" value=<?=session('id');?>>  
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputnombreHijo">Nombre del Hijo</label>
                                <input type="text" name="nombreHijo" id="nombreHijo" class="form-control" placeholder="Nombre del Hijo" required maxlength="100">
                            </div>
                        </div>
                
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputFecha">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" placeholder="Fecha de Nacimiento"  required>
                            </div>
                        </div>
                                                                                       
                    </div>
                    <div class="modal-footer">
                        <a href="<?=base_url('hijos')?>" class="btn btn-outline-danger">Cancelar</a>
                        <button type="submit" name="registerbtn" class="btn btn-outline-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal PARA EDITAR HIJO -->
    <div class="modal fade" id="ModalHijosUpdate" tabindex="-1" role="dialog" aria-labelledby="ModalHijosUpdate" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header formulario-editar">
                    <h5 class="modal-title" id="exampleModalLongTitle">Editar Hijos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url('/editarHijo')?>">
                    <div class="modal-body"> 
                    <input type="hidden" name="id" id="idUpdate">  
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="input">Empleado</label>
                                <select id="nombreEmpleadoUpdate" class="form-control" name="nombreEmpleado" require onchange="datosEmpleado()">
                                    <?php foreach($empleadosUpdate as $empleadosUpdate): ?>  
                                        <option value=<?= $empleadosUpdate['id'];?>><?= $empleadosUpdate['nombre'];?></option>
                                    <?php endforeach;?> 
                                </select>
                            </div>                    
                        </div>  

                        <input type="hidden" name="idEmpleado" id="idEmpleado2">      

                        <input type="hidden" name="Username" id="Username" value=<?=session('id');?>>  
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputnombreHijo">Nombre del Hijo</label>
                                <input type="text" name="nombreHijo" id="nombreHijoUpdate" class="form-control" placeholder="Nombre del Hijo" required maxlength="100">
                            </div>
                        </div>
                
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputFecha">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fechaNacimientoUpdate" name="fechaNacimiento" placeholder="Fecha de Nacimiento"  required>
                            </div>
                        </div>
                                                                                       
                    </div>
                    <div class="modal-footer">
                        <a href="<?=base_url('hijos')?>" class="btn btn-outline-danger">Cancelar</a>
                        <button type="submit" name="registerbtn" class="btn btn-outline-success">Guardar</button>
                    </div>
                </form>
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
            var table = $("#tablaHijos").DataTable({
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


    <script>
        function editarHijo($id,$nombreHijo,$fechanacimiento,$idEmpleado) {
            console.log($fechanacimiento);
            $fechanacimiento = $fechanacimiento.slice(0, -9);
            console.log($fechanacimiento);
            // Set data to Form Edit   
            $('#idUpdate').val($id);
            $('#nombreHijoUpdate').val($nombreHijo);
            $('#fechaNacimientoUpdate').val($fechanacimiento).trigger('change');   
            $('#nombreEmpleadoUpdate').val($idEmpleado).trigger('change');                       
            // Call Modal Edit
            $('#ModalHijosUpdate').modal('show');
        }

        function mensajeBaja(url){
            Swal.fire({
                title:'Desea ELIMINAR el Hijo?',
                text:'Se eliminara el Hijo!',
                icon:'warning',
                showCancelButton:true,
                cancelButtonColor: '#d33',
                confirmButtonText:'Si, Eliminar'
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

