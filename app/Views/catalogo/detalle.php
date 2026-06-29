<div class="container" style="padding-top: 120px; margin-bottom: 50px;">
    <div class="row">
        <div class="col-md-5">
            <?php if($producto['producto_imagen']): ?>
                <img src="<?= base_url('images/productos/' . $producto['producto_imagen']) ?>" class="img-fluid rounded shadow">
            <?php else: ?>
                <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 400px;">
                    <span class="text-muted">Sin imagen</span>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-7">
            <p class="text-muted"><?= $producto['marca_nombre'] ?></p>
            <h2 class="text-uppercase"><?= $producto['producto_nombre'] ?></h2>
            <hr>
            <?php if($producto['producto_precio_oferta']): ?>
                <p class="text-muted"><s>$<?= number_format($producto['producto_precio'], 2) ?></s></p>
                <h3 class="text-primary">$<?= number_format($producto['producto_precio_oferta'], 2) ?></h3>
            <?php else: ?>
                <h3 class="text-primary">$<?= number_format($producto['producto_precio'], 2) ?></h3>
            <?php endif; ?>
            <p class="text-muted">Stock disponible: <?= $producto['producto_stock'] ?></p>
            <hr>
            <p><?= $producto['producto_descripcion'] ?></p>
            <hr>

            <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('carrito/agregar') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <label class="form-label mb-0">Cantidad:</label>
                    <input type="number" name="cantidad" value="1" min="1" max="<?= $producto['producto_stock'] ?>" class="form-control" style="width: 80px;">
                </div>
                <button type="submit" class="btn btn-dark w-100 text-uppercase">Agregar al carrito</button>
            </form>
            <a href="<?= base_url('catalogo') ?>" class="btn btn-secondary w-100 mt-2">← Volver al catálogo</a>
        </div>
    </div>
</div>