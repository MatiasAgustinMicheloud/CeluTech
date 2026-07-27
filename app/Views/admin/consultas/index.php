<div class="container" style="padding-top: 120px; margin-bottom: 50px;">
    <h2 class="text-uppercase mb-4">Consultas</h2>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Motivo</th>
                <th>Consulta</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($consultas as $consulta): ?>
            <tr class="<?= $consulta['estado'] == 0 ? 'table-warning' : '' ?>">
                <td><?= $consulta['id_consulta'] ?></td>
                <td><?= $consulta['nombre'] ?></td>
                <td><?= $consulta['email'] ?></td>
                <td><?= $consulta['motivo'] ?></td>
                <td><?= $consulta['consulta'] ?></td>
                <td>
                    <?php if($consulta['estado'] == 0): ?>
                        <span class="badge bg-warning text-dark">No leído</span>
                    <?php else: ?>
                        <span class="badge bg-success">Leído</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($consulta['estado'] == 0): ?>
                        <a href="<?= base_url('admin/consultas/leido/' . $consulta['id_consulta']) ?>" class="btn btn-sm btn-success">Marcar leído</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-secondary mt-3">← Volver al panel</a>
</div>