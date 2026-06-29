<div class="container" style="padding-top: 120px; margin-bottom: 50px;">
    <h2 class="text-uppercase mb-4">Confirmar Compra</h2>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow p-4">
                <h5 class="text-uppercase mb-3">Resumen del pedido</h5>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($carrito as $item): ?>
                        <tr>
                            <td><?= $item['producto_nombre'] ?></td>
                            <td>$<?= number_format($item['producto_precio'], 2) ?></td>
                            <td><?= $item['cantidad'] ?></td>
                            <td>$<?= number_format($item['producto_precio'] * $item['cantidad'], 2) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow p-4">
                <h5 class="text-uppercase mb-3">Total</h5>
                <h3 class="text-primary">$<?= number_format($total, 2) ?></h3>
                <hr>

                <?php if(isset($errores)): ?>
                    <div class="alert alert-danger">
                        <?php foreach($errores as $e): ?>
                            <p class="mb-0"><?= $e ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('checkout/confirmar') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label class="form-label">Método de envío</label>
                        <select name="metodo_envio" class="form-select">
                            <option value="">Seleccionar...</option>
                            <option value="retiro">Retiro en sucursal</option>
                            <option value="domicilio">Envío a domicilio</option>
                        </select>
                    </div>

                    <div class="mb-3" id="direccion_div" style="display:none;">
                        <label class="form-label">Dirección de envío</label>
                        <input type="text" name="direccion" class="form-control" placeholder="Ej: Av. Corrientes 1234">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Método de pago</label>
                        <select name="metodo_pago" class="form-select">
                            <option value="">Seleccionar...</option>
                            <option value="efectivo">Efectivo</option>
                            <option value="transferencia">Transferencia bancaria</option>
                            <option value="tarjeta">Tarjeta de crédito/débito</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 text-uppercase">Confirmar y pagar</button>
                </form>
                <a href="<?= base_url('carrito') ?>" class="btn btn-secondary w-100 mt-2">← Volver al carrito</a>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('select[name="metodo_envio"]').addEventListener('change', function() {
            const direccionDiv = document.getElementById('direccion_div');
            direccionDiv.style.display = this.value === 'domicilio' ? 'block' : 'none';
        });
    </script>

</div>