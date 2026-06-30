<div class="container" style="padding-top: 120px; margin-bottom: 50px;">
    <div class="row">

        <!-- Sidebar con marcas -->
        <div class="col-md-3">
            <div class="card shadow p-3">
                <h5 class="text-uppercase mb-3">Marcas</h5>
                <ul class="list-unstyled">

                    <li class="mb-2">
                        <a href="<?= base_url('catalogo?oferta=1') ?>" class="text-dark <?= isset($oferta_activa) && $oferta_activa ? 'fw-bold' : '' ?>">🔥 Ofertas</a>
                    </li>

                    <li class="mb-2">
                        <a href="<?= base_url('catalogo') ?>" class="text-dark <?= (!isset($marca_activa) || !$marca_activa) && (!isset($oferta_activa) || !$oferta_activa) ? 'fw-bold' : '' ?>">Todas</a>
                    </li>
                    <?php foreach($marcas as $marca): ?>
                    <li class="mb-2">
                        <a href="<?= base_url('catalogo?marca=' . $marca['id_marca']) ?>" 
                        class="text-dark <?= isset($marca_activa) && $marca_activa == $marca['id_marca'] ? 'fw-bold' : '' ?>">
                            <?= $marca['marca_nombre'] ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <!-- Productos -->
        <div class="col-md-9">
            <h2 class="text-uppercase mb-4">Catálogo</h2>
            <div class="row">
                <?php foreach($productos as $producto): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow h-100">
                        <?php if($producto['producto_imagen']): ?>
                            <img src="<?= base_url('images/productos/' . $producto['producto_imagen']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <span class="text-muted">Sin imagen</span>
                            </div>
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title text-uppercase"><?= $producto['producto_nombre'] ?></h6>
                            <p class="text-muted small"><?= $producto['marca_nombre'] ?></p>
                            <?php if($producto['producto_precio_oferta']): ?>
                                <p class="mb-0"><s class="text-muted">$<?= number_format($producto['producto_precio'], 2) ?></s></p>
                                <p class="text-primary fw-bold">$<?= number_format($producto['producto_precio_oferta'], 2) ?></p>
                            <?php else: ?>
                                <p class="text-primary fw-bold">$<?= number_format($producto['producto_precio'], 2) ?></p>
                            <?php endif; ?>
                            <a href="<?= base_url('catalogo/' . $producto['id_producto']) ?>" class="btn btn-dark mt-auto">Ver detalle</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>