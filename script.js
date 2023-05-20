let cursos = [];
let monitores = [];

const cursosBtn = document.getElementById('cursosBtn');
const monitoresBtn = document.getElementById('monitoresBtn');
const cursosContainer = document.getElementById('cursosContainer');
const monitoresContainer = document.getElementById('monitoresContainer');
const cursoForm = document.getElementById('cursoForm');
const monitorForm = document.getElementById('monitorForm');
const tablaCursos = document.getElementById('tablaCursos');
const tablaMonitores = document.getElementById('tablaMonitores');
const tablaCursosBody = document.getElementById('tablaCursosBody');
const tablaMonitoresBody = document.getElementById('tablaMonitoresBody');

cursosBtn.addEventListener('click', () => {
  cursosContainer.style.display = 'block';
  monitoresContainer.style.display = 'none';
  tablaCursos.style.display = 'block';
  tablaMonitores.style.display = 'none';
});

monitoresBtn.addEventListener('click', () => {
  cursosContainer.style.display = 'none';
  monitoresContainer.style.display = 'block';
  tablaCursos.style.display = 'none';
  tablaMonitores.style.display = 'block';
});

cursoForm.addEventListener('submit', (e) => {
  e.preventDefault();
  const codigoCurso = document.getElementById('codigoCurso').value;
  const nombreCurso = document.getElementById('nombreCurso').value;
  const curso = { codigo: codigoCurso, nombre: nombreCurso };
  cursos.push(curso);
  mostrarCursosEnTabla();
  cursoForm.reset();
});

monitorForm.addEventListener('submit', (e) => {
  e.preventDefault();
  const codigoMonitor = document.getElementById('codigoMonitor').value;
  const nombreMonitor = document.getElementById('nombreMonitor').value;
  const cursoMonitor = document.getElementById('cursoMonitor').value;
  const horario = document.getElementById('horario').value;
  const lugar = document.getElementById('lugar').value;
  const monitor = { codigo: codigoMonitor, nombre: nombreMonitor, curso: cursoMonitor, horario: horario, lugar: lugar };
  monitores.push(monitor);
  mostrarMonitoresEnTabla();
  monitorForm.reset();
});

function mostrarCursosEnTabla() {
  tablaCursosBody.innerHTML = '';
  for (let i = 0; i < cursos.length; i++) {
    const curso = cursos[i];
    const fila = `
      <tr>
        <td>${curso.codigo}</td>
        <td>${curso.nombre}</td>
        <td>
          <button class="editarBtn" data-index="${i}" data-tipo="curso">Editar</button>
          <button class="eliminarBtn" data-index="${i}" data-tipo="curso">Eliminar</button>
        </td>
      </tr>
    `;
    tablaCursosBody.innerHTML += fila;
  }
  agregarEventosEditarEliminar();
}

function mostrarMonitoresEnTabla() {
  tablaMonitoresBody.innerHTML = '';
  for (let i = 0; i < monitores.length; i++) {
    const monitor = monitores[i];
    const fila = `
      <tr>
        <td>${monitor.codigo}</td>
        <td>${monitor.nombre}</td>
        <td>${monitor.curso}</td>
        <td>${monitor.horario}</td>
        <td>${monitor.lugar}</td>
        <td>
          <button class="editarBtn" data-index="${i}" data-tipo="monitor">Editar</button>
          <button class="eliminarBtn" data-index="${i}" data-tipo="monitor">Eliminar</button>
        </td>
      </tr>
    `;
    tablaMonitoresBody.innerHTML += fila;
  }
  agregarEventosEditarEliminar();
}

function agregarEventosEditarEliminar() {
  const editarBtns = document.getElementsByClassName('editarBtn');
  const eliminarBtns = document.getElementsByClassName('eliminarBtn');

  for (let i = 0; i < editarBtns.length; i++) {
    const editarBtn = editarBtns[i];
    editarBtn.addEventListener('click', editarElemento);
  }

  for (let i = 0; i < eliminarBtns.length; i++) {
    const eliminarBtn = eliminarBtns[i];
    eliminarBtn.addEventListener('click', eliminarElemento);
  }
}

function editarElemento(e) {
  const tipo = e.target.getAttribute('data-tipo');
  const index = e.target.getAttribute('data-index');

  if (tipo === 'curso') {
    const curso = cursos[index];
    const nuevoNombre = prompt('Ingrese el nuevo nombre del curso', curso.nombre);
    if (nuevoNombre) {
      curso.nombre = nuevoNombre;
      mostrarCursosEnTabla();
    }
  } else if (tipo === 'monitor') {
    const monitor = monitores[index];
    const nuevoNombre = prompt('Ingrese el nuevo nombre del monitor', monitor.nombre);
    if (nuevoNombre) {
      monitor.nombre = nuevoNombre;
      mostrarMonitoresEnTabla();
    }
  }
}

function eliminarElemento(e) {
  const tipo = e.target.getAttribute('data-tipo');
  const index = e.target.getAttribute('data-index');

  if (tipo === 'curso') {
    cursos.splice(index, 1);
    mostrarCursosEnTabla();
  } else if (tipo === 'monitor') {
    monitores.splice(index, 1);
    mostrarMonitoresEnTabla();
  }
}
