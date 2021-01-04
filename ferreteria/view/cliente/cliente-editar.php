<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">
                            <?php echo $cli->id_cliente != null ? 'Cliente ' . $cli->nombre . ' ' . $cli->apellido : 'Nuevo Cliente'; ?>
                        </h1>
                    </div>
                    <form class="user" id="frm-cliente" action="?c=Cliente&a=Guardar" method="post" autocomplete="off"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $cli->id_cliente; ?>" />

                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" name="Nombre" id="nombre"
                                    placeholder="Nombre" data-validacion-tipo="requerido"
                                    value="<?php echo $cli->nombre; ?>">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" name="Apellido" id="apellido"
                                    placeholder="Apellido" data-validacion-tipo="requerido"
                                    value="<?php echo $cli->apellido; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" name="identificacion"
                                    id="identificacion" placeholder="Cédula" data-validacion-tipo="requerido"
                                    <?php echo $cli->id_cliente != null ? 'readonly' : '' ?>
                                    value="<?php echo $cli->identificacion; ?>">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" name="Telefono" id="telefono"
                                    placeholder="Teléfono" data-validacion-tipo="requerido"
                                    value="<?php echo $cli->telefono; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="Direccion" id="direccion"
                                placeholder="Dirección" data-validacion-tipo="requerido"
                                value="<?php echo $cli->direccion; ?>">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" name="Correo" id="Correo"
                                placeholder="Correo Electrónico" autocomplete="nope" data-validacion-tipo="requerido"
                                value="<?php echo $cli->correo; ?>">
                        </div>
                        <?php if ($cli->id_cliente == null) { ?>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" autocomplete="nope"
                                    id="password" name="password"
                                    data-validacion-tipo="requerido|compara:#repeatPassword" placeholder="Contraseña">
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" id="repeatPassword"
                                    data-validacion-tipo="requerido" placeholder="Repita Contraseña">
                            </div>
                        </div>
                        <?php } ?>
                        <button class="btn btn-primary btn-user btn-block">
                            <?php echo $cli->id_cliente != null ? 'Actualizar' : 'Registrar' ?> Cliente
                        </button>
                        <a href="<?php echo isset($_SESSION) ? '?c=Cliente' : '?c=Usuario' ?>"
                            class="btn btn-success btn-user btn-block"><?php echo isset($_SESSION) ? 'Regresar a Lista' : 'Iniciar Sesión' ?></a>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $("#frm-cliente").submit(function(e) {
        return $(this).validate();
    });
})
</script>