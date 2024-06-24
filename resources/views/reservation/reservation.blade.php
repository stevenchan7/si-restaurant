<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D'RESTAURANT</title>
    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Caveat&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Outfit:wght@100..900&display=swap"
        rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="banner-booking">
    {{-- Navbar --}}
    @include('components.layouts.navbar')

    {{-- Reservation Form --}}
    <section id="Hero">
        <div class="container container-booking text-white">
            <div class="text-center">
                <h1 class="heading1">Secure Your Reservation</h1>
                <p class="body-text-small mt-3">Feel free to use this on your website to encourage visitors to input
                    their reservation details. If you need any more assistance, feel free to ask!</p>
            </div>
            <div class="bg-form p-4 rounded mt-5">
                <form action="/store" method="POST">
                    @csrf
                    {{-- input email --}}
                    <div class="row mb-3 p-2">
                        <label class="form-label" for="customer_email">Email</label>
                        <input type="email" class="form-control form-control-booking @error('customer_email') is-invalid @enderror" id="customer_email" name="customer_email" placeholder="Enter your name">
                        @error('customer_email')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- Input date --}}
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label" for="date">Date</label>
                            <input type="date" class="form-control form-control-booking" id="date" name="date">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="Starttime">Start Time</label>
                            <input type="time" class="form-control form-control-booking" id="Starttime" name="start_time">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="Endtime">End Time</label>
                            <input type="time" class="form-control form-control-booking" id="Endtime" name="end_time">
                        </div>
                    </div>
                    {{-- input table reservation --}}
                    <div class="mb-3 p-2">
                        <div class="col">
                            <label class="form-label" for="table">Table</label>
                            <div class="form-control-booking row py-3 d-flex flex-wrap justify-content-between px-5" id="tableList">
                                @foreach ($tables as $table)
                                {{-- {{ $table->reservation }} --}}
                                <div class="table-circle    @if(optional($table->reservation)->reservation_status == 'Booked') 
                                                                        text-white bg-danger @endif"
                                    data-number="{{ $table->table_number }}" 
                                    data-capacity="{{ $table->capacity }}" 
                                    data-status="{{ $table->status }}" 
                                    data-id="{{ $table->id }}">
                                    {{ $table->table_number }}
                                </div>                                
                                {{-- <input type="hidden" name="status" value="Booked">
                                <input type="hidden" name="table_id" value="{{ $table->id }}"> --}}
                                @endforeach
                                <input type="hidden" name="table_number" id="table-number">
                                <input type="hidden" name="capacity" id="capacity">
                                <input type="hidden" name="status" id="status">
                                <input type="hidden" name="table_id" id="table-id">
                                <input type="hidden" name="status" value="Booked">

                            </div>

                        </div>
                    </div>
                    <div class="row p-2">
                        <button type="submit" class="btn-form" id="book-table-button">Book A Table</button>
                    </div>
                </form>
                
            </div>
        </div>
    </section>

    {{-- Modal --}}
    <div class="modal fade" id="tableModal" tabindex="-1" aria-labelledby="tableModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tableModalLabel">Table Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Table Number:</strong> <span id="modalTableNumber"></span></p>
                    <p><strong>Capacity:</strong> <span id="modalCapacity"></span></p>
                    <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">Select</button>
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Contact and Footer --}}
    @include('components.layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

<script src="{{ asset('js/script.js') }}"></script>

</html>