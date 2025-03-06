<body>
    <div class="d-sm-flex d-block align-items-center mb-4">
        <div class="me-auto">
            <h4 class="fs-20 text-black">Torniquetes Registrados</h4>
        </div>
        <button class="btn btn-light btn-rounded" onclick="fn()">
            <i class="las la-calendar-alt scale5 me-3"></i>
            Agregar toniquete
        </button>
    </div>
    
    <div class="table-responsive table-hover fs-14">
        <table class="table display mb-4 dataTablesCard " id="example5">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Num Serie</th>
                    <th>Nombre</th>
                    <th>Tipo de registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="text-black font-w500">1</span></td>
                    <td><span class="text-black text-nowrap">123412451</span></td>
                    <td><span class="text-black">ExpoEntrada1</span></td>
                    <td><span class="text-black">Entrada</span></td>
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
                    <td><span class="text-black font-w500">1</span></td>
                    <td><span class="text-black text-nowrap">123412452</span></td>
                    <td><span class="text-black">ExpoSalida1</span></td>
                    <td><span class="text-black">Salida</span></td>
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
                    <td><span class="text-black font-w500">3</span></td>
                    <td><span class="text-black text-nowrap">123412453</span></td>
                    <td><span class="text-black">ExpoEntrada2</span></td>
                    <td><span class="text-black">Entrada</span></td>
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
                    <td><span class="text-black font-w500">4</span></td>
                    <td><span class="text-black text-nowrap">123412454</span></td>
                    <td><span class="text-black">ExpoSalida2</span></td>
                    <td><span class="text-black">Salida</span></td>
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
        </table>
    </div>

</body>
<script>



</script>
