@extends('emails.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p>Your Order №{{$order->id}} is completed</p>

            <table class="table table-sm">
                <thead>
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                </tr>
                </thead>
                <tbody>
                @forelse($order->products as $product)
                    <tr>
                        <th scope="row">{{$product->name}}</th>
                        <td>{{$product->pivot->quantity}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->pivot->quantity * $product->price}}</td>
                    </tr>
                @empty
                @endforelse
                <tr>
                    <td colspan="4">
                        Total sum: {{$order->totalPrice() ?? 0}}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
