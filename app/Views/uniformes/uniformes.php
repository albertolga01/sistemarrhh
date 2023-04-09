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
                    document.getElementById("tallaCamisa").value = content[i]['tallaCamisa']; 
                    document.getElementById("tallaPantalon").value = content[i]['tallaPantalon']; 
                    document.getElementById("tallaBotas").value = content[i]['tallaBotas']; 
                    document.getElementById("idEmpleado").value = content[i]['id']; 
                }
                
            }    
            
            for(var i = 0;i<n2;i++){
                if(content2[i]['id'] == $idEmpleado2){
                    document.getElementById("tallaCamisaUpdate").value = content2[i]['tallaCamisa']; 
                    document.getElementById("tallaPantalonUpdate").value = content2[i]['tallaPantalon']; 
                    document.getElementById("tallaBotasUpdate").value = content2[i]['tallaBotas']; 
                    document.getElementById("idEmpleado2").value = content2[i]['id']; 
                }
                
            }   
        }

    </script>


    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Uniformes         
                <?php if(session('tipo') != 3){?>    
                    <button type="button" class="btn btn-success addUser" data-toggle="modal" data-target="#ModalUniformes">
                        <i class="nav-icon fas fa-tshirt"></i>  + AGREGAR 
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

                    <table class="table table-bordered" id="tablaUniformes" width="100%" cellspacing="0">
                        <thead>
                            <tr>                                
                                <th>Empleado </th>
                                <th>Fecha Entrega </th>    
                                <th>Camisa </th>  
                                <th>Pantalon </th> 
                                <th>Botas</th> 
                                <?php if(session('tipo') != 3){?>     
                                    <th>Editar</th>                                                    
                                    <th>Eliminar </th>  
                                <?php }?>                                                                                  
                            </tr>
                        </thead>
                        <tbody>   
                            <?php foreach($uniformes as $uniformes): ?>           
                                <?php  
                                    $fechaEntrega= new DateTime($uniformes['fechaEntrega']);
                                ?>                                                             
                            <tr>                                                                
                                <td><?= $uniformes['nombreEmpleado'];?></td>
                                <td><?= $fechaEntrega->format("Y-m-d");?></td>  
                                <td><?php if($uniformes['camisa']=="1"){echo"SI";}else{echo"NO";}?></td>
                                <td><?php if($uniformes['pantalon']=="1"){echo"SI";}else{echo"NO";}?></td>
                                <td><?php if($uniformes['botas']=="1"){echo"SI";}else{echo"NO";}?></td> 
                                <?php if(session('tipo') != 3){?>   
                                    <td><button type="button" class="btn btn-outline-info" 
                                                        onclick="editarUniforme(<?=$uniformes['id'];?>,'<?=$uniformes['idEmpleado'];?>','<?=$uniformes['camisa'];?>',
                                                                    '<?=$uniformes['pantalon'];?>','<?=$uniformes['botas'];?>',
                                                                    '<?=$uniformes['fechaEntrega'];?>')">                                        
                                                    <i class="nav-icon fas fa-edit"></i> Editar
                                            </button> 
                                    </td>                                                                                     
                                    <td> 
                                        <button onclick="mensajeBaja('<?= base_url('eliminarUniforme/'.$uniformes['id']).'/'.session('id');?>')"  type="submit" id="delete_btn" name="delete_btn" class="btn btn-outline-danger"> <i class="nav-icon fas fa-trash-alt"></i> Eliminar</button>                                        
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


    <!-- Modal PARA AGREGAR UNIFORMES -->
    <div class="modal fade" id="ModalUniformes" tabindex="-1" role="dialog" aria-labelledby="ModalUniformes" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header formulario-agregar">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar Uniformes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url('/guardarUniforme')?>">
                    <div class="modal-body"> 

                        <input type="hidden" name="Username" id="Username" value=<?=session('id');?>>  
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="input">Empleado</label>
                                <select id="nombreEmpleado" class="form-control" name="nombreEmpleado" require onchange="datosEmpleado()">
                                    <?php foreach($empleados as $empleados): ?>  
                                        <option value=<?= $empleados['id'];?>> <?= $empleados['nombre'];?> </option>
                                    <?php endforeach;?> 
                                </select>
                            </div>                    
                        </div>  

                        <input type="hidden" name="idEmpleado" id="idEmpleado">

                        <!-- INPUT CAMISA-->
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="camisaEmpleado" name="camisaEmpleado" value=1>
                                    <label class="custom-control-label" for="camisaEmpleado">Camisa</label>
                                </div> 
                            </div>   
                            <div class="form-group col-md-9">                                                                 
                                <input type="text" readonly class="form-control" id="tallaCamisa" name="tallaCamisa" placeholder="tallaCamisa">                           
                            </div>  
                        </div>   

                        <!-- INPUT PANTALON-->
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="pantalonEmpleado"  name="pantalonEmpleado" value=1>
                                    <label class="custom-control-label" for="pantalonEmpleado">Pantalon</label>
                                </div> 
                            </div>   
                            <div class="form-group col-md-9">                                                                 
                                <input type="text" readonly class="form-control" id="tallaPantalon" name="tallaPantalon" placeholder="tallaPantalon">                           
                            </div>  
                        </div> 

                        <!-- INPUT BOTAS-->    
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="botasEmpleado" name="botasEmpleado" value=1>
                                    <label class="custom-control-label" for="botasEmpleado">Botas</label>
                                </div> 
                            </div>   
                            <div class="form-group col-md-9">                                                                 
                                <input type="text" readonly class="form-control" id="tallaBotas" name="tallaBotas" placeholder="tallaBotas">                           
                            </div>  
                        </div> 
                        
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputFecha">Fecha de Entrega</label>
                                <input type="date" class="form-control" id="fechaEntrega" name="fechaEntrega" placeholder="fechaEntrega"  required>
                            </div>
                        </div>
                                                                    
                   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>                        
                        <button type="submit" class="btn btn-primary">Guardar</button>                        
                    </div>
                </form>
            </div>
        </div>
    </div>


     <!-- Modal PARA EDITAR UNIFORMES -->
    <div class="modal fade" id="ModalUniformesUpdate" tabindex="-1" role="dialog" aria-labelledby="ModalUniformesUpdate" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header formulario-editar">
                    <h5 class="modal-title" id="exampleModalLongTitle">Editar Uniformes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url('/editarUniforme')?>">
                    <div class="modal-body"> 

                        <input type="hidden" name="Username" id="Username" value=<?=session('id');?>>  
                        <div class="form-row">
                            <input type="hidden" name="id" id="idUpdate">  
                            <div class="form-group col-md-12">
                                <label for="input">Empleado</label>
                                <select id="nombreEmpleadoUpdate" class="form-control" name="nombreEmpleado" require onchange="datosEmpleado()">
                                    <?php foreach($empleadosUpdate as $empleadosUpdate): ?>  
                                        <option value=<?= $empleadosUpdate['id'];?>> <?= $empleadosUpdate['nombre'];?> </option>
                                    <?php endforeach;?> 
                                </select>
                            </div>                    
                        </div>  

                        <input type="hidden" name="idEmpleado" id="idEmpleado2">

                        <!-- INPUT CAMISA-->
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="camisaEmpleadoUpdate" name="camisaEmpleado" value=1>
                                    <label class="custom-control-label" for="camisaEmpleadoUpdate">Camisa</label>
                                </div> 
                            </div>   
                            <div class="form-group col-md-9">                                                                 
                                <input type="text" readonly class="form-control" id="tallaCamisaUpdate" name="tallaCamisa" placeholder="tallaCamisa">                           
                            </div>  
                        </div>   

                        <!-- INPUT PANTALON-->
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="pantalonEmpleadoUpdate"  name="pantalonEmpleado" value=1>
                                    <label class="custom-control-label" for="pantalonEmpleadoUpdate">Pantalon</label>
                                </div> 
                            </div>   
                            <div class="form-group col-md-9">                                                                 
                                <input type="text" readonly class="form-control" id="tallaPantalonUpdate" name="tallaPantalon" placeholder="tallaPantalon">                           
                            </div>  
                        </div> 

                        <!-- INPUT BOTAS-->    
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="botasEmpleadoUpdate" name="botasEmpleado" value=1>
                                    <label class="custom-control-label" for="botasEmpleadoUpdate">Botas</label>
                                </div> 
                            </div>   
                            <div class="form-group col-md-9">                                                                 
                                <input type="text" readonly class="form-control" id="tallaBotasUpdate" name="tallaBotas" placeholder="tallaBotas">                           
                            </div>  
                        </div> 
                        
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputFecha">Fecha de Entrega</label>
                                <input type="date" class="form-control" id="fechaEntregaUpdate" name="fechaEntrega" placeholder="fechaEntrega"  required>
                            </div>
                        </div>
                                                                    
                   
                    </div>
                    <div class="modal-footer">
                        <a href="<?=base_url('uniformes')?>" class="btn btn-outline-danger">Cancelar</a>
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
                var date = new Date( data[1] );  
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
            var table = $("#tablaUniformes").DataTable({
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
   

        function editarUniforme($id,$idempleado,$camisa,$pantalon,$botas,$fechaentrega) {            
            // Set data to Form Edit   
            $('#idUpdate').val($id);
            $('#idEmpleado2').val($idempleado);
            $('#nombreEmpleadoUpdate').val($idempleado).trigger('change'); 
            
            if($camisa == 1){                    
                document.getElementById("camisaEmpleadoUpdate").checked = true;
                $('#camisaEmpleadoUpdate').val($camisa);
            }  
            if($pantalon == 1){
                document.getElementById("pantalonEmpleadoUpdate").checked = true;
                $('#pantalonEmpleadoUpdate').val($pantalon);
            }  
            if($botas == 1){
                document.getElementById("botasEmpleadoUpdate").checked = true;
                $('#botasEmpleadoUpdate').val($botas);
            }  
           
            $('#fechaEntregaUpdate').val($fechaentrega).trigger('change');                                             
            // Call Modal Edit
            $('#ModalUniformesUpdate').modal('show');
    
        }

        function mensajeBaja(url){
            Swal.fire({
                title:'Desea ELIMINAR el Uniforme?',
                text:'Se eliminara el Uniforme!',
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

