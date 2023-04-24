<div id="content" class="content">
    <div class="col-lg-12">
        <div class="row">

            <div class="col-1 mb-3">
                <button class="btn btn-circle waves-effect waves-circle waves-float btn-primary" type="submit"
                    onclick="printDiv('areaImprimir');" name="action">Imprimir</button>
            </div>
        </div>
        <div class="row" id="imp1">
            <div class="panel panel-inverse">
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-1">

                        </div>
                        <div class="col-1"></div>
                        <div class="card card-outline-danger text-center bg-white">
                            <div class="card-block">
                                <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                                    <img style="width: 100%" height="100%"
                                        src=" <?= base_url() ?>Plantilla/img/loij.png" alt="Card image">
                                </blockquote>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                        </div>




                        
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
        function printDiv(nombreDiv) {
            var contenido = document.getElementById('imp1').innerHTML;
            var contenidoOriginal = document.body.innerHTML;

            document.body.innerHTML = contenido;

            window.print();

            document.body.innerHTML = contenidoOriginal;
        }
        </script>