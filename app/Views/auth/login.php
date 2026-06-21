
<div class="container" style="padding-top: 120px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-body p-5">
                    <h2 class="text-center text-uppercase mb-4">Iniciar Sesión</h2>

                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <?php if(isset($errores)): ?>
                        <div class="alert alert-danger">
                            <?php foreach($errores as $e): ?>
                                <p class="mb-0"><?= $e ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('login') ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="usuario_email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="usuario_password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-dark w-100 text-uppercase mt-3">Ingresar</button>
                    </form>

                    <p class="text-center mt-3">¿No tenés cuenta? <a href="<?= base_url('registro') ?>">Registrate</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
