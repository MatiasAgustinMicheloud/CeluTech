<div class="container" style="padding-top: 120px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow p-5">
                <h2 class="text-center text-uppercase mb-4">Contacto</h2>

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

                <form action="<?= base_url('contacto/enviar') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="<?= isset($old) ? $old['nombre'] : (session()->get('usuario_nombre') ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= isset($old) ? $old['email'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Motivo</label>
                        <select name="motivo" class="form-select">
                            <option value="">Seleccionar...</option>
                            <option value="consulta" <?= isset($old) && $old['motivo'] == 'consulta' ? 'selected' : '' ?>>Consulta general</option>
                            <option value="reclamo" <?= isset($old) && $old['motivo'] == 'reclamo' ? 'selected' : '' ?>>Reclamo</option>
                            <option value="garantia" <?= isset($old) && $old['motivo'] == 'garantia' ? 'selected' : '' ?>>Garantía</option>
                            <option value="otro" <?= isset($old) && $old['motivo'] == 'otro' ? 'selected' : '' ?>>Otro</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Consulta</label>
                        <textarea name="consulta" class="form-control" rows="5"><?= isset($old) ? $old['consulta'] : '' ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark w-100 text-uppercase mt-3">Enviar consulta</button>
                </form>
            </div>
        </div>
    </div>
</div>