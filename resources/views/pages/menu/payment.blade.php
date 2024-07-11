<!-- resources/views/pages/orders/payment.blade.php -->

<x-layouts.admin-layout>
    <div class="container" style="width: 100%">

        <h5>Payments</h5>
        <div id="menudetail" style="border: 1px solid #ccc; padding: 10px; background-color: #fff; text-align: center">
            @if ($selectedMenus)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Menu Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($selectedMenus as $menu)
                            <tr>
                                <td>{{ $menu['name'] }}</td>
                                <td>{{ $menu['price'] }}</td>
                                <td>{{ $menu['quantity'] }}</td>
                                <td>{{ $menu['price'] * $menu['quantity'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div class="row mt-3">
            <div>
            <div class="col-md-6 order-md-last">
                @foreach ($payments as $payment)
                    <div class="form-group row">
                        <label for="paymentId" class="col-sm-4 col-form-label">Payment ID:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="paymentId" name="paymentId" value="{{ $payment->order_id }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="total" class="col-sm-4 col-form-label">Total Amount:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="total" name="total" value="{{ $payment->total }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="payment" class="col-sm-4 col-form-label">Input Payment:</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="payment" id="payment" placeholder="Input payment here..." style="height: 40px;" oninput="hitungKembalian()"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="change" class="col-sm-4 col-form-label">Change:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="change" name="change" readonly>
                        </div>
                    </div>
                @endforeach
            </div>
            <div>
                <form action="{{ route('payment_action', ['id' => $id]) }}" method="post">
                    @csrf
                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg">
                            Pay
                        </button>
                    </div>
                </form>
            </div>
            <div class="text-center mt-3">
                <button onclick="PrintButton()" class="btn btn-primary btn-lg">
                    Print Menu Details
                </button>
            </div>
            </div>
        </div>
    </div>
</x-layouts.admin-layout>

<!-- resources/views/pages/orders/payment.blade.php -->
<script>
    const subtotal = {{ $payment->total }};

    function hitungKembalian() {
        let payment = document.getElementById('payment').value.replace(/\D/g,"");
        payment = parseInt(payment);
        const change = payment - subtotal;

        document.getElementById('change').value = formatRupiah(change);
    }

    function formatRupiah(angka) {
        const formatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(angka);
        return formatted;
    }

    function PrintButton(){
        var printWindow = window.open('','',height=600,width=800);
        printWindow.document.write('<html><head><title>Receipt</title></head><body>');
        printWindow.document.write('<h2>Receipt #'+ document.getElementById('paymentId').value+'</h2>');

        // Write selected menus table
        printWindow.document.write('<div>');
        printWindow.document.write('<h3>Menu Details</h3>');
        printWindow.document.write(document.getElementById('menudetail').innerHTML);
        printWindow.document.write('</div>');

        // Write payment details
        printWindow.document.write('<div>');
        printWindow.document.write('<p>total: '+ formatRupiah(document.getElementById('total').value) +' </p>');
        printWindow.document.write('<p>paid: '+ formatRupiah(document.getElementById('payment').value) +' </p>');
        printWindow.document.write('<p>change: '+ document.getElementById('change').value +' </p>');
        printWindow.document.write('</div>');

        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>
