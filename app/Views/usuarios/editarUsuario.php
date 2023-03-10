<?= 
    $this->extend('layout/dashboard-layout');
    $this->section('content');    
?>    

    <form action="<?= base_url('/editarUsuario')?>" method="POST">
        <div class="modal-body">
            <input type="hidden" name="id" value="<?= $usuario['id']?>">

            <div class="form-group">
                <label> Username </label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username" value="<?= $usuario['username']?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email" value="<?= $usuario['email']?>" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password" value="<?= $usuario['password']?>" required>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" value="<?= $usuario['password']?>" required>
            </div>
        
        </div>
        <div class="modal-footer">            
            <a href="<?=base_url('usuario')?>" class="btn btn-secondary">Cancelar</a>
            <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
        </div>
    </form>
<?= 
    $this->endSection();
?>