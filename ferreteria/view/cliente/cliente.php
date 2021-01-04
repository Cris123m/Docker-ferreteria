<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de Clientes</h6>
        <div class="well well-sm text-right">
            <a class="btn btn-primary" href="?c=Cliente&a=Crud">Nuevo Cliente</a>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Identificación</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Correo</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Identificación</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Correo</th>
                        <th>Acción</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($this->model->Listar() as $r) : ?>
                    <tr>
                        <td><?php echo $r->id_cliente; ?></td>
                        <td><?php echo $r->identificacion; ?></td>
                        <td><?php echo $r->nombre; ?></td>
                        <td><?php echo $r->apellido; ?></td>
                        <td><?php echo $r->telefono; ?></td>
                        <td><?php echo $r->direccion; ?></td>
                        <td><?php echo $r->correo; ?></td>
                        <td>
                            <a href="?c=Cliente&a=Crud&id=<?php echo $r->id_cliente; ?>">Editar</a>
                            <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');"
                                href="?c=Cliente&a=Eliminar&id=<?php echo $r->id_cliente; ?>">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>