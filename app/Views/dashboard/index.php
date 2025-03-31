<?= $this->extend('layout/menu') ?>
<?= $this->section('content')?>
<?= $this->section('title')?>
    Dashboard 
<?= $this->endSection()?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <div class="d-sm-flex d-block align-items-center mb-4">
        <div class="me-auto">
            <h4 class="fs-20 text-black">Eventos registrados</h4>
        </div>

        <button class="btn btn-light btn-rounded" id="modalEvento" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg" data-modo="nuevo">
            <i class="las la-calendar-alt scale5 me-3"></i>
            Registrar evento
        </button>

    </div>

    <div class="table-responsive table-hover fs-14">
        <table class="table display mb-4 dataTablesCard" id="eventosTable" style=" width: 100%;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Fechas</th>
                    <th>Recinto</th>
                    <th>Fecha de registro</th>
                    <th>Clave</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">

                    <div>
                        <h5 class="modal-title" id="modal-title">Registro de evento</h5>
                        </br>

                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>
                <form id="formEvento">
                    <div class="modal-body">
                            <div class="tab-content" id="nav-tabContent">
                                <input type="text" name="id_evento" id="id_evento" hidden>
                                <input type="text" name="id_user" id="id_user" hidden>

                                <div class="form-group">
                                    <div class="row ">
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="start_date1">Fecha inicio</label>
                                            <input type="date" name="start_date1" id="start_date1" 
                                                autocomplete="off" class="form-control" placeholder="DD/MM/YYYY" data-convert-date-format="1"
                                                required data-pristine-required-message="Necesita seleccionar un rango de fecha"
                                            >
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="start_date2">Fecha fin</label>
                                            <input type="date" name="start_date2" id="start_date2" autocomplete="off" 
                                                class="form-control" placeholder="DD/MM/YYYY" data-convert-date-format="1"
                                                required data-pristine-required-message="Necesita seleccionar un rango de fecha"
                                            >
                                        </div>
                                        <div class="col-md-12">
                                            <label for="select_evento">Selecciona los eventos:</label>
                                            <select id="select_evento" name="evento" onchange="handleObtenerEventos(event)"
                                                class="js-example-basic-multiple js-states form-control"
                                                required data-pristine-required-message="Seleccione un evento"
                                            >
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <p class="fs-5 text-center">Fechas</p>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Inicio</label>
                                    <div class="form-group col-sm-4">
                                        <input 
                                            type="datetime-local" class="form-control" name="fecha_inicio" id="fecha_inicio" 
                                            required readonly data-pristine-required-message="La fecha de inicio es obligatoria"
                                        >
                                    </div>
                                    <label class="col-sm-2 col-form-label">Fin</label>
                                    <div class="form-group col-sm-4">
                                        <input type="datetime-local" class="form-control" name="fecha_fin" id="fecha_fin" 
                                            required readonly data-pristine-required-message="La fecha de fin es obligatoria"
                                        >
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Nombre del recinto</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" placeholder="Ingrese el nombre del recinto" name="recinto" id="recinto" 
                                            required readonly data-pristine-required-message="El nombre del recinto es obligatorio"
                                        >
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Ubicación del recinto</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" required
                                            placeholder="Ciudad, estado" name="recinto_ub" id="recinto_ub" readonly
                                            data-pristine-required-message="El estado del recinto es obligatorio"
                                        >
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <div class="mb-3">
                            <button type="button" class="btn btn-danger" id="cerrarModal" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success" id="btnGuardar" data-modo="nuevo">Guardar cambios</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<script>
        let table;
        let selectEvento = document.getElementById("select_evento");
        let listaEventos = [];

        let id_user = document.querySelector("#id_user"); 
        let recinto = document.querySelector("#recinto");
        let fecha_fin = document.querySelector("#fecha_fin");
        let id_evento = document.querySelector("#id_evento"); 
        let recinto_ub = document.querySelector("#recinto_ub");
        let start_date1 = document.querySelector("#start_date1");
        let start_date2 = document.querySelector("#start_date2");
        let fecha_inicio = document.querySelector("#fecha_inicio");

        const btnEditar = document.getElementById("btnEditar");
        const btnBorrar = document.getElementById("btnBorrar");
        const btnGuardar = document.getElementById("btnGuardar");
        const btnNuevo = document.getElementById("btnNuevo");

        const modal = document.querySelector(".bd-example-modal-lg");

        modal.addEventListener('show.bs.modal', (event) => {

            const selectEvento = $('#select_evento');  // Usar jQuery

            // Limpiar opciones previas
            selectEvento.empty();
            
            // Asegúrate de que haya opciones en el select
            selectEvento.append(new Option("Seleccione un rango de fecha", "0"));

            const button = event.relatedTarget;  // Botón que disparó el modal
            const modo = button.dataset.modo;  // Obtener el modo
            const modalTitle = document.getElementById('modal-title');

            if (modo === 'nuevo') {
                // Modo nuevo
                modalTitle.textContent = 'Nuevo evento';
                document.getElementById('id_evento').value = '';  // Limpiar ID
                document.getElementById('btnGuardar').textContent = 'Guardar nuevo';
                document.getElementById('btnGuardar').dataset.modo = 'registrar';
            }

            if (modo === 'editar') {
                const id = button.getAttribute('data-id');  // Obtener el modo

                modalTitle.textContent = 'Editar registro';
                document.getElementById('btnGuardar').textContent = 'Guardar cambios';
                document.getElementById('btnGuardar').dataset.modo = 'editar';

                obtener_info_evento(id);
            }

            // Inicializa Select2 después de añadir opciones
            selectEvento.select2({
                placeholder: "Selecciona uno o más eventos",
                allowClear: true
            });

        });

        modal.addEventListener('hidden.bs.modal', () => {
            const form = document.getElementById('formEvento');
            form.reset();

            // Limpiar campos readonly
            form.querySelectorAll('[readonly]').forEach(input => input.value = '');
        });

        const obtener_info_evento = (id) => {
            apiRequest("<?= base_url('Eventos/obtener_evento'); ?>"+"/"+id, "GET", null)
            .then(data => {
                const {id_evento, nombre_evento, sic_id, fecha_inicio, fecha_fin, recinto, estado, id_user} = data.data;
                infoEvento("edit", id_evento, nombre_evento, sic_id, fecha_inicio, fecha_fin, recinto, estado, id_user);
            })
            .catch(error => console.error("Error:", error));
        }

        const infoEvento = (mode, id, evento, sic_id, fecha_init, fecha_final, nm_recinto, estado, id_usuario) => {

            fecha_inicio.value = fecha_init;
            fecha_fin.value = fecha_final;
            recinto.value = nm_recinto;
            recinto_ub.value = estado;
            if(mode == "edit"){
                start_date1.value = formatFecha(fecha_init);
                start_date2.value = formatFecha(fecha_final);
                id_evento.value = id;
                id_user.value = id_usuario;
                
                gestionarFechasYEventos(() => {
                    const select = document.getElementById("select_evento");
                    const opcion = select.querySelector(`option[value="${sic_id}"]`);

                    if (opcion) {
                        opcion.selected = true;  // Marca la opción como seleccionada
                    } else {
                        console.warn(`No se encontró la opción con ID: ${sic_id}`);
                    }

                });
            }
        }

        $(document).ready(() => {
            table = $('#eventosTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "<?= base_url('Dashboard/eventos_registrados'); ?>"
            });
        });

        const limpiarSelect = () => {
            $("#select_evento").val("")
            selectEvento.innerHTML = "";
        }

        //Formatea las fechas porque desde el server vienen en otro formato
        const formatFecha = (fechaCadena) => {
            let dia;
            let mes;
            let year;
            let horas;
            let minutos;

            const fecha = new Date(fechaCadena);

            // Verificar si la fecha tiene el formato extendido (con "T" y la hora)
            if (fechaCadena.includes("T")) {
                
                dia = String(fecha.getDate()).padStart(2, '0');
                mes = String(fecha.getMonth() + 1).padStart(2, '0');
                year = fecha.getFullYear();
                horas = String(fecha.getHours()).padStart(2, '0');
                minutos = String(fecha.getMinutes()).padStart(2, '0');

                return `${year}-${mes}-${dia} ${horas}:${minutos}`;
            }


            if (isNaN(fecha)) {
                console.warn(`Fecha inválida: ${fechaCadena}`);
                return "";
            }

            year = fecha.getFullYear();
            mes = String(fecha.getMonth() + 1).padStart(2, '0');
            dia = String(fecha.getDate()).padStart(2, '0');

            return `${year}-${mes}-${dia}`;
        };

        //maneja el evento que se realiza cuando los inputs de fecha cambian su valor
        const gestionarFechasYEventos = (callback) => {
            $("#start_date1, #start_date2").off("change").on("change", () => {
                const startDate1 = $("#start_date1").val();
                const startDate2 = $("#start_date2").val();

                if (startDate1 && startDate2) {
                    if (startDate2 < startDate1) {
                        Swal.fire({
                            icon: "error",
                            title: "Error.",
                            text: "La fecha fin no puede ser menor que la de inicio",
                        });
                        $("#start_date2").val(""); 
                        limpiarSelect();
                        return;
                    }

                    const fechaInicio = formatFecha(startDate1);
                    const fechaFin = formatFecha(startDate2);

                    Swal.fire({
                        title: "Cargando eventos...",
                        html: "Por favor espere",
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    obtenerEventos(fechaInicio, fechaFin, (eventos) => {
                        Swal.close();

                        if (eventos.length === 0) {
                            Swal.fire({
                                title: "No se han encontrado eventos",
                                icon: "error",
                                confirmButtonText: "Ok",
                                confirmButtonColor: "#003DA5"
                            });
                        }

                        // Recibimos la función opcional que 
                        if (typeof callback === "function") {
                            callback();
                        }
                    });
                }
            });

            // Ejecutar la validación inicial si hay fechas seleccionadas
            const startDate1 = $("#start_date1").val();
            const startDate2 = $("#start_date2").val();
            // El trigger ejecuta el evento change cuando se cumpla la condición
            if (startDate1 && startDate2) {
                $("#start_date1").trigger("change");
            }
        };

        gestionarFechasYEventos();

        const obtenerEventos = (fechaInicio, fechaFin, callback) => {

            selectEvento.innerHTML = '<option value="-1" disabled selected>Cargando...</option>';
            selectEvento.value = -1;

            const requestData = {
                descripcion: "",
                fecha_inicio: fechaInicio,
                fecha_fin: fechaFin,
            };

            $.ajax({
                url: "<?= base_url('Dashboard/obtener_eventos'); ?>",
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(requestData),
                success: function (response) {

                    if(response.lenght < 1){
                        Swal.fire({
                            icon: 'warning',
                            title: 'No se han encontrado eventos',
                            text: 'No hay eventos registrados en este rango de fecha',
                        });
                    }

                    listaEventos = response;

                    for (const evento of response) {

                        const option = document.createElement('option');
                        option.value = evento.id_evento;
                        option.text = `${evento.descripcion}`;

                        selectEvento.appendChild(option);
                    }

                    
                    //hacemos un callback porque quien sa
                    if (callback) {
                        callback(listaEventos);
                    }

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error:', textStatus, errorThrown);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudo enviar la solicitud. Por favor, intenta de nuevo.',
                    });
                }
            });
            return listaEventos
        }

        const handleObtenerEventos = (e) => {
            e.preventDefault(); 
            const selectedEventos = $('#select_evento').val(); // Obtén los valores seleccionados
            if (selectedEventos && selectedEventos.length > 0) {
                // Crear el array de eventos con los datos necesarios
                eventosSeleccionados = listaEventos.find(evento => evento.id_evento === Number(selectedEventos));                
                const {recinto, paisEstado, inicio_evento, fin_evento, id_evento} = eventosSeleccionados;
                infoEvento("registrar", null, null, id_evento, inicio_evento, fin_evento, recinto, paisEstado, 0);
                
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Sin selección',
                    text: 'Por favor, selecciona al menos un evento.'
                });
            }
        };
        
        document.getElementById("formEvento").addEventListener("submit", (event) => {

            event.preventDefault();  // Evita el envío del formulario

            const modo = btnGuardar.dataset.modo;  // Obtener el modo
            const form = event.target;

            // Inicializar Pristine con configuraciones
            const pristine = new Pristine(form, {
                classTo: 'form-group',       
                errorClass: 'has-error',     
                successClass: 'has-success',
                errorTextParent: 'form-group',
                errorTextTag: 'div',
                errorTextClass: 'text-danger'
            }, true);

            // ➡️ Validar el formulario
            if (!pristine.validate()) {
                Swal.fire({
                    title: "Ingrese la información requerida",
                    icon: "error"
                });
                return;  // Detiene el envío si hay errores
            }

            // Si es válido, continúa con la lógica de envío
            const formData = new FormData(form);
            const formObject = {};

            formData.forEach((value, key) => {
                formObject[key] = value;
            });

            let select = document.getElementById("select_evento");
            let selectedText = select.options[select.selectedIndex].text;
            formObject["nombre_evento"] = selectedText;
            formObject["sic_id"] = select.value;

            // Enviar la petición a la API
            console.log(formObject);
            return;

            apiRequest(`${"<?= base_url('Eventos/guardar_evento'); ?>"}/${modo}`, "POST", formObject)
                .then(data => {
                    const { success, msg } = data;

                    Swal.fire({
                        title: msg,
                        icon: success ? "success" : "error"
                    });

                    if (success) {
                        table.ajax.reload();
                    }
                })
                .catch(error => console.error("Error:", error));
        });

	</script>

<?= $this->endSection(); ?>
