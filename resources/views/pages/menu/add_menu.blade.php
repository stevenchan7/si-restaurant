add_menu.blade.php
<!-- Pop-up Modal for Adding Menus -->
<div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="menuModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="menuModalLabel">Add Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="mb-3">
                        <input type="text" id="search" class="form-control" placeholder="Cari menu...">
                    </div>
                </div>
                <form id="menuForm" method="POST">
                    @csrf
                    <div class="table-responsive">
                        <table id="menuTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Kuantitas</th>
                                    <th>Pilih</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($menus as $menu)
                                    <tr>
                                        <td>{{ $menu->name }}</td>
                                        <td>{{ $menu->price }}</td>
                                        <td>
                                            <input type="number" name="quantities[{{ $menu->id }}]" class="form-control" value="0" min="0">
                                        </td>
                                        <td class="text-center">
                                            <div class="custom-checkbox">
                                                <input type="checkbox" name="selected_menus[]" value="{{ $menu->id }}" class="larger-checkbox">
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <button type="submit" form="menuForm" class="btn btn-success" id="btnSubmitOrder">Buat Order</button>
                </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('#search').on('keyup', function(){
        var query = $(this).val().toLowerCase();
        $('#menuTable tbody tr').each(function(){
            var name = $(this).find('td:first').text().toLowerCase();
            if(name.includes(query) || query === ''){
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    $('#menuForm').on('submit', function(){
        $('#menuModal').modal('hide');
    });
});
</script>
