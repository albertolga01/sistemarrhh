<?= 
    $this->extend('layout/dashboard-layout');
    $this->section('content');    
?>


    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">EXPEDIENTES DE <?= $empleado['nombre']?>
                    <?php if(session('tipo') != 3){?>    
                        <button type="button" class="btn btn-success addUser" data-toggle="modal" data-target="#ModalExpediente">
                            <i class="nav-icon fas fa-archive"></i>  + AGREGAR 
                        </button>  
                    <?php }?>              
                </h6>
                
            </div>

            <div class="card-body">
            
                <div class="table-responsive">               
                
                </div>
            </div>
        </div>
    </div>

    <!-- Modal PARA AGREGAR EXPEDIENTE -->
    <div class="modal fade" id="ModalExpediente" tabindex="-1" role="dialog" aria-labelledby="ModalExpediente" aria-hidden="true">
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
                                <input type="text" class="form-control " id="nombreEmpleado" name="nombreEmpleado" placeholder="Nombre Completo"  required readonly value="<?= $empleado['nombre']?>"> 
                            </div>                    
                        </div>  

                        <input type="hidden" name="idEmpleado" id="idEmpleado">                                                                                     
                   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>                        
                        <button type="submit" class="btn btn-primary">Guardar</button>                        
                    </div>
                </form>
            </div>
        </div>
    </div>

<?= 
    $this->endSection();
?>

