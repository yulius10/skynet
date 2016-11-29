<center>
    <nav>
        <ul class="fancyNav">
            <li>
                <a href="inicio.php" class="homeIcon">
                    Home
                    <br/>
                    &nbsp;
                </a>
            </li>
            <?php
                if($_SESSION['permiso']=="administrador"){
            ?>
            <li>
                <a href="insertar.php">
                    Insertar
                    <br/>
                    &nbsp;
                </a>
            </li>
            <li>
                <a href="subirExcel.php">
                    Importar
                    <br/>
                    &nbsp;
                </a>
            </li>
            <?php
                }
            ?>
            <li>
                <a href="panelModificaciones.php">
                    Panel de modificaciones
                    <br/>
                    &nbsp;
                </a>
            </li>
            <li>
                <a href="matrizDeshabilitadas.php">
                    Matrices Deshabilitadas/
                    <br/>
                    Delogadas
                </a>
            </li>
            <li>
                <a href="verMatriz.php">
                    Ver matriz
                    <br/>
                    &nbsp;
                </a>
            </li>
            <li>
                <a href="cerrar.php">
                    Salir
                    <br/>
                    &nbsp;
                </a>
            </li>
        </ul>
    </nav>
</center>