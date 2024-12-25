@extends('layouts.front')
@section('content')

<div class="container my-5 py-5">
    <h3 class="text-center py-3">My Shopping Carts</h3>
    <div class="table-responsive">
        <table class="table table-border">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Item Name</th>
                    <th>Item Image</th>
                    <th>Item Price</th>
                    <th>Item Discount</th>
                    <th>Qty</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <!-- Rows will be dynamically added here -->
            </tbody>
        </table>
    </div>
    <div class="d-grid gap-2">
        @guest
        <a href="/login" class="btn btn-primary">Login</a>
        @else

        <form id="paymentForm" class="row" enctype="multipart/form-data">
            @csrf

            <div class="col-md-6">
                <label for="payment_slip">Payment Slip</label>
                <input type="file" name="payment_slip" id="payment_slip" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="payment_method">Payment Method</label>
                <select name="payment_method" id="payment_method" class="form-select">
                    <option value="">Choose Payment Method</option>
                    @foreach($payments as $payment)
                        <option value="{{$payment->id}}">{{$payment->name}}</option>
                    @endforeach
                </select>
                </div>
                <div class="col-md-12">
                    <label for="note">Note</label>
                    <textarea name="note"   class="form-control"></textarea>
                </div>
                <button class="btn btn-success my-3" id="order-now" type="submit">Order Now</button>
        </form>
        @endif


    </div>
</div>




@endsection

@section('script')

<script>
    $(document).ready(function () {
        // AJAX setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // $('#order-now').click(function () {
        //     let itemString = localStorage.getItem('shops');
        //     $.post("{{route('orderNow')}}", { data: itemString }, function (response) {
        //         console.log(response);
        //     })
        // })

        $('#paymentForm').on('submit', function (e) {
            e.preventDefault(); // Prevent default form submission behavior
            
            var formData = new FormData(this); // Create FormData object
            console.log(formData); // Log the FormData object to the console
            
            // Retrieve order items from localStorage
            let itemString = localStorage.getItem('shops');
             formData.append('orderItems', itemString); // Append order items to form data
            

    // Perform the AJAX request
    $.ajax({
        type: 'POST',
        url: "{!! route('orderNow') !!}", // Laravel route syntax
        data: formData,
        processData: false, // Prevent automatic processing of data
        contentType: false, // Prevent setting of default Content-Type
        success: function (response) {
            console.log(response);
          
            if (response) {
                alert('Order Successful');
                localStorage.clear('shops');

                location.href="/";
            }
        }
    });
});


    });
</script>


@endsection