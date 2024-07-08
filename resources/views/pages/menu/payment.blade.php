<x-layouts.admin-layout>
    <div>
        <div class="container" style="width: 100%">
            <div style="position: relative;border: 1px solid #ccc; padding: 10px; background-color: #fff;text-align:center">
                @foreach ($payments as $payments)
                    <div class="align-middle">
                        <label for="paymentId">Payment ID: {{ $payments->order_id }}</label>
                    </div>
                    <div class="align-middle">
                        <label for="total">Total Amount: {{ $payments->total }}</label>
                    </div>
                    <div style="width: 100% ">
                        <textarea class="form-textbox mt-2" name="payment" id="payment" placeholder="Input payment here..."style="height:120px; width: 100%; padding:10px;text-align: center "></textarea>
                    </div>
                @endforeach
            </div>
        </div>
        <form action="{{route('payment_action', ['id' => $id])}}" method="post">
            @csrf
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-success btn-lg";>
                    Pay
                </button>
            </div>
        </form>
    </div>
</x-layouts.admin-layout>
