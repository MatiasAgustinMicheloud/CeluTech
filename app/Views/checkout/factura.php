<div class="container" style="padding-top: 120px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow p-5">

                <div class="text-center mb-4">
                    <h2 class="text-uppercase">CeluTech</h2>
                    <p class="text-muted">Factura de compra</p>
                </div>

                <div class="d-flex justify-content-between mb-4">
                    <div>
                        <p class="mb-0"><strong>Factura #:</strong> <?= $factura['id_factura'] ?></p>
                        <p class="mb-0"><strong>Venta #:</strong> <?= $venta['id_venta'] ?></p>
                    </div>
                    <div class="text-end">
                        <p class="mb-0"><strong>Fecha:</strong> <?= $factura['factura_fecha'] ?></p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="mb-0"><strong>Método de envío:</strong> 
                            <?php 
                                $envio = session()->getFlashdata('metodo_envio');
                                echo $envio == 'domicilio' ? 'Envío a domicilio' : 'Retiro en sucursal';
                            ?>
                        </p>
                        <?php if(session()->getFlashdata('direccion')): ?>
                            <p class="mb-0"><strong>Dirección:</strong> <?= session()->getFlashdata('direccion') ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 text-end">
                        <p class="mb-0"><strong>Método de pago:</strong>
                            <?php
                                $pago = session()->getFlashdata('metodo_pago');
                                $metodos = [
                                    'efectivo'      => 'Efectivo',
                                    'transferencia' => 'Transferencia bancaria',
                                    'tarjeta'       => 'Tarjeta de crédito/débito'
                                ];
                                echo $metodos[$pago] ?? $pago;
                            ?>
                        </p>
                        <?php if(session()->getFlashdata('metodo_pago') == 'transferencia'): ?>
                            <p class="mb-0 text-muted"><small>Alias: celutech.pagos</small></p>
                        <?php endif; ?>
                    </div>
                </div>

                <hr>

                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Precio unitario</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($detalles as $detalle): ?>
                        <tr>
                            <td><?= $detalle['producto_nombre'] ?></td>
                            <td>$<?= number_format($detalle['precio_unitario'], 2) ?></td>
                            <td><?= $detalle['cantidad'] ?></td>
                            <td>$<?= number_format($detalle['precio_unitario'] * $detalle['cantidad'], 2) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <hr>

                <div class="text-end">
                    <h4>Total: $<?= number_format($factura['total'], 2) ?></h4>
                </div>

                <hr>

                <div class="text-center mt-3">
                    <p class="text-muted">¡Gracias por tu compra!</p>
                    <a href="<?= base_url('catalogo') ?>" class="btn btn-dark text-uppercase">Seguir comprando</a>
                    <a href="<?= base_url('historial') ?>" class="btn btn-secondary text-uppercase mt-2">Ver mis compras</a>
                </div>

            </div>
        </div>
    </div>
</div>