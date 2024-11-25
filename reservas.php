<?php include 'header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form action="reserva.php" method="post">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="fecha">Fecha de la Reserva:</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="hora">Hora de la Reserva:</label>
                    <select name="hora" id="hora" class="form-control" required>
                        <option value="">-- Selecciona una Hora --</option>
                        <?php
                        for ($i = 12; $i <= 20; $i++) {
                            echo "<option value='$i:00'>$i:00</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="pack">Selecciona tu Pack:</label>
                    <select name="pack" id="pack" class="form-control" required>
                        <option value="">-- Selecciona un Pack --</option>
                        <option value="Pack ECO">Pack ECO</option>
                        <option value="Pack TOTAL Experience">Pack TOTAL Experience</option>
                        <option value="Sala de Escape RV">Sala de Escape RV</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="cumpleanos">¿Es para un cumpleaños?</label>
                    <select name="cumpleanos" id="cumpleanos" class="form-control">
                        <option value="">-- Selecciona una opción --</option>
                        <option value="si">Sí</option>
                        <option value="no">No</option>
                    </select>
                </div>

                <div class="form-group" id="personas-group" style="display: none;">
                    <label for="personas">Número de personas (máximo 8):</label>
                    <input type="number" name="personas" id="personas" class="form-control" min="1" max="8">
                </div>

                <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Enviar</button>
            </form>
        </div>

        <div class="col-md-6 px-3 py-4">
            <h2>Información adicional:</h2>
            <p>Reserva realidad virtual en Málaga. Elige entre las diferentes opciones que tenemos en nuestro centro, para reservar realidad virtual en Málaga:</p>
            <ul>
                <li><strong>Experiencia RV:</strong> Disfruta de 1 Experiencia básica de 10 minutos de Realidad Virtual.
                    Ideal para iniciarse o para aquellos que simplemente quieran probar la nueva tecnología de la que
                    todos hablan.</li>
                <li><strong>Pack ECO:</strong> Si quieres más, esta es la opción recomendada para la mayoría de los
                    usuarios. Prueba 1 Experiencia Premium de 20 minutos y además te regalamos un simulador de realidad
                    virtual a elegir (montaña rusa o simulador de conducción)</li>
                <li><strong>Pack TOTAL Experience:</strong> Esta es la opción más amplia para los más jugones. Disfruta
                    de 40 minutos donde podrás elegir varias experiencias básicas o premium de tu elección. Además,
                    disfrutarás de un simulador de realidad virtual a elegir.</li>
                <li><strong>Sala de Escape RV:</strong> Somos el único lugar donde poder disfrutar de salas de escape en
                    Realidad Virtual en Málaga. Disponemos de múltiples salas de escape para disfrutar con diferentes
                    niveles de dificultad para jugar hasta 4 personas de forma simultánea. Tendrás un máximo de 60
                    minutos para poder resolver los puzles y escapar de los diferentes escenarios.</li>
            </ul>
            <p>Recuerda que si vienes sin reserva previa, también podrás jugar aunque quizás tendrás que esperar un poco
                ya que atendemos por orden de llegada.</p>
        </div>
    </div>
</div>

<script>

document.getElementById('cumpleanos').addEventListener('change', function() {
    const personasGroup = document.getElementById('personas-group');
    if (this.value === 'si') {
        personasGroup.style.display = 'block';
    } else {
        personasGroup.style.display = 'none';
        document.getElementById('personas').value = ''; 
    }
});
</script>

<?php include 'footer.php'; ?>