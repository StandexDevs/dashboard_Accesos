<?= $this->extend('layout/menu') ?>
<?= $this->section('content')?>
<?= $this->section('title')?>
    Dashboard 
<?= $this->endSection()?>

    <div class="d-sm-flex d-block align-items-center mb-4">
        <div class="me-auto">
            <h4 class="fs-20 text-black">Eventos registrados</h4>
        </div>

        <button class="btn btn-light btn-rounded" id="modalEvento" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">
            <i class="las la-calendar-alt scale5 me-3"></i>
            Registrar evento
        </button>

    </div>

    <div class="table-responsive table-hover fs-14">
        <table class="table display mb-4 dataTablesCard " id="example5">
            <thead>
                <tr>
                    <th>ID Invoice</th>
                    <th>Date</th>
                    <th>Recipient</th>
                    <th>Email</th>
                    <th>Service Type</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="text-black font-w500">#123412451</span></td>
                    <td><span class="text-black text-nowrap">#June 1, 2020, 08:22 AM</span></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="fs-16 text-black font-w600 mb-0 text-nowrap">XYZ Store ID</h6>
                                <span class="fs-14">Online Shop</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="text-black">xyzstore@mail.com</span></td>
                    <td><span class="text-black">Server Maintenance </span></td>
                    <td><a href="<?= base_url('eventos/') ?>" class="btn btn-success btn-rounded">Completed</a></td>
                    <td>
                        <div class="dropdown mb-auto">
                            <div class="btn-link" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 11.9999C10 13.1045 10.8954 13.9999 12 13.9999C13.1046 13.9999 14 13.1045 14 11.9999C14 10.8954 13.1046 9.99994 12 9.99994C10.8954 9.99994 10 10.8954 10 11.9999Z" fill="black"></path>
                                    <path d="M10 4.00006C10 5.10463 10.8954 6.00006 12 6.00006C13.1046 6.00006 14 5.10463 14 4.00006C14 2.89549 13.1046 2.00006 12 2.00006C10.8954 2.00006 10 2.89549 10 4.00006Z" fill="black"></path>
                                    <path d="M10 20C10 21.1046 10.8954 22 12 22C13.1046 22 14 21.1046 14 20C14 18.8954 13.1046 18 12 18C10.8954 18 10 18.8954 10 20Z" fill="black"></path>
                                </svg>
                            </div>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                <a class="dropdown-item" href="javascript:void(0)">Edit</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><span class="text-black font-w500">#123412451</span></td>
                    <td><span class="text-black text-nowrap">#June 1, 2020, 08:22 AM</span></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="fs-16 font-w600 mb-0 text-nowrap"><a href="javascript:void(0)" class="text-black">David Oconner</a></h6>
                            </div>
                        </div>
                    </td>
                    <td><span class="text-black">davidocon@mail.com</span></td>
                    <td><span class="text-black">Clean Up </span></td>
                    <td><a href="javascript:void(0)" class="btn btn-warning btn-rounded">Pending</a></td>
                    <td>
                        <div class="dropdown mb-auto">
                            <div class="btn-link" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 11.9999C10 13.1045 10.8954 13.9999 12 13.9999C13.1046 13.9999 14 13.1045 14 11.9999C14 10.8954 13.1046 9.99994 12 9.99994C10.8954 9.99994 10 10.8954 10 11.9999Z" fill="black"></path>
                                    <path d="M10 4.00006C10 5.10463 10.8954 6.00006 12 6.00006C13.1046 6.00006 14 5.10463 14 4.00006C14 2.89549 13.1046 2.00006 12 2.00006C10.8954 2.00006 10 2.89549 10 4.00006Z" fill="black"></path>
                                    <path d="M10 20C10 21.1046 10.8954 22 12 22C13.1046 22 14 21.1046 14 20C14 18.8954 13.1046 18 12 18C10.8954 18 10 18.8954 10 20Z" fill="black"></path>
                                </svg>
                            </div>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                <a class="dropdown-item" href="javascript:void(0)">Edit</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><span class="text-black font-w500">#123412451</span></td>
                    <td><span class="text-black text-nowrap">#June 1, 2020, 08:22 AM</span></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="fs-16 font-w600 mb-0 text-nowrap"><a href="javascript:void(0)" class="text-black">Julia Esteh</a></h6>
                            </div>
                        </div>
                    </td>
                    <td><span class="text-black">juliaesteh@mail.com</span></td>
                    <td><span class="text-black">Upgrade Component </span></td>
                    <td><a href="javascript:void(0)" class="btn btn-dark btn-rounded">Canceled</a></td>
                    <td>
                        <div class="dropdown mb-auto">
                            <div class="btn-link" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 11.9999C10 13.1045 10.8954 13.9999 12 13.9999C13.1046 13.9999 14 13.1045 14 11.9999C14 10.8954 13.1046 9.99994 12 9.99994C10.8954 9.99994 10 10.8954 10 11.9999Z" fill="black"></path>
                                    <path d="M10 4.00006C10 5.10463 10.8954 6.00006 12 6.00006C13.1046 6.00006 14 5.10463 14 4.00006C14 2.89549 13.1046 2.00006 12 2.00006C10.8954 2.00006 10 2.89549 10 4.00006Z" fill="black"></path>
                                    <path d="M10 20C10 21.1046 10.8954 22 12 22C13.1046 22 14 21.1046 14 20C14 18.8954 13.1046 18 12 18C10.8954 18 10 18.8954 10 20Z" fill="black"></path>
                                </svg>
                            </div>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                <a class="dropdown-item" href="javascript:void(0)">Edit</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><span class="text-black font-w500">#123412451</span></td>
                    <td><span class="text-black text-nowrap">#June 1, 2020, 08:22 AM</span></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="fs-16 font-w600 mb-0 text-nowrap"><a href="javascript:void(0)" class="text-black">Power Supp Store</a></h6>
                                <span class="fs-14">Online Shop</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="text-black">xyzstore@mail.com</span></td>
                    <td><span class="text-black">Server Maintenance </span></td>
                    <td><a href="javascript:void(0)" class="btn btn-success btn-rounded">Completed</a></td>
                    <td>
                        <div class="dropdown mb-auto">
                            <div class="btn-link" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 11.9999C10 13.1045 10.8954 13.9999 12 13.9999C13.1046 13.9999 14 13.1045 14 11.9999C14 10.8954 13.1046 9.99994 12 9.99994C10.8954 9.99994 10 10.8954 10 11.9999Z" fill="black"></path>
                                    <path d="M10 4.00006C10 5.10463 10.8954 6.00006 12 6.00006C13.1046 6.00006 14 5.10463 14 4.00006C14 2.89549 13.1046 2.00006 12 2.00006C10.8954 2.00006 10 2.89549 10 4.00006Z" fill="black"></path>
                                    <path d="M10 20C10 21.1046 10.8954 22 12 22C13.1046 22 14 21.1046 14 20C14 18.8954 13.1046 18 12 18C10.8954 18 10 18.8954 10 20Z" fill="black"></path>
                                </svg>
                            </div>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                <a class="dropdown-item" href="javascript:void(0)">Edit</a>
                            </div>
                        </div>
                    </td>
                </tr>
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

                                <div class="form-group">
                                    <div class="row ">
                                        <div class="col-md-6 mb-3">
                                            <label for="start_date1">Fecha inicio</label>
                                            <input type="date" name="start_date1" id="start_date1" autocomplete="off" class="form-control" placeholder="DD/MM/YYYY" data-convert-date-format="1">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="start_date2">Fecha fin</label>
                                            <input type="date" name="start_date2" id="start_date2" autocomplete="off" class="form-control" placeholder="DD/MM/YYYY" data-convert-date-format="1">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="select_evento">Selecciona los eventos:</label>
                                            <select id="select_evento" onchange="handleObtenerEventos(event)"
                                                class="js-example-basic-multiple js-states form-control"
                                                name="evento">
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <p class="fs-5 text-center">Fechas</p>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Inicio</label>
                                    <div class="col-sm-4">
                                        <input type="datetime-local" class="form-control" name="fecha_inicio" id="fecha_inicio" readonly>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Fin</label>
                                    <div class="col-sm-4">
                                        <input type="datetime-local" class="form-control" name="fecha_fin" id="fecha_fin" readonly>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Nombre del recinto</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Ingrese el nombre del recinto" name="recinto" id="recinto" readonly>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Ubicación del recinto</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Ciudad, estado" name="recinto_ub" id="recinto_ub" readonly>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <div class="mb-3">
                            <button type="button" class="btn btn-danger" id="cerrarModal" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success" id="btnGuardar">Guardar cambios</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

	<script>
        let selectEvento = document.getElementById("select_evento");
        let listaEventos = [];

        let fecha_inicio = document.querySelector("#fecha_inicio");
        let fecha_fin = document.querySelector("#fecha_fin");
        let recinto = document.querySelector("#recinto");
        let recinto_ub = document.querySelector("#recinto_ub");
        
        const tabs = document.querySelectorAll("#nav-tab .nav-link"); // Todas las pestañas
        const btnSiguiente = document.getElementById("btnSiguiente");
        const btnGuardar = document.getElementById("btnGuardar");
        const btnNav = document.getElementById("btnNav");

        const tabsIndexs = Object.entries(tabs).map(([key]) => Number(key)); // Convertimos las claves en números
        const primerIndex = tabsIndexs[0]; // Primer elemento
        const ultimoIndex = tabsIndexs[tabsIndexs.length - 1]; // Último elemento

        const infoEvento = (fecha_init, fecha_final, nm_recinto, estado) => {
            fecha_inicio.value = fecha_init;
            fecha_fin.value = fecha_final;
            recinto.value = nm_recinto;
            recinto_ub.value = estado;
        }

        $(document).ready(() => {
            // Asegúrate de que haya opciones en el select
            selectEvento.append(new Option("Seleccione un rango de fecha", "0"));
            // Inicializa Select2 después de añadir opciones
            selectEvento.select2({
                placeholder: "Selecciona uno o más eventos",
                allowClear: true
            });
        });

        const limpiarSelect = () => {
            $("#select_evento").val("")
            selectEvento.innerHTML = "";
        }

        const formatFecha = (fechaCadena) => {
            const fecha = new Date(fechaCadena);

            const year = fecha.getFullYear();
            const mes = String(fecha.getMonth() + 1).padStart(2, '0');
            const dia = String(fecha.getDate()).padStart(2, '0');
            const fechaFormateada = `${year}-${mes}-${dia}`;

            return fechaFormateada;
        }

        $(function () {
            // Validar fechas y limpiar select
            $("#start_date1").on("change", function () {
                selectEvento.innerHTML = '<option value="" disabled selected>Cargando...</option>';
                selectEvento.value = 1;

                const startDate1 = $("#start_date1").val();
                const startDate2 = $("#start_date2").val();

                if (startDate1 && startDate2 && startDate2 < startDate1) {
                    Swal.fire({
                        icon: "error",
                        title: "Error.",
                        text: "La fecha fin no puede ser menor que la de inicio",
                    });
                    $("#start_date2").val("");
                    limpiarSelect();
                }
            });

            $("#start_date2").on("change", function () {
                limpiarSelect(); // Limpiar el select cuando cambie start_date2

                const startDate1 = $("#start_date1").val();
                const startDate2 = $("#start_date2").val();

                if (startDate1 && startDate2 && startDate2 < startDate1) {
                    Swal.fire({
                        icon: "error",
                        title: "Error.",
                        text: "La fecha fin no puede ser menor que la de inicio",
                    });
                    $("#start_date2").val(""); // Limpiar fecha inválida
                } else if (startDate1 && startDate2) {

                    const fechaInicio = formatFecha(startDate1);
                    const fechaFin = formatFecha(startDate2);

                    fechaInit = fechaInicio;
                    fechaFinal = fechaFin;

                    // Mostrar alerta de carga mientras se obtienen los eventos
                    Swal.fire({
                        title: "Cargando eventos...",
                        html: "Por favor espere",
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    obtenerEventos(fechaInicio, fechaFin, (eventos) => {
                        Swal.close(); // Cierra el Swal de carga cuando la función obtiene respuesta

                        if (eventos.length == 0) {
                            Swal.fire({
                                title: "No se han encontrado eventos",
                                icon: "error",
                                showDenyButton: true,
                                showCancelButton: true,
                                confirmButtonText: "Ok",
                                confirmButtonColor: "#003DA5",
                                denyButtonText: "No"
                            });
                        }
                    });
                }

            });
        });

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
                        option.text = `${evento.descripcion} (${evento.id_evento})`;

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
                const {recinto, paisEstado, inicio_evento, fin_evento} = eventosSeleccionados;

                infoEvento(inicio_evento, fin_evento, recinto, paisEstado);
                
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Sin selección',
                    text: 'Por favor, selecciona al menos un evento.'
                });
            }
        };

        document.getElementById("formEvento").addEventListener("submit", function(event) {
            event.preventDefault();

            var formData = new FormData(this);
            var formObject = {};

            formData.forEach((value, key) => {
                formObject[key] = value;
            });

            let select = document.getElementById("select_evento");
            let selectedText = select.options[select.selectedIndex].text;
            formObject["nombre_evento"] = selectedText;

            fetch("<?= base_url('Eventos/guardar_evento'); ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(formObject)
            })
            .then(response => response.json())
            .then(data => console.log("Respuesta del servidor:", data))
            .catch(error => console.error("Error:", error));

        });
 
	</script>

<?= $this->endSection(); ?>
