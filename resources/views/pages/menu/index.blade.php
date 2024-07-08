<x-layouts.admin-layout>
    <div>
        <h5>Menu</h5>
        <div>
            <table class="table table-sm" style="">
                <thead class="bg-primary">
                    <tr style="color:white">
                        <th style="border:3px solid black;width: 50px; text-align:center">Id</th>
                        <th style="border:3px solid black;width: 200px;padding-left: 10px">Menu</th>
                        <th style="border:3px solid black;width: 200px;padding-left: 10px">Harga</th>
                        <th style="border:3px solid black;padding-left: 10px">Jumlah</th>
                        <th style="border:3px solid black;width: 150px; text-align:center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="height: 40px">
                        <td style="border:1px solid gray";>1</td>
                        <td style="border:1px solid gray">Telur</td>
                        <td style="border:1px solid gray">5000</td>
                        <td style="border:1px solid gray">
                            <input type="text" name="jumlah" placeholder="0" class="form-control" style="height: 30px" oninput="hitungSubtotalMenu()"/>
                        </td>
                        <td style="border:1px solid gray;text-align:center">
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary btn-md">Finish Order</button>
        </div>
    </div>
    <div class="container">
        <div style="position: fixed; bottom: 50px; right: 20px; border: 1px solid #ccc; padding: 20px; background-color: #fff;">
            @php
                $menuItems = [
                    ['name' => 'Menu Item 1', 'price' => 50000],
                    ['name' => 'Menu Item 2', 'price' => 30000],
                    // Tambahkan menu lain di sini
                ];
                $subtotal = array_sum(array_column($menuItems, 'price'));
                $uangDiterima = 100000; // Uang yang diterima, ini bisa dinamis sesuai input user
                $kembalian = $uangDiterima - $subtotal;
                $format_uangDiterima = number_format($uangDiterima, 0, ',', '.');
                $format_kembalian = number_format($kembalian, 0, ',', '.');
            @endphp

            <!-- Form untuk menampilkan subtotal -->
            <form style="margin-top: 10px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <label for="subtotal" style="width: 50%;">Subtotal</label>
                    <input type="text" id="subtotal" name="subtotal" value="{{ number_format($subtotal, 0, ',', '.') }}" readonly style="background-color: #f0f0f0; width: 45%;">
                </div>
            </form>


            <!-- Form untuk menampilkan uang diterima -->
            <form style="margin-top: 10px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <label for="uangDiterima" style="width: 50%;">Uang Diterima</label>
                    <input type="text" id="uangDiterima" name="uangDiterima" value="{{ $format_uangDiterima }}" oninput="hitungKembalian()" style="width: 45%;">
                </div>
            </form>

            <!-- Form untuk menampilkan kembalian -->
            <form style="margin-top: 10px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <label for="kembalian" style="width: 50%;">Kembalian</label>
                    <input type="text" id="kembalian" name="kembalian" value="{{ $format_kembalian }}" readonly style="background-color: #f0f0f0; width: 45%;">
                </div>
            </form>

            <button type="button" class="btn btn-primary" onclick="simpanTransaksi()" style="margin-top: 10px;">Simpan Transaksi</button>
        </div>
    </div>

    <script>
        const subtotal = {{ $subtotal }};

        function hitungKembalian() {
            let uangDiterima = document.getElementById('uangDiterima').value.replace(/\D/g,"");
            uangDiterima = parseInt(uangDiterima);
            const kembalian = uangDiterima - subtotal;
            document.getElementById('kembalian').value = formatRupiah(kembalian);
        }

        function formatRupiah(angka) {
            const formatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(angka);
            return formatted;
        }

        function simpanTransaksi() {
            alert('Transaksi berhasil disimpan!');
        }
    </script>

</x-layouts.admin-layout>
