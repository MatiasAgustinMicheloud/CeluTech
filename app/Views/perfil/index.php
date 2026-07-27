<div class="container" style="padding-top: 120px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow p-5">
                <h2 class="text-center text-uppercase mb-4">Mi Perfil</h2>

                <?php if(session()->getFlashdata('exito')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('exito') ?></div>
                <?php endif; ?>

                <?php if(isset($errores)): ?>
                    <div class="alert alert-danger">
                        <?php foreach($errores as $e): ?>
                            <p class="mb-0"><?= $e ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('perfil/actualizar') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="usuario_nombre" class="form-control" value="<?= $usuario['usuario_nombre'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Apellido</label>
                        <input type="text" name="usuario_apellido" class="form-control" value="<?= $usuario['usuario_apellido'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="usuario_email" class="form-control" value="<?= $usuario['usuario_email'] ?>">
                    </div>
                    
                    <h6 class="text-uppercase mb-3">Cambiar contraseña <small class="text-muted">(opcional)</small></h6>
                    <div class="mb-3">
                        <label class="form-label">Nueva contraseña</label>
                        <input type="password" name="nueva_password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmar nueva contraseña</label>
                        <input type="password" name="confirmar_password" class="form-control">
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-dark w-100 text-uppercase mt-3">Actualizar perfil</button>
                </form>

                <a href="<?= base_url('historial') ?>" class="btn btn-secondary w-100 mt-2">Ver mis compras</a>
            </div>
        </div>
    </div>
</div>