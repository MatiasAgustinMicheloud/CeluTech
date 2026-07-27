<div class="container" style="padding-top: 120px; margin-bottom: 50px;">
    <h2 class="text-uppercase mb-4">Carrito de Compras</h2>

    <?php if(empty($carrito)): ?>
        <div class="alert alert-info">
            Tu carrito está vacío. <a href="<?= base_url('catalogo') ?>">Ver productos</a>
        </div>
    <?php else: ?>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($carrito as $item): ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <?php if($item['producto_imagen']): ?>
                                <img src="<?= base_url('images/productos/' . $item['producto_imagen']) ?>" width="60" class="rounded">
                            <?php endif; ?>
                            <?= $item['producto_nombre'] ?>
                        </div>
                    </td>
                    <td>$<?= number_format($item['producto_precio'], 2) ?></td>
                    <td><?= $item['cantidad'] ?></td>
                    <td>$<?= number_format($item['producto_precio'] * $item['cantidad'], 2) ?></td>
                    <td>
                        <a href="<?= base_url('carrito/eliminar/' . $item['id_producto']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar producto?')">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <a href="<?= base_url('carrito/vaciar') ?>" class="btn btn-secondary" onclick="return confirm('¿Vaciar carrito?')">Vaciar carrito</a>
            <div class="text-end">
                <h4>Total: $<?= number_format($total, 2) ?></h4>
                <?php if(session()->get('logueado')): ?>
                    <a href="<?= base_url('checkout') ?>" class="btn btn-dark text-uppercase mt-2">Confirmar compra</a>
                <?php else: ?>
                    <a href="<?= base_url('login') ?>" class="btn btn-dark text-uppercase mt-2">Iniciá sesión para comprar</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <a href="<?= base_url('catalogo') ?>" class="btn btn-secondary mt-3">← Seguir comprando</a>
</div>