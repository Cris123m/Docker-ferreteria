<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">
                            Factura
                        </h1>
                    </div>
                    <form class="factura" id="frm-factura" method="post" enctype="multipart/form-data">

                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" name="id" id="id"
                                    placeholder="Número de Factura" readonly
                                    value="<?php echo str_pad($fac->id_factura != null ? $fac->id_factura : $fac->ObtenerNumero()->idMayor + 1, 6, "0", STR_PAD_LEFT); ?>">
                            </div>
                            <div class="col-sm-6">
                                <input type="date" class="form-control form-control-user" name="fecha" id="fecha"
                                    placeholder="Fecha" readonly
                                    value="<?php echo $fac->id_factura != null ? $fac->fecha : $hoy; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <select name="cliente" id="cliente" class="form-control form-control-user"
                                    style="padding: 0 1rem;height: calc(2.7em + .75rem + 2px);" disabled>
                                    <?php foreach ($cli->Listar() as $r) : ?>
                                    <option value="<?php echo $r->id_cliente ?>"
                                        <?php echo $r->id_cliente == $fac->cliente_id ? 'selected' : '' ?>>
                                        <?php echo $r->identificacion . ' - ' . $r->nombre . ' ' . $r->apellido; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTables" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Cantidad</th>
                                            <th>Descripción</th>
                                            <th>V. Unit</th>
                                            <th>V. Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detalle">
                                        <?php $subtotal = 0; ?>
                                        <?php foreach ($det->ObtenerXFactura($fac->id_factura) as $r) : ?>
                                        <?php $subtotal += $r->subtotal;
                                            $pro = new Producto();
                                            $producto = $pro->Obtener($r->producto_id);
                                            setlocale(LC_MONETARY, 'en_US');
                                            ?>
                                        <tr>
                                            <td><?php echo $r->cantidad ?></td>
                                            <td><?php echo $producto->nombreProducto; ?></td>
                                            <td style="text-align: right;">
                                                <?php echo money_format('%i', $producto->precio); ?></td>
                                            <td style="text-align: right;">
                                                <?php echo money_format('%i', $r->subtotal); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" style="text-align: right;">Subtotal</th>
                                            <th id="subtotal" style="text-align: right;">
                                                <?php echo money_format('%i', $subtotal); ?></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" style="text-align: right;">IVA 12%</th>
                                            <th id="iva" style="text-align: right;">
                                                <?php echo money_format('%i', $subtotal * 0.12); ?></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" style="text-align: right;">Total</th>
                                            <th id="total" style="text-align: right;">
                                                <?php echo money_format('%i', $subtotal * 1.12); ?>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <a href="?c=Factura" class="btn btn-success btn-user btn-block">Regresar a Lista</a>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>