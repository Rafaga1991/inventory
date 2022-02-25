<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4">Sistema de Inventario</h3>
                            </div>
                            <div class="card-body">
                                {!!MESSAGE!!}
                                <form action="{!!ACCESS!!}" method="POST">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" name="username" placeholder="nombre de usuario" />
                                        <label><i class="fas fa-user"></i> Usuario</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="password" name="password" placeholder="contraseña" />
                                        <label><i class="fas fa-lock"></i> Contrase&ntilde;a</label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="remember" value="true" />
                                        <label class="form-check-label">Recordar Credenciales</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0 text-end">
                                        <button type="submit" class="btn btn-primary">Acceder</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small text-muted fs-6">Bienvenid@, inicia sesi&oacute;n para acceder.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        {!!FOOTER!!}
    </div>
</div>