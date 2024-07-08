pay
<div>
    <form action="{{route('payment_action', ['id' => $id])}}" method="post">
        @csrf
        <div class="d-flex justify-content-between mb-3">
            <button type="submit" class="btn btn-success";>
                Pay
            </button>
        </div>
    </form>
</div>
