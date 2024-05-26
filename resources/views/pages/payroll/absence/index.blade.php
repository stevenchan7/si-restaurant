<x-layouts.admin-layout>
    @section('css')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endsection

    <h5>Absence</h5>

    <div class="row justify-content-end">
        <button id="overtimeCreateBtn" type="button" class="btn btn-primary">
            <i class="fa-regular fa-clock"></i>
            Overtime
        </button>
        <button id="dayoffCreateBtn" type="button" class="btn btn-primary ml-2">
            <i class="fa-regular fa-moon"></i>
            Dayoff
        </button>
    </div>

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <button id="showOvertimeBtn" class="btn btn-link active">Overtime</button>
        </li>
        <li class="nav-item">
            <button id="showDayoffBtn" class="btn btn-link">Dayoff</button>
        </li>
    </ul>

    @section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    @endsection
</x-layouts.admin-layout>