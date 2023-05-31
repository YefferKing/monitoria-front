<?php
$conexion = mysqli_connect('localhost', 'root', '123456', 'modulo_monitorias')
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="styles.css">
  <title>Monitorias</title>
</head>

<body>

  <div class="rectangulo">
    <img class="img" src="img/logosimon.png" alt="Imagen de ejemplo">
  </div>
  <br>
  <div class="elemento">
    <p>--------------------------------------------------------</p>
    <h3><img src="img/menu_hamburguesa.png" width="20" height="20"> Caja de herramientas</h3>
    <h4 class="mini-menu-herramientas">Biblioteca</h4>
    <h4 class="mini-menu-herramientas">Bienestar Universitario</h4>
    <h4 class="mini-menu-herramientas">MINOR</h4>
    <h4 class="mini-menu-herramientas">PIEA</h4>
    <p>--------------------------------------------------------</p>
    <h3><img src="img/image (1).png" width="20" height="20"> Insignias recientes</h3>
    <h4 class="mini-menu-herramientas-ins">No tiene insignias que mostrar</h4>
  </div>

  <div class="rec-pequeño">
    <h1 class="h1">MONITORIAS</h1>
  </div>
  <div id="hover" class="mini-menu">
    <ul>
      <li><a id="cursosBtn" href="#">Monitores</a></li>
      <li><a id="monitoresBtn" href="#">Cursos</a></li>
    </ul>

    <div id="cursosContainer" style="display: none;">
      <h3 class="text">Listado de Monitores</h3>
      <table>
        <tr>
          <td>Nombre Monitor</td>
          <td>Telefono</td>
          <td>Email</td>
          <td>Curso</td>
          <td>Horario</td>
          <td>Lugar</td>
        </tr>
        <?php
        $sql = "SELECT instructor.*, course.nameCourse, schedule.dayDate,schedule.startTime,schedule.endTime,schedule.place
                FROM instructor
                JOIN course ON instructor.Id = course.Id
                JOIN schedule ON instructor.Id = schedule.Id";
        $result = mysqli_query($conexion, $sql);
        while ($mostrar = mysqli_fetch_array(($result))) {
        ?>

          <tr>
            <td><?php echo $mostrar['nameInstructor'] ?></td>
            <td><?php echo $mostrar['phone'] ?></td>
            <td><?php echo $mostrar['email'] ?></td>
            <td><?php echo $mostrar['nameCourse'] ?></td>
            <td><?php echo $mostrar['dayDate'] . ' ' . $mostrar['startTime'] . ' - ' . $mostrar['endTime']; ?></td>
            <td><?php echo $mostrar['place'] ?></td>
          </tr>
        <?php
        }
        ?>
      </table>

    </div>

    <div id="monitoresContainer" style="display: none;">
      <h3 class="text">Listado de Cursos</h3>
      <table>
        <tr>
          <td>Id</td>
          <td>Nombre</td>
          <td>Detalle</td>
        </tr>
        <?php
        $sql = "SELECT * FROM course";
        $result = mysqli_query($conexion, $sql);
        while ($mostrar = mysqli_fetch_array(($result))) {
        ?>

          <tr>
            <td><?php echo $mostrar['id'] ?></td>
            <td><?php echo $mostrar['nameCourse'] ?></td>
            <td><button class="boton-verde" data-toggle="modal" data-target="#exampleModal" onclick="hacerAlgo('<?php echo $mostrar['id'] ?>')">Ver</button></td>
          </tr>
        <?php
        }
        ?>
      </table>

    </div>

    <style>
      .boton-verde {
        background-color: green;
        border-radius: 5px;
        color: white;
      }
    </style>
    <script src="script.js"></script>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Monitores del Curso</h5>
          <label></label>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php 
        $idCurso = "SELECT id FROM course";
        $sql = "SELECT instructor.nameInstructor
        FROM instructor
        INNER JOIN course ON course.Id = instructor.courseId
        WHERE course.Id = '1'";
        $result = mysqli_query($conexion, $sql);
        while ($mostrar = mysqli_fetch_array(($result))) {
        ?>
        <div class="modal-body">
          <label><?php echo $mostrar['nameInstructor']?></label>
        </div>
        <?php 
          }
        ?>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>

<?php
$autostart_modal = isset($_REQUEST['autostart_modal']) && $_REQUEST['autostart_modal'];
if ($autostart_modal) :
?>
  <script>
    $(function() {
      $('#exampleModal').modal('show');
    })
  </script>;
<?php endif; ?>

</body>

</html>