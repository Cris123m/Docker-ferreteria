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
                                    placeholder="Fecha"
                                    value="<?php echo $fac->id_factura != null ? $fac->fecha : $hoy; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <select name="cliente" id="cliente" class="form-control form-control-user"
                                    style="padding: 0 1rem;height: calc(2.7em + .75rem + 2px);">
                                    <?php foreach ($cli->Listar() as $r) : ?>
                                    <option value="<?php echo $r->id_cliente ?>">
                                        <?php echo $r->identificacion . ' - ' . $r->nombre . ' ' . $r->apellido; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <!-- <input type="text" class="form-control form-control-user" name="Telefono" id="telefono"
                                    placeholder="Teléfono" value="<?php echo $fac->telefono; ?>"> -->
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Agregar Producto
                        </button>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTables" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Cantidad</th>
                                            <th>Descripción</th>
                                            <th>V. Unit</th>
                                            <th>V. Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="detalle">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" style="text-align: right;">Subtotal</th>
                                            <th id="subtotal" style="text-align: right;"></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" style="text-align: right;">IVA 12%</th>
                                            <th id="iva" style="text-align: right;"></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" style="text-align: right;">Total</th>
                                            <th id="total" style="text-align: right;"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-user btn-block">
                            <?php echo $fac->id_factura != null ? 'Actualizar' : 'Registrar' ?> Factura
                        </button>
                        <a href="?c=Factura" class="btn btn-success btn-user btn-block">Regresar a Lista</a>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Productos-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="productosModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productosModal">Productos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="dataTables" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody id="listaProductos">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
<script>
function obtenerProductos() {
    datos = {

    }
    $.ajax({
        url: "?c=Producto&a=JSONProductos",
        type: "POST",
        data: datos,
        dataType: 'json'
    }).done(function(respuesta) {
        if (respuesta) {
            //console.log(respuesta);
            if (respuesta) {
                var tblBody = document.createElement("tbody");
                for (var id in respuesta) {
                    var fila = '<td>' + respuesta[id].id_producto + '</td>' +
                        '<td>' + respuesta[id].nombreProducto + '</td>' +
                        '<td>' + respuesta[id].descripcion + '</td>' +
                        '<td>' + respuesta[id].precio + '</td>';
                    var btn = document.createElement("TR");
                    tblBody.appendChild(btn);
                    btn.innerHTML = fila;
                    document.getElementById("listaProductos").appendChild(btn);
                }
            }

        }
    });
}

obtenerProductos();

$('#listaProductos').css('cursor', 'pointer');

$('#listaProductos').on('click', 'tr', function() {
    var id = $(this).find('td').eq(0).text();
    var producto = $(this).find('td').eq(1).text();
    var descripcion = $(this).find('td').eq(2).text();
    var precio = Number($(this).find('td').eq(3).text());
    var tblBody = document.createElement("tbody");

    //Buscar si ya se ha ingresado el producto
    var productoEncontrado = false;
    $('#detalle').find('tr').each(function() {
        var idProducto = $(this).find('input[name="id"]').val();
        if (idProducto === id) {
            productoEncontrado = true;
        }
    });

    //Ingresa solo si no se ha encontrado el mismo producto en detalle
    if (!productoEncontrado) {
        var fila =
            '<input type="hidden" class="id" name="id" value="' + id + '">' +
            '<td style="width: 8px;"><input class="form-control cantidad" type="number" min=0 value="1"></td>' +
            '<td>' + descripcion + '</td>' +
            '<td style="text-align: right;">' + precio.toFixed(2) + '</td>' +
            '<td style="text-align: right;"></td>' +
            '<td style="width: 5px;">' +
            '<button class="btn btn-danger btn-circle btn-sm eliminarDetalle">' +
            '<i class="fas fa-times"></i> </button>' +
            '</td>';
        var btn = document.createElement("TR");
        tblBody.appendChild(btn);
        btn.innerHTML = fila;
        document.getElementById("detalle").appendChild(btn);
        calcular();
    }
    $('#exampleModal').modal('hide');
});

//Eliminar fila
$('#detalle').on('click', '.eliminarDetalle', function() {
    var fila = $(this).closest('tr');
    fila.remove();
    calcular();
});

$('#detalle').on('change', '.cantidad', function() {
    calcular();
});

function calcular() {
    var subtotal = 0;
    $('#detalle').find('tr').each(function() {
        var cantidad = $(this).find('td').eq(0).find('input').val();
        var precio = $(this).find('td').eq(2).text();
        var vTotal = cantidad * precio;
        subtotal += vTotal;
        $(this).find('td').eq(3).text(vTotal.toFixed(2));
    });
    $('#subtotal').text(subtotal.toFixed(2));
    $('#iva').text((subtotal * 0.12).toFixed(2));
    $('#total').text((subtotal * 1.12).toFixed(2));
}

function guardarFactura() {
    var idFactura = $('#id').val();
    var fecha = $('#fecha').val();
    var idCliente = $('#cliente').val();
    var total = $('#total').text();
    datos = {
        id: idFactura,
        fecha: fecha,
        cliente: idCliente,
        total: total,
    }
    console.log(datos);
    $.ajax({
        url: "?c=Factura&a=GuardarJSON",
        type: "POST",
        data: datos,
        dataType: 'json'
    }).done(function(respuesta) {
        if (respuesta && respuesta > 0) {
            guardarDetalle(function(r) {
                console.log(r);
                if (r) {
                    Swal.fire(
                        'Correcto',
                        'Se ha guardado correctamente',
                        'success'
                    )
                    Swal.fire({
                        title: 'Se ha guardado correctamente',
                        showCancelButton: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.replace("?c=Factura");
                        }
                    })

                } else {
                    Swal.fire(
                        'Error',
                        'Ha ocurrido un error al guardar detalle',
                        'error'
                    )
                }
            });
        } else {
            Swal.fire(
                'Error',
                'Ha ocurrido un error al guardar factura',
                'error'
            )
        }
    });
}

function guardarDetalle(cb) {
    var band = false;
    var count = 0;
    $('#detalle').find('tr').each(function() {
        if (band || count == 0) {
            var idFactura = Number($('#id').val());
            var idProducto = $(this).find('input[name="id"]').val();
            var cantidad = $(this).find('td').eq(0).find('input').val();
            var precio = $(this).find('td').eq(2).text();
            var vTotal = cantidad * precio;
            datos = {
                factura: idFactura,
                producto: idProducto,
                cantidad: cantidad,
                subtotal: vTotal,
            }
            $.ajax({
                async: false,
                url: "?c=Detalle&a=GuardarJSON",
                type: "POST",
                data: datos,
                dataType: 'json'
            }).done(function(respuesta) {
                if (respuesta > 0) {
                    band = true;
                }
            });
        }
        count++;
    });
    cb(band);
}

$("#frm-factura").submit(function(e) {
    e.preventDefault();
    guardarFactura();
});
</script>