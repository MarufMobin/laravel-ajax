<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>


    {{-- Bootstrap and jquery linking are here --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>



    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</head>

<body>
    <div class="pt-5"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2 align-self-center">
                <div class="card">
                    <div class="card-header">
                        <p class="fs-3">
                            Crud System Using Ajax
                            <button class="btn btn-primary float-end align-middle" data-bs-toggle="modal" data-bs-target="#addModal"> Add New</button>
                        </p>
                    </div>
                    <span class="alert alert-success" id="alert-success" style="display: none;"></span>
                    <span class="alert alert-danger" id="alert-danger" style="display: none;"></span>

                    <div class="card-body">
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                                <th scope="col">#SL</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Manufacture year</th>
                                <th scope="col">Engine Type</th>
                                <th scope="col">Fuel Type</th>
                                <th scope="col" colspan="2" class="text-center">Action</th>
                            </thead>
                            @if( count($all_cars) > 0 )
                            @foreach ( $all_cars as $item )
                            <tr>
                                <td scope="col"> {{ $loop->iteration }} </td>
                                <td> {{ $item->name }} </td>
                                <td> {{ $item->manufacture_year }} </td>
                                <td> {{ $item->engine_capacity }} </td>
                                <td> {{ $item->fuel_type }} </td>
                                <td>
                                    <button class="btn btn-primary btn-sm editBtn" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-year="{{ $item->manufacture_year }}" data-capacity="{{ $item->engine_capacity }}" data-fuel="{{ $item->fuel_type }}" data-bs-toggle="modal" data-bs-target="#editModal">edit</button>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm deleteBtn" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5">No Data Found !</td>
                            </tr>
                            @endif

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Car Modal are here --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Added A New Car</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                {{-- Card Added Car Form are here  --}}

                <form id="addCarForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Car Name</label>
                            <input type="text" name="name" id="" class="form-control">
                            <span id="name_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="manufacture_year">Manufacture Year</label>
                            <input type="number" name="manufacture_year" id="" class="form-control">
                            <span id="manufacture_year_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="engine_capacity">Engine Capacity</label>
                            <input type="text" name="engine_capacity" id="" class="form-control">
                            <span id="engine_capacity_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="fuel_type">Fuel Type</label>
                            <input type="text" name="fuel_type" id="" class="form-control">
                            <span id="fuel_type_error" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary addBtn">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Car Modal are here --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit A New Car</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                {{-- Card Edit Car Form are here  --}}

                <form id="editCarForm">
                    @csrf
                    <input type="hidden" id="car_id" name="car_id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Car Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                            <span id="name_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="manufacture_year">Manufacture Year</label>
                            <input type="number" name="manufacture_year" id="manufacture_year" class="form-control">
                            <span id="manufacture_year_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="engine_capacity">Engine Capacity</label>
                            <input type="text" name="engine_capacity" id="engine_capacity" class="form-control">
                            <span id="engine_capacity_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="fuel_type">Fuel Type</label>
                            <input type="text" name="fuel_type" id="fuel_type" class="form-control">
                            <span id="fuel_type_error" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary editButton">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Delete Car Modal are here --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete a spacific Car</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                {{-- Delete Form are here  --}}
                <div class="modal-body">
                    <h4>Do You Realy want to<span class="badge badge-danger car_name text-danger"></span> </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary deleteButton">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Added Functionalitye are here 
        $('#addCarForm').submit(function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                url: '{{ route("addCar")}}',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.addBtn').prop('disabled', true);
                },
                complete: function() {
                    $('.addBtn').prop('disabled', false);
                },
                success: function(data) {
                    if (data.success == true) {
                        // this is the correct way to close modal
                        $('#addModal').modal('hide').on('hidden.bs.modal', function(e) {
                            $(this).remove(); // Remove the modal from the DOM
                            $('.modal-backdrop').remove(); // Remove the backdrop from the DOM
                            $('body').removeClass('modal-open'); // Remove the modal-open class from the body
                            $('body').css('padding-right', ''); // Reset padding-right
                        });

                        printSuccessMsg(data.msg);
                        var reloadInterval = 5000; //page reload delay duration
                        // Function to reload the whole page
                        function reloadPage() {
                            location.reload(true); // Pass true to force a reload from the server and not from the browser cache
                        }
                        // Set an interval to reload the page after the specified time
                        var intervalId = setInterval(reloadPage, reloadInterval);

                    } else if (data.success == false) {
                        printErrorMsg(data.msg);
                    } else {
                        printValidationErrorMsg(data.msg);
                    }
                }
            });
            return false;
        });

        // Delete Functionality are perform here 
        $('.deleteBtn').on('click', function() {
            var car_id = $(this).attr('data-id');
            var car_name = $(this).attr('data-name');

            $('.car_name').html(car_name);

            $('.deleteButton').on('click', function() {
                var url = "{{ route('deleteCar', 'car_id') }}";
                url = url.replace('car_id', car_id);
                // console.log(url)

                $.ajax({
                    url: url,
                    type: 'GET',
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('.deleteButton').prop('disabled', true);
                    },
                    complete: function() {
                        $('.deleteButton').prop('disabled', false);
                    },
                    success: function(data) {
                        if (data.success == true) {
                            // this is the correct way to close modal
                            $('#deleteModal').modal('hide').on('hidden.bs.modal', function(e) {
                                $(this).remove(); // Remove the modal from the DOM
                                $('.modal-backdrop').remove(); // Remove the backdrop from the DOM
                                $('body').removeClass('modal-open'); // Remove the modal-open class from the body
                                $('body').css('padding-right', ''); // Reset padding-right
                            });

                            printSuccessMsg(data.msg);
                            var reloadInterval = 2000; //page reload delay duration
                            // Function to reload the whole page
                            function reloadPage() {
                                location.reload(true); // Pass true to force a reload from the server and not from the browser cache
                            }
                            // Set an interval to reload the page after the specified time
                            var intervalId = setInterval(reloadPage, reloadInterval);

                        } else {
                            printErrorMsg(data.msg);
                        }
                    }
                });

            });
        });

        // Edit / Update Functionality are perform here
        $('.editBtn').on('click', function() {
            let car_id = $(this).attr('data-id');
            let car_name = $(this).attr('data-name');
            let year = $(this).attr('data-year');
            let capacity = $(this).attr('data-capacity');
            let fuel = $(this).attr('data-fuel');

            $('#name').val(car_name);
            $('#manufacture_year').val(year);
            $('#engine_capacity').val(capacity);
            $('#fuel_type').val(fuel);
            $('#car_id').val(car_id);
        });

        $('#editCarForm').submit(function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                url: '{{ route("editCar")}}',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.editButton').prop('disabled', true);
                },
                complete: function() {
                    $('.editButton').prop('disabled', false);
                },
                success: function(data) {
                    if (data.success == true) {
                        // this is the correct way to close modal
                        $('#editModal').modal('hide').on('hidden.bs.modal', function(e) {
                            $(this).remove(); // Remove the modal from the DOM
                            $('.modal-backdrop').remove(); // Remove the backdrop from the DOM
                            $('body').removeClass('modal-open'); // Remove the modal-open class from the body
                            $('body').css('padding-right', ''); // Reset padding-right
                        });

                        printSuccessMsg(data.msg);
                        var reloadInterval = 5000; //page reload delay duration
                        // Function to reload the whole page
                        function reloadPage() {
                            location.reload(true); // Pass true to force a reload from the server and not from the browser cache
                        }
                        // Set an interval to reload the page after the specified time
                        var intervalId = setInterval(reloadPage, reloadInterval);

                    } else if (data.success == false) {
                        printErrorMsg(data.msg);
                    } else {
                        printValidationErrorMsg(data.msg);
                    }
                }
            });
        });



        // the three functions for flash messages
        function printValidationErrorMsg(msg) {
            $.each(msg, function(field_name, error) {
                // console.log(field_name,error);
                // this will find a input id for error lets create this
                $(document).find('#' + field_name + '_error').text(error);
            });
        }

        function printErrorMsg(msg) {
            $('#alert-danger').html('');
            $('#alert-danger').css('display', 'block');
            $('#alert-danger').append('' + msg + '');
        }

        function printSuccessMsg(msg) {
            $('#alert-success').html('');
            $('#alert-success').css('display', 'block');
            $('#alert-success').append('' + msg + '');
            // if form successfully submitted reset form
            document.getElementById('addCarForm').reset();
        }
    </script>
</body>

</html>