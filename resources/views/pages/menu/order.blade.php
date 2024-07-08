<x-layouts.admin-layout>
    <div>
        <form action="{{ route('order.create') }}" method="post">
            @csrf
            <div class="container">
                <div style="position: relative;border: 1px solid #ccc; padding: 10px; background-color: #fff;text-align:center">
                    <div class="align-middle">
                        <label>Employee:</label>
                        <select name="employee" id="employee" class="form-select form-select-sm px-3" style="padding-left: 500px">
                            @foreach($employees as $employees)
                                <option value="{{$employees->id}}" placeholder="test">{{$employees->fullname}}</option>
                            @endForeach
                        </select>
                    </div>
                    <div class="align-middle">
                        <label>Customer:</label>
                        <select name="customer" id="customer" class="form-select form-select-sm px-3" style="padding-left: 500px">
                            @foreach($customers as $customers)
                                <option value="{{$customers->id}}" placeholder="test">{{$customers->name}}</option>
                            @endForeach
                        </select>
                    </div>
                    <div class="align-middle">
                        <label>Table Number:</label>
                        <select name="table" id="table" class="form-select form-select-sm px-3 mt-2">
                            @foreach($tables as $table)
                                <option value="{{$table->table_number}}">{{$table->table_number}}</option>
                            @endForeach
                        </select>
                    </div>
                    <div>
                        <td style="border:1px solid gray">
                            <textarea type="text" name="notes" id="notes" rows="3" placeholder="any notes...?" class="form-textbox mt-2" style="height:120px; width: 100%; padding:10px;text-align: center "></textarea>
                        </td>
                    </div>
                </div>
                <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg mt-3 px-5">Order</button>
                </div>
            </div>
        </form>
    </div>
</x-layouts.admin-layout>
