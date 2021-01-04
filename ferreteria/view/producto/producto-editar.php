<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">
                            <?php echo $pro->id_producto != null ? 'Producto ' . $pro->nombreProducto : 'Nuevo Producto'; ?>
                        </h1>
                    </div>
                    <form class="user" id="frm-producto" action="?c=Producto&a=Guardar" method="post"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $pro->id_producto; ?>" />

                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="nombreProducto"
                                id="nombreProducto" placeholder="Nombre" value="<?php echo $pro->nombreProducto; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="descripcion"
                                id="descripcion" placeholder="Descripcion" value="<?php echo $pro->descripcion; ?>">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" name="precio" id="precio"
                                    placeholder="Precio" value="<?php echo $pro->precio; ?>">
                            </div>
                        </div>
                        <button class="btn btn-primary btn-user btn-block">
                            <?php echo $pro->id_producto != null ? 'Actualizar' : 'Registrar' ?> Producto
                        </button>
                        <a href="?c=Producto" class="btn btn-success btn-user btn-block">Regresar a Lista</a>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>