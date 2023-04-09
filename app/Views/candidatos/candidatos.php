<?= 
    $this->extend('layout/dashboard-layout');
    $this->section('content');    
?>

    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Candidatos            
                    <button type="button" class="btn btn-success addUser" data-toggle="modal" data-target="#ModalCandidatos">
                        <i class="nav-icon fa fa-address-book"></i>  + AGREGAR
                    </button>                    
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
                        
                        <table class="table table-bordered" id="tablaCandidatos" width="100%" cellspacing="0">
                            <thead>
                                <tr>                                
                                    <th>Candidato </th>
                                    <th>Fecha Entrevista</th> 
                                    <th>Puesto</th> 
                                    <th>Correo</th> 
                                    <th>Telefono</th>    
                                    <th>Psicometrico</th>    
                                    <th>Referencias</th>
                                    <th>Comentarios</th>
                                    <th>Editar</th>                     
                                    <th>Eliminar </th>  
                                </tr>
                            </thead>
                            <tbody>   
                                <?php foreach($candidatos as $candidatos): ?>           
                                    <?php  
                                        $fechaEntrevista= new DateTime($candidatos['fechaEntrevista']);
                                    ?>                                                             
                                    <tr>                                                                
                                        <td><?= $candidatos['nombreCandidato'];?></td>
                                        <td><?= $fechaEntrevista->format("Y-m-d");?></td>  
                                        <td><?= $candidatos['puesto'];?></td>
                                        <td><?= $candidatos['correo'];?></td>
                                        <td><?= $candidatos['telefono'];?></td>
                                        <td><?php if($candidatos['psicometrico']=="1"){echo"SI";}else{echo"NO";}?></td>     
                                        <td><?= $candidatos['referencias'];?></td>
                                        <td><?= $candidatos['comentarios'];?></td>
                                        <td><button type="button" class="btn btn-outline-info" 
                                                    onclick="editarCandidato(<?=$candidatos['idcandidato'];?>,'<?=$candidatos['nombreCandidato'];?>','<?=$candidatos['fechaEntrevista'];?>',
                                                                '<?=$candidatos['psicometrico'];?>','<?=$candidatos['referencias'];?>','<?=$candidatos['comentarios'];?>'
                                                                ,'<?=$candidatos['puesto'];?>','<?=$candidatos['correo'];?>','<?=$candidatos['telefono'];?>')">                                        
                                                <i class="nav-icon fas fa-edit"></i> Editar
                                            </button> 
                                        </td>                          
                                        <td> 
                                        <button onclick="mensajeBaja('<?= base_url('eliminarCandidato/'.$candidatos['idcandidato']).'/'.session('id');?>')"  type="submit" id="delete_btn" name="delete_btn" class="btn btn-outline-danger"> <i class="nav-icon fas fa-trash-alt"></i> Eliminar</button>                                        
                                        </td>                                    
                                                                                                                                                                      
                                    </tr>                           
                                <?php endforeach;?> 
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal PARA AGREGAR CANDIDATO -->
    <div class="modal fade" id="ModalCandidatos" tabindex="-1" role="dialog" aria-labelledby="ModalCandidatos" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:600px !important;">
            <div class="modal-content">
                <div class="modal-header formulario-agregar">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar Candidato</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url('/guardarCandidato')?>">
                    <div class="modal-body"> 

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="input">Nombre del Candidato</label>  
                                <input type="text" name="nombreCandidato" id="nombreCandidato" class="form-control" placeholder="Nombre del Candidato" required maxlength="100">                             
                            </div>                    
                        </div>  
                          

                        <input type="hidden" name="Username" id="Username" value=<?=session('id');?>>                        
                
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputFecha">Fecha de Entrevista</label>
                                <input type="date" class="form-control" id="fechaEntrevista" name="fechaEntrevista" placeholder="Fecha de Entrevista"  required>
                            </div>     
                            <div class="form-group col-md-4">
                                <label for="inputPuesto">Puesto</label>
                                <input type="text" class="form-control" id="puesto" name="puesto" placeholder="Puesto"  required maxlength="50">
                            </div> 
                            <div class="form-group col-md-4">
                                <div class="custom-control custom-switch" style="margin-top: 35px;display: flex;justify-content: center;">
                                    <input type="checkbox" class="custom-control-input" id="psicometrico" name="psicometrico" value=1>
                                    <label class="custom-control-label" for="psicometrico">Psicometrico</label>
                                </div> 
                            </div>                        
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputTelefono">Telefono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono"  required maxlength="10">
                            </div>  
                            <div class="form-group col-md-6">   
                                <label>Email</label>
                                <input type="email" name="correo" class="form-control" placeholder="Enter Email" required maxlength="50">      
                            </div>                  
                        </div>
                   

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="input">Referencias</label>                                  
                                <textarea id="referencias" name="referencias" rows="2" cols="50" class="form-control"></textarea>
                            </div>                    
                        </div>  

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="input">Comentarios</label>                                  
                                <textarea id="comentarios" name="comentarios" rows="2" cols="50" class="form-control"></textarea>
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


      <!-- Modal PARA EDITAR CANDIDATO -->
      <div class="modal fade" id="ModalCandidatosUpdate" tabindex="-1" role="dialog" aria-labelledby="ModalCandidatosUpdate" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:600px !important;">
            <div class="modal-content">
                <div class="modal-header formulario-editar">
                    <h5 class="modal-title" id="exampleModalLongTitle">Editar Candidato</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url('/editarCandidato')?>">
                    <div class="modal-body"> 

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="input">Nombre del Candidato</label>  
                                <input type="text" name="nombreCandidato" id="nombreCandidatoUpdate" class="form-control" placeholder="Nombre del Candidato" required maxlength="100">                             
                            </div>                    
                        </div>  
                          
                        <input type="hidden" name="id" id="idUpdate"> 
                        <input type="hidden" name="Username" id="Username" value=<?=session('id');?>>                        
                
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputFecha">Fecha de Entrevista</label>
                                <input type="date" class="form-control" id="fechaEntrevistaUpdate" name="fechaEntrevista" placeholder="Fecha de Entrevista"  required>
                            </div>     
                            <div class="form-group col-md-4">
                                <label for="inputPuesto">Puesto</label>
                                <input type="text" class="form-control" id="puestoUpdate" name="puesto" placeholder="Puesto"  required maxlength="50">
                            </div> 
                            <div class="form-group col-md-4">
                                <div class="custom-control custom-switch" style="margin-top: 35px;display: flex;justify-content: center;">
                                    <input type="checkbox" class="custom-control-input" id="psicometricoUpdate" name="psicometrico" value=1>
                                    <label class="custom-control-label" for="psicometricoUpdate">Psicometrico</label>
                                </div> 
                            </div>                        
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputTelefono">Telefono</label>
                                <input type="text" class="form-control" id="telefonoUpdate" name="telefono" placeholder="Telefono"  required maxlength="10">
                            </div>  
                            <div class="form-group col-md-6">   
                                <label>Email</label>
                                <input type="email"  id="correoUpdate"  name="correo" class="form-control" placeholder="Enter Email" required maxlength="50">      
                            </div>                  
                        </div>
                   

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="input">Referencias</label>                                  
                                <textarea id="referenciasUpdate" name="referencias" rows="2" cols="50" class="form-control"></textarea>
                            </div>                    
                        </div>  

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="input">Comentarios</label>                                  
                                <textarea id="comentariosUpdate" name="comentarios" rows="2" cols="50" class="form-control"></textarea>
                            </div>                    
                        </div>  
                                                                                       
                    </div>
                    <div class="modal-footer">
                        <a href="<?=base_url('candidatos')?>" class="btn btn-outline-danger">Cancelar</a>
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
            var table = $("#tablaCandidatos").DataTable({
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
    
        function editarCandidato($id,$nombrecandidato,$fechaentrevista,$psicometrico,$referencias,$comentarios,$puesto,$telefono,$correo) {
            // Set data to Form Edit   
            $('#idUpdate').val($id);
            $('#nombreCandidatoUpdate').val($nombrecandidato); 
            $('#fechaEntrevistaUpdate').val($fechaentrevista).trigger('change');       
            $('#puestoUpdate').val($puesto);  
            if($psicometrico == 1){                    
                document.getElementById("psicometricoUpdate").checked = true;
                $('#psicometricoUpdate').val($psicometrico);
            }             
            $('#telefonoUpdate').val($telefono);   
            $('#correoUpdate').val($correo);
            $('#referenciasUpdate').val($referencias);
            $('#comentariosUpdate').val($comentarios); 
                                    
            // Call Modal Edit
            $('#ModalCandidatosUpdate').modal('show');
        }

        function mensajeBaja(url){
            Swal.fire({
                title:'Desea ELIMINAR el Candidato?',
                text:'Se eliminara el Candidato!',
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

