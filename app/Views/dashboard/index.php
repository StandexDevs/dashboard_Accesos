<?= $this->extend('layout/menu') ?>
<?= $this->section('content')?>
<?= $this->section('title')?>
    Dashboard 
<?= $this->endSection()?>
    <div class="d-sm-flex  d-block align-items-center mb-4">
        <div class="me-auto">
            <h4 class="fs-20 text-black">Eventos registrados</h4>
            <span class="fs-12">Lorem ipsum dolor sit amet, consectetur</span>
        </div>

        <button class="btn btn-light btn-rounded">
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
                            <img src="images/avatar/25.png" alt="" class="rounded-circle me-3" width="50">
                            <div>
                                <h6 class="fs-16 text-black font-w600 mb-0 text-nowrap">XYZ Store ID</h6>
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
                <tr>
                    <td><span class="text-black font-w500">#123412451</span></td>
                    <td><span class="text-black text-nowrap">#June 1, 2020, 08:22 AM</span></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="images/avatar/19.png" alt="" class="rounded-circle me-3" width="50">
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
                            <img src="images/avatar/20.png" alt="" class="rounded-circle me-3" width="50">
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
                            <img src="images/avatar/26.png" alt="" class="rounded-circle me-3" width="50">
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

    <script>
		(function($) {
			var table = $('#example5').DataTable({
				searching: true,
				paging:true,
				select: false,
				//info: false,         
				lengthChange:false 
				
			});
			$('#example tbody').on('click', 'tr', function () {
				var data = table.row( this ).data();
				
			});
		})(jQuery);
	</script>

<?= $this->endSection(); ?>
