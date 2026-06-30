<div class="container" style="padding-top: 120px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body p-5">
                    <h2 class="text-center text-uppercase mb-4">Crear Cuenta</h2>

                    <?php if(isset($errores)): ?>
                        <div class="alert alert-danger">
                            <?php foreach($errores as $e): ?>
                                <p class="mb-0"><?= $e ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('registro') ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="usuario_nombre" class="form-control"  value="<?= $old['usuario_nombre'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Apellido</label>
                            <input type="text" name="usuario_apellido" class="form-control"  value="<?= $old['usuario_apellido'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="usuario_email" class="form-control"  value="<?= $old['usuario_email'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="usuario_password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirmar contraseña</label>
                            <input type="password" name="confirmar_password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-dark w-100 text-uppercase mt-3">Registrarse</button>
                    </form>

                    <p class="text-center mt-3">¿Ya tenés cuenta? <a href="<?= base_url('login') ?>">Iniciá sesión</a></p>
                </div>
            </div>
        </div>
    </div>
</div>