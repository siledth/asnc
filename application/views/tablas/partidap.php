 <!-- Bootstrap CSS -->
 <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <div class="panel-heading">
                    <h4 class="panel-title">Nueva Partida Presupuestaria</h4>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-2">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                            Nuevo
                        </button>

                        <!-- Modal insert -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Crear Partida Presupuestaria</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" id="form">
                                            <div class="form-group">
                                                <label for="">Codigo de la Partida Presupuestaria</label>
                                                <input type="text" class="form-control" id="codigopartida_presupuestaria" placeholder="ingrese el codigo de la partida presupuestaria">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Descripción de la Partida Presupuestaria</label>
                                                <input type="text" class="form-control" id="desc_partida_presupuestaria"  placeholder="ingrese la descripción de la partida presupuestaria">
                                            </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-primary" id="add">AGREGAR</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Modal -->
                    <div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post" id="update_form">
                                        <input type="hidden" id="edit_record_id" name="edit_record_id" value="">
                                        <div class="form-group">
                                            <label for="">Ingrese el Nuevo Codigo</label>
                                            <input type="text" class="form-control" id="edit_codigopartida_presupuestaria" >
                                        </div>
                                        <div class="form-group">
                                            <label for="">Ingrese la Descripción</label>
                                            <input type="text" class="form-control" id="edit_desc_partida_presupuestaria">
                                        </div>

                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" id="update">Editar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-md-10 mt-4">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="records">
                                <thead>
                                    <tr>
                                        <th>Número de fila</th>
                                        <th>Codigo</th>
                                        <th>Descripción</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
 <!-- Toastr -->
 <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
     <!-- Font Awesome -->
     <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/js/all.min.js"></script> -->

                <!-- Add Records -->
                <script>
                    $(document).on("click", "#add", function(e) {
                        e.preventDefault();

                        var desc_partida_presupuestaria = $("#desc_partida_presupuestaria").val();
                        var codigopartida_presupuestaria = $("#codigopartida_presupuestaria").val();
                        var id_usuario = 1; //esto debo arreglar
                        
                        //var fecha = '12/15/2020'; //esto debo arreglar
                        //alert(desc_partida_presupuestaria + '' + codigopartida_presupuestaria);
                        if (desc_partida_presupuestaria == "" || codigopartida_presupuestaria == "") {
                            alert("Both field is required");
                        } else {
                            $.ajax({
                                url: "<?php echo base_url(); ?>index.php/Fuentefinanc/savepartidap",
                                type: "post",
                                dataType: "json",
                                data: {
                                    codigopartida_presupuestaria: codigopartida_presupuestaria,
                                    desc_partida_presupuestaria: desc_partida_presupuestaria,
                                    id_usuario: id_usuario
                                },
                                success: function(data) {
                                    if (data.responce == "success") {
                                        $('#records').DataTable().destroy();
                                        fetch();
                                        $('#exampleModal').modal('hide');
                                        toastr["success"](data.message);
                                    } else {
                                        toastr["error"](data.message);
                                    }

                                }
                            });

                            $("#form")[0].reset();

                        }

                    });

                    // Fetch Records

                    function fetch() {
                        $.ajax({
                            url: "<?php echo base_url(); ?>index.php/Fuentefinanc/fetchpartidap",
                            type: "post",
                            dataType: "json",
                            success: function(data) {
                                if (data.responce == "success") {

                                    var i = "1";
                                    $('#records').DataTable({
                                        "data": data.posts,
                                        "responsive": true,
                                        dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                                            "<'row'<'col-sm-12'tr>>" +
                                            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                                        buttons: [
                                            'copy', 'excel', 'pdf'
                                        ],
                                        "columns": [{
                                                "render": function() {
                                                    return a = i++;
                                                }
                                            },
                                            {
                                                "data": "codigopartida_presupuestaria"
                                            },
                                            {
                                                "data": "desc_partida_presupuestaria"
                                            },
                                            {
                                                "render": function(data, type, row, meta) {
                                                    var a = `

                                    <a href="#" value="${row.id_partida_presupuestaria}" id="edit" class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></a>
                            `;
                                                    return a;
                                                }
                                            }
                                        ]
                                    });
                                } else {
                                    toastr["error"](data.message);
                                }

                            }
                        });

                    }

                    fetch();

                    // Delete Record

                    $(document).on("click", "#del", function(e) {
                        e.preventDefault();

                        var del_id = $(this).attr("value");

                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-success',
                                cancelButton: 'btn btn-danger mr-2'
                            },
                            buttonsStyling: false
                        })

                        swalWithBootstrapButtons.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'No, cancel!',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.value) {

                                $.ajax({
                                    url: "<?php echo base_url(); ?>index.php/Fuentefinanc/deletealicuota",
                                    type: "post",
                                    dataType: "json",
                                    data: {
                                        del_id: del_id
                                    },
                                    success: function(data) {
                                        if (data.responce == "success") {
                                            $('#records').DataTable().destroy();
                                            fetch();
                                            swalWithBootstrapButtons.fire(
                                                'Deleted!',
                                                'Your file has been deleted.',
                                                'success'
                                            );
                                        } else {
                                            swalWithBootstrapButtons.fire(
                                                'Cancelled',
                                                'Your imaginary file is safe :)',
                                                'error'
                                            );
                                        }

                                    }
                                });



                            } else if (
                                /* Read more about handling dismissals below */
                                result.dismiss === Swal.DismissReason.cancel
                            ) {
                                swalWithBootstrapButtons.fire(
                                    'Cancelled',
                                    'Your imaginary file is safe :)',
                                    'error'
                                )
                            }
                        });

                    });

                    // Edit Record

                    $(document).on("click", "#edit", function(e) {
                        e.preventDefault();

                        var edit_id = $(this).attr("value");

                        $.ajax({
                            url: "<?php echo base_url(); ?>index.php/Fuentefinanc/editpartidap",
                            type: "post",
                            dataType: "json",
                            data: {
                                edit_id: edit_id
                            },
                            success: function(data) {
                                if (data.responce == "success") {
                                    $('#edit_modal').modal('show');
                                    $("#edit_record_id").val(data.post.id_partida_presupuestaria);
                                    $("#edit_codigopartida_presupuestaria").val(data.post.codigopartida_presupuestaria);
                                    $("#edit_desc_partida_presupuestaria").val(data.post.desc_partida_presupuestaria);
                                } else {
                                    toastr["error"](data.message);
                                }
                            }
                        });

                    });

                    // Update Record

                    $(document).on("click", "#update", function(e) {
                        e.preventDefault();

                        var edit_record_id = $("#edit_record_id").val();
                        var edit_codigopartida_presupuestaria = $("#edit_codigopartida_presupuestaria").val();
                        var edit_desc_partida_presupuestaria = $("#edit_desc_partida_presupuestaria").val();

                        if (edit_record_id == "" || edit_codigopartida_presupuestaria == "" || edit_desc_partida_presupuestaria == "") {
                            alert("Both field is required");
                        } else {
                            $.ajax({
                                url: "<?php echo base_url(); ?>index.php/Fuentefinanc/updatepartidap",
                                type: "post",
                                dataType: "json",
                                data: {
                                    edit_record_id: edit_record_id,
                                    edit_codigopartida_presupuestaria: edit_codigopartida_presupuestaria,
                                    edit_desc_partida_presupuestaria: edit_desc_partida_presupuestaria
                                },
                                success: function(data) {
                                    if (data.responce == "success") {
                                        $('#records').DataTable().destroy();
                                        fetch();
                                        $('#edit_modal').modal('hide');
                                        toastr["success"](data.message);
                                    } else {
                                        toastr["error"](data.message);
                                    }
                                }
                            });

                        }

                    });
                </script>
