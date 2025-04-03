
<?= $this->extend('layout/menu') ?>
<?= $this->section('content')?>
<?= $this->section('title')?>
    <?php 
        echo $evento->nombre_evento;
    ?>
<?= $this->endSection()?>

<style>
    #ingresos_por_dia, #ingresos_por_hora {
        max-width: 95vw;
        height: 25vh; /* Ajusta según necesidad */
        margin: auto; /* Centrar */
    }
</style>

<div class="row">
    <div class="col-xl-3 col-md-4 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center invoice-card" onclick="consultarRegistro('General')">
                    <div class="media-body">
                        <h2 class="fs-38 text-black font-w600">
                            <?php echo (int)$evento->registros_entradas + (int)$evento->registros_salidas?>
                        </h2>
                        <span class="fs-18">Total registros</span>
                    </div>
                    <span class="p-3 border ms-3 rounded-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"/>
                        </svg>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-4 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center invoice-card" onclick="consultarRegistro('Entrada')">
                    <div class="media-body">
                        <h2 class="fs-38 text-black font-w600">
                            <?php echo $evento->registros_entradas ?>
                        </h2>
                        <span class="fs-18">Entradas</span>
                    </div>
                    <span class="p-3 border ms-3 rounded-circle">
                        <svg width="63" height="63" viewBox="0 0 63 63" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="1.00002" y="1" width="61" height="61" rx="29" stroke="#2BC155" stroke-width="2"/>
                            <g clip-path="url(#clip0)">
                            <path d="M35.2219 42.9875C34.8938 42.3094 35.1836 41.4891 35.8617 41.1609C37.7484 40.2531 39.3453 38.8422 40.4828 37.0758C41.6477 35.2656 42.2656 33.1656 42.2656 31C42.2656 24.7875 37.2125 19.7344 31 19.7344C24.7875 19.7344 19.7344 24.7875 19.7344 31C19.7344 33.1656 20.3523 35.2656 21.5117 37.0813C22.6437 38.8477 24.2461 40.2586 26.1328 41.1664C26.8109 41.4945 27.1008 42.3094 26.7727 42.993C26.4445 43.6711 25.6297 43.9609 24.9461 43.6328C22.6 42.5063 20.6148 40.7563 19.2094 38.5578C17.7656 36.3047 17 33.6906 17 31C17 27.2594 18.4547 23.743 21.1016 21.1016C23.743 18.4547 27.2594 17 31 17C34.7406 17 38.257 18.4547 40.8984 21.1016C43.5453 23.7484 45 27.2594 45 31C45 33.6906 44.2344 36.3047 42.7852 38.5578C41.3742 40.7508 39.3891 42.5063 37.0484 43.6328C36.3648 43.9555 35.55 43.6711 35.2219 42.9875Z" fill="#2BC155"/>
                            <path d="M36.3211 31.7274C36.5891 31.9953 36.7203 32.3453 36.7203 32.6953C36.7203 33.0453 36.5891 33.3953 36.3211 33.6633L32.8812 37.1031C32.3781 37.6063 31.7109 37.8797 31.0055 37.8797C30.3 37.8797 29.6273 37.6008 29.1297 37.1031L25.6898 33.6633C25.1539 33.1274 25.1539 32.2633 25.6898 31.7274C26.2258 31.1914 27.0898 31.1914 27.6258 31.7274L29.6437 33.7453L29.6437 25.9742C29.6437 25.2196 30.2562 24.6071 31.0109 24.6071C31.7656 24.6071 32.3781 25.2196 32.3781 25.9742L32.3781 33.7508L34.3961 31.7328C34.9211 31.1969 35.7852 31.1969 36.3211 31.7274Z" fill="#2BC155"/>
                            </g>
                            <defs>
                            <clipPath id="clip0">
                            <rect width="28" height="28" fill="white" transform="matrix(-4.37114e-08 1 1 4.37114e-08 17 17)"/>
                            </clipPath>
                            </defs>
                        </svg>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-4 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center invoice-card" onclick="consultarRegistro('Salida')">
                    <div class="media-body">
                        <h2 class="fs-38 text-black font-w600">
                            <?php echo $evento->registros_salidas ?>
                        </h2>
                        <span class="fs-18">Salidas</span>
                    </div>
                    <span class="p-3 border ms-3 rounded-circle">
                        <svg width="63" height="63" viewBox="0 0 63 63" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="1" y="1" width="61" height="61" rx="29" stroke="#FF2E2E" stroke-width="2"/>
                            <g clip-path="url(#clip1)">
                            <path d="M35.2219 19.0125C34.8937 19.6906 35.1836 20.5109 35.8617 20.8391C37.7484 21.7469 39.3453 23.1578 40.4828 24.9242C41.6476 26.7344 42.2656 28.8344 42.2656 31C42.2656 37.2125 37.2125 42.2656 31 42.2656C24.7875 42.2656 19.7344 37.2125 19.7344 31C19.7344 28.8344 20.3523 26.7344 21.5117 24.9187C22.6437 23.1523 24.2461 21.7414 26.1328 20.8336C26.8109 20.5055 27.1008 19.6906 26.7726 19.007C26.4445 18.3289 25.6297 18.0391 24.9461 18.3672C22.6 19.4937 20.6148 21.2437 19.2094 23.4422C17.7656 25.6953 17 28.3094 17 31C17 34.7406 18.4547 38.257 21.1015 40.8984C23.743 43.5453 27.2594 45 31 45C34.7406 45 38.257 43.5453 40.8984 40.8984C43.5453 38.2516 45 34.7406 45 31C45 28.3094 44.2344 25.6953 42.7851 23.4422C41.3742 21.2492 39.389 19.4937 37.0484 18.3672C36.3648 18.0445 35.55 18.3289 35.2219 19.0125Z" fill="#FF2E2E"/>
                            <path d="M36.3211 30.2726C36.589 30.0047 36.7203 29.6547 36.7203 29.3047C36.7203 28.9547 36.589 28.6047 36.3211 28.3367L32.8812 24.8969C32.3781 24.3937 31.7109 24.1203 31.0055 24.1203C30.3 24.1203 29.6273 24.3992 29.1297 24.8969L25.6898 28.3367C25.1539 28.8726 25.1539 29.7367 25.6898 30.2726C26.2258 30.8086 27.0898 30.8086 27.6258 30.2726L29.6437 28.2547L29.6437 36.0258C29.6437 36.7804 30.2562 37.3929 31.0109 37.3929C31.7656 37.3929 32.3781 36.7804 32.3781 36.0258L32.3781 28.2492L34.3961 30.2672C34.9211 30.8031 35.7851 30.8031 36.3211 30.2726Z" fill="#FF2E2E"/>
                            </g>
                            <defs>
                            <clipPath id="clip1">
                            <rect width="28" height="28" fill="white" transform="translate(17 45) rotate(-90)"/>
                            </clipPath>
                            </defs>
                        </svg>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-4 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center invoice-card" onclick="consultarRegistro('General')">
                    <div class="media-body">
                        <h2 class="fs-38 text-black font-w600">
                            <?php echo (int)$evento->registros_entradas + (int)$evento->registros_salidas?>
                        </h2>
                        <span class="fs-18">Torniquetes registrados</span>
                    </div>
                    <span class="p-3 border ms-3 rounded-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="currentColor" viewBox="0 0 576 512">
                            <path d="M320 32c0-9.9-4.5-19.2-12.3-25.2S289.8-1.4 280.2 1l-179.9 45C79 51.3 64 70.5 64 92.5L64 448l-32 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l64 0 192 0 32 0 0-32 0-448zM256 256c0 17.7-10.7 32-24 32s-24-14.3-24-32s10.7-32 24-32s24 14.3 24 32zm96-128l96 0 0 352c0 17.7 14.3 32 32 32l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-32 0 0-320c0-35.3-28.7-64-64-64l-96 0 0 64z"/>
                        </svg>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-block d-sm-flex border-0">
        <div class="me-3">
            <h4 class="fs-20 text-black">Flujo de accesos</h4>
        </div>
        <div class="card-action card-tabs mt-3 mt-sm-0">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#monthly" role="tab">General</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#Weekly" role="tab">Detallado</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body tab-content p-0">
        <div class="tab-pane active show fade" id="monthly" role="tabpanel">
            <div class="card">
                <div class="card-body">
                    <canvas id="ingresos_por_dia"></canvas>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="Weekly" role="tabpanel">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-8">
                        </div>
                        <div class="col-sm-4">
                            <label for="select_dia">Seleccione el día del evento</label>
                            <select id="select_dia" name="select_dia" placeholder="Seleccionar día"
                                onchange="obtener_registros_por_hora(event.target.value)"
                                class="js-example-basic-multiple js-states form-control"
                            >
                            </select>
                        </div>
                    </div>
                    <canvas id="ingresos_por_hora"></canvas>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> <!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    let registros = {};//aqui se guardan los registros de horas
    let graficas = {};//aqui se guardan las graficas
    const id_evento = Number(<?php echo $evento->id_evento ?>);
    const base_url = "<?= base_url('Eventos/historial'); ?>";
    const select_dia = document.querySelector("#select_dia");
    const dias_evento = <?php echo json_encode($rango_dias); ?>;

    const formatearLabel = (label) => {
        const labelFormateado = label.includes("/") ? label.replace(/\//g, "") : label;
        return labelFormateado;
    }
    // Crear gráfica
    const renderizarGraficaBarras = (idCanvas, datos, tipoEjeX = 'dia') => {

        //
        if (graficas[idCanvas]) {
            graficas[idCanvas].destroy();
        }

        // Extraer los valores para la gráfica
        const etiquetas = datos.map(item => item[tipoEjeX]); // Puede ser 'dia' o 'hora'
        const entradas = datos.map(item => item.entradas);
        const salidas = datos.map(item => item.salidas);

        const ctx = document.getElementById(idCanvas).getContext('2d');
        
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: etiquetas,
                datasets: [
                    {
                        label: 'Entradas',
                        data: entradas,
                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                        borderWidth: 1
                    },
                    {
                        label: 'Salidas',
                        data: salidas,
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                onClick: (event) => {
                    const points = chart.getElementsAtEventForMode(event, 'nearest', { intersect: true }, true);

                    if (points.length) {
                        const index = points[0]._index;
                        const datasetIndex = points[0]._datasetIndex;
                        const label = formatearLabel(chart.data.labels[index]); // obtencion y formateo del label
                        const tipo = datasetIndex === 0 ? 'Entrada' : 'Salida';

                        window.location.replace(`${base_url}/${id_evento}/${label}/${tipo}`);
                        
                    } else {
                        const groupPoints = chart.getElementsAtEventForMode(event, 'index', { intersect: false }, true);
                        if (groupPoints.length) {

                            const index = groupPoints[0]._index;
                            const datasetIndex = groupPoints[0]._datasetIndex;
                            const label = formatearLabel(chart.data.labels[index]); // obtencion y formateo del label

                            window.location.replace(`${base_url}/${id_evento}/${label}/General`);
                        }
                    }
                }
            }
        });
        graficas[idCanvas] = chart;
        return chart;
    }

    const obtener_registros_general = (id) => {
        apiRequest("<?= base_url('Eventos/obtener_registros_general'); ?>"+"/"+id, "GET", null)
        .then(datos => {
            console.log(datos)
            renderizarGraficaBarras('ingresos_por_dia', datos, 'dia');
        })
        .catch(error => console.error("Error:", error));
    }

    const obtener_registros_por_hora = (fecha = null) => {
        const dataPorHora = {};

        if(fecha != null){
            apiRequest(`${"<?= base_url('Eventos/obtener_registros_por_dia'); ?>"}/${id_evento}/${fecha}`, "GET", null)
            .then(datos => {
                registros = datos;
            })
            .catch(error => console.error("Error:", error));
        }else{
            registros = <?php echo json_encode($registros); ?>;
        }

        registros.forEach(reg => {
            const horaCompleta = reg.hour;
            const hora = new Date(`1970-01-01 ${horaCompleta}`).getHours();

            if (hora >= 8 && hora <= 20) {
                if (!dataPorHora[hora]) {
                    dataPorHora[hora] = { entradas: 0, salidas: 0 };
                }

                if (reg.type === "Entrada") {
                    dataPorHora[hora].entradas++;
                } else if (reg.type === "Salida") {
                    dataPorHora[hora].salidas++;
                }
            }
        });

        // Generar las horas de 8:00 AM a 8:00 PM
        const horas = Array.from({ length: 13 }, (_, i) => `${i + 8}:00`);
        const entradas = horas.map(h => dataPorHora[parseInt(h)]?.entradas || 0);
        const salidas = horas.map(h => dataPorHora[parseInt(h)]?.salidas || 0);

        const datosHoras = horas.map((hora, index) => ({
            hora: hora,
            entradas : entradas[index],
            salidas: salidas[index]
        }));

        renderizarGraficaBarras('ingresos_por_hora', datosHoras, 'hora');
    }

    const consultarRegistro = (tipo) => {
        location.href= `${base_url}/${id_evento}/todos/${tipo}/`;
    }

    $("#select_dia").select2({
        placeholder: "Selecciona uno o más eventos",
        allowClear: true
    });

    const obtener_dias_eventos = () => {
        for (const dia of dias_evento) {
            const option = document.createElement('option');
            option.value = formatearLabel(dia);
            option.text = dia;
            select_dia.appendChild(option);
        }
    }

    $(document).ready(() => {
        obtener_dias_eventos();
        obtener_registros_general(id_evento);
        obtener_registros_por_hora();
    });

</script>
<?= $this->endSection(); ?>