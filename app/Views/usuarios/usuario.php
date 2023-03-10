<?= 
    $this->extend('layout/dashboard-layout');
    $this->section('content');    
?>


    <div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">USUARIOS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        
                <form action="<?= base_url('/guardarUsuario')?>" method="POST">
                    <div class="modal-body">

                        <div class="form-group">
                            <label> Username </label>
                            <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                        </div>
                        <div class="form-group">
                            <label>Tipo</label>
                            <select class="form-control" name="tipo" id="tipo" required>
                                <option value=1>Administrador</option>
                                <option value=2>Normal</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" required>
                        </div>
        
                    </div>
                    <div class="modal-footer">
                        <a href="<?=base_url('usuario')?>" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">USUARIOS 
            
                    <button type="button" class="btn btn-primary addUser" data-toggle="modal" data-target="#addadminprofile">
                        Agregar Usuario 
                    </button>
               
                </h6>
            </div>

            <div class="card-body">
            
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th> ID </th>
                                <th> Username </th>
                                <th>Email </th>    
                                <th>tipo </th>                             
                                <th>EDIT </th>
                                <th>DELETE </th>
                            </tr>
                        </thead>
                        <tbody>                                
                            <?php foreach($usuarios as $usuarios): ?>              
                            <tr>
                                <td><?= $usuarios['id']; ?></td>
                                <td><?= $usuarios['username'];?></td>
                                <td><?= $usuarios['email'];?></td>
                                <td><?= $usuarios['tipo'];?></td>                            
                                <td>                                                     
                                   <a href="<?= base_url('edit/'.$usuarios['id']);?>"><button type="submit" name="edit_btn" class="btn btn-success"> EDIT</button></a> 
                          
                                </td>
                                <td>         
                                    <button onclick="mensajeError()" type="submit" id="delete_btn" name="delete_btn" class="btn btn-danger delete_btn"> DELETE</button>                       
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
        function mensajeError(){
            Swal.fire({
                title:'Desea Eliminar el perfil?',
                text:'El perfil se eliminara permanentemente!',
                icon:'warning',
                showCancelButton:true,
                cancelButtonColor: '#d33',
                confirmButtonText:'Si, Eliminar'
            }).then((result) =>{
                if(result.isConfirmed){
                    window.location.href = "<?= base_url('delete/'.$usuarios['id']);?>";
                
                }
            });   
        }
    </script>

<?= 
    $this->endSection();
?>


