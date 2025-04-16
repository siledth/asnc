  <script src="<?=base_url()?>js/usuario/edpass.js"></script>

  <body class="hold-transition login-page fondo">
      <div class="login-box r">
          <div class="card r">
              <div class="card-body r login-card-body">
                  <div class="login-logo text-center">
                      <a href="https://www.snc.gob.ve/" target="_blank">
                          <img class="img" src="<?php echo base_url('baner/logo2.png'); ?>" alt="Logo SNC">
                      </a>
                  </div>
                  <h2 class="login-box-msg ">Sistema Integrado SNC</h2>
                  <h5 class="login-box-msg ">Ingrese Nueva Clave</h5>
                  <form class="form form-register" id="camb_clave" method="post" novalidate>
                      <div class="row">
                          <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>">
                          <input type="hidden" name="token" value="<?= $token ?>">
                          <div class="col-12">
                              <div class="input-group mb-3">
                                  <input type="text" id="clave" name="clave" class="form-control"
                                      placeholder="Contraseña">
                                  <div class="input-group-append">
                                      <div class="input-group-text">
                                          <span class="fas fa-lock"></span>

                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-12">
                              <div class="input-group mb-3">
                                  <input type="password" id="c_clave" name="c_clave" class="form-control"
                                      placeholder="Contraseña">
                                  <div class="input-group-append">
                                      <div class="input-group-text">
                                          <span class="fas fa-lock"></span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="mb-4">

                          <div class="col-6 center">
                              <div class="form-group col 12 text-center">
                                  <button type="button" onclick="camb_clave();"
                                      class="btn btn-success btn-block">Cambiar
                                      Contraseña</button>
                              </div>
                          </div>
                      </div>
                  </form>
                  <div class="mb-4">

                      <div class="col-6 center">
                          <button type="button" onclick="location.href='<?php echo base_url() ?>index.php/login1'"
                              class="btn btn-info btn-block r">
                              Cancelar
                          </button>


                      </div>
                  </div>


              </div>
          </div>
      </div>
  </body>