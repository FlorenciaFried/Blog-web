<!--BARRA LATERAL-->
    <aside id="sidebar">
        
    <div id="login" class="bloque">

           <h3>Buscador</h3>

           <form action="buscar.php" method="POST">
               
               <input type="text" name="busqueda" />
               <input type="submit" value="Buscar"/>

           </form>

           <?php cerrarErrorLogin(); ?>

       </div>
        
        <?php if(isset($_SESSION['usuario'])): ?>
        
            <div id="usuario-logueado" class="bloque">
                <h3> Bienvenido: <?= $_SESSION['usuario']['nombre'].' '. $_SESSION['usuario']['apellidos'];?></h3>
            
                <!-- BOTONES -->
                <a href="crearEntrada.php" class="boton">Crear entradas</a>
                <a href="crearCategoria.php" class="boton">Crear categoría</a>
                <a href="misDatos.php" class="boton">Mis datos</a>
                <a href="cerrar.php" class="boton">Cerrar sesión</a>

            </div>
        
        <?php endif; ?>
        
        <?php if(!isset($_SESSION['usuario'])): ?>

            <div id="login" class="bloque">

                <h3>Identificate</h3>

                <?php if(isset($_SESSION['error_login'])): ?>

                    <div class="alerta alerta-error">
                        <?= $_SESSION['error_login'];?>
                    </div>

                <?php endif; ?>

                <form action="login.php" method="POST">

                    <label for="email">Email</label>
                    <input type="text" name="email" />

                    <label for="password">Contraseña</label>
                    <input type="password" name="password" />

                    <input type="submit" value="Entrar"/>

                </form>

                <?php cerrarErrorLogin(); ?>

            </div>


            <div id="register" class="bloque">

                <h3>Registrate</h3>

                <?php if(isset($_SESSION['completado'])): ?>

                    <div class="alerta alerta-exito">
                        <?= $_SESSION['completado'] ?>             
                    </div>

                <?php elseif(isset($_SESSION['errores']['general'])): ?>

                    <div class="alerta alerta-error">
                        <?= $_SESSION['errores']['general'] ?>             
                    </div>            

                <?php endif; ?>

                <form action="registro.php" method="POST">

                    <label for="nombres">Nombres</label>
                    <input type="text" name="nombres" />
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombres') : ''; ?>

                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" />
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>


                    <label for="email">Email</label>
                    <input type="text" name="email" />
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>


                    <label for="password">Contraseña</label>
                    <input type="password" name="password" />
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?>

                    <input type="submit" name="submit" value="Registrar"/>

                </form>

                <?php borrarErrores(); ?>

            </div>
        
        <?php endif; ?>
        
    </aside>

