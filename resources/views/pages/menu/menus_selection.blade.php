<!-- resources/views/pages/orders/add_menu.blade.php -->

<x-layouts.admin-layout>
    <div class='col-lg-8 col-md-8 col-sm-12 col-xs-12'>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Order Summary
            </div>
            <div class="card-body w-100">
                <div class="d-flex justify-content-between mb-3">
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#menuModal">
                        Tambah Menu
                    </button>

                    <!-- Cancel Button -->
                    <a href="{{route('order')}}" class="btn btn-danger">Cancel</a>
                </div>

                <!-- Table to Display Selected Menus -->
                <form action="{{route('menu.add', ['id' => $id])}}" method="post">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Kuantitas</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="selectedMenusTable">
                                <!-- JavaScript will dynamically fill this table with selected menus -->
                            </tbody>
                        </table>
                    </div>
                    <!-- Subtotal Section -->
                    <div class="mt-3">
                        <h5>Subtotal: <span id="subtotal">0</span></h5>
                    </div>
                    <input type="hidden" name="selected_menus" id="selectedMenusInput">
                    <div class="d-flex justify-content-between mb-3">
                        <!-- Payment Button -->
                        <button type="submit" class="btn btn-success" onclick="payment();">
                            Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin-layout>

<!-- Include the Modal -->
@include('pages.menu.add_menu')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('menuForm');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const selectedMenus = [];
            const checkboxes = form.querySelectorAll('input[name="selected_menus[]"]:checked');
            let subtotal = 0;

            checkboxes.forEach(checkbox => {
                const row = checkbox.closest('tr');
                const name = row.querySelector('td:nth-child(1)').innerText;
                const price = parseFloat(row.querySelector('td:nth-child(2)').innerText);
                const quantity = parseInt(row.querySelector('input[type="number"]').value);
                if (quantity > 0) {
                    selectedMenus.push({ name, price, quantity });
                    subtotal += price * quantity;
                }
            });

            const tableBody = document.getElementById('selectedMenusTable');
            tableBody.innerHTML = '';

            selectedMenus.forEach(menu => {
                const row = document.createElement('tr');
                row.innerHTML = `<td>${menu.name}</td><td>${menu.price}</td><td>${menu.quantity}</td><td>${menu.price * menu.quantity}</td>`;
                tableBody.appendChild(row);
            });

            document.getElementById('subtotal').innerText = subtotal.toFixed(2);
            document.getElementById('selectedMenusInput').value = JSON.stringify(selectedMenus);
            $('#menuModal').modal('hide');
        });
    });
</script>

<script>
    // Menampilkan konfirmasi saat meninggalkan halaman
    window.onbeforeunload = function() {
        return "Apakah Anda yakin ingin meninggalkan halaman ini? Perubahan yang Anda buat mungkin tidak disimpan.";
    };


    function confirmCancel() {
        if (confirm('Apakah Anda yakin ingin membatalkan?')) {
            window.location.reload();
        }
    }
</script>

<style>
    .custom-checkbox {
        display: inline-block;
        padding: 10px;
    }

    .larger-checkbox {
        width: 20px;
        height: 20px;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .table {
        width: 100%;
    }

    .d-flex {
        display: flex !important;
    }

    .justify-content-between {
        justify-content: space-between !important;
    }
</style>
