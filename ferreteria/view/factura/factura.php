<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de Facturas</h6>
        <?php if ($_SESSION['usuario']->rol_id == 1) { ?>
        <div class="well well-sm text-right">
            <a class="btn btn-primary" href="?c=Factura&a=Crud">Nueva Factura</a>
        </div>
        <?php } ?>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Acción</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $listado = array();
                    if ($_SESSION['usuario']->rol_id == 1) {
                        $listado = $this->model->Listar();
                    } else {
                        $listado = $this->model->ListarXCliente($_SESSION['cliente']->id_cliente);
                    }
                    ?>
                    <?php foreach ($listado as $r) : ?>
                    <?php
                        $clienteModel = new Cliente();
                        $cliente = $clienteModel->Obtener($r->cliente_id);
                        ?>
                    <tr>
                        <td><?php echo str_pad($r->id_factura, 6, "0", STR_PAD_LEFT); ?></td>
                        <td><?php echo $r->fecha; ?></td>
                        <td><?php echo $cliente->nombre . ' ' . $cliente->apellido; ?></td>
                        <td><?php echo '$ ' . number_format($r->total, 2, '.', ''); ?></td>
                        <td>
                            <a href="?c=Factura&a=Ver&id=<?php echo $r->id_factura; ?>">Ver</a>
                            <?php if ($_SESSION['usuario']->rol_id == 1) { ?>
                            <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');"
                                href="?c=Factura&a=Eliminar&id=<?php echo $r->id_factura; ?>">Eliminar</a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>