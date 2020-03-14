@extends('main.layout')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <h2>Orders</h2>
        @if (session('message'))
            <div class="alert alert-warning">
                {{ session('message') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th>Order</th>
                    <th>Partner</th>
                    <th>Price</th>
                    <th>Composition</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td><a href="{{route('orders.edit', $order->id)}}" onclick="event.preventDefault();window.open(this.href, '_blank')">{{$order->id}}</a></td>
                        <td>{{$order->partner->name}}</td>
                        <td>
                            {{$order->totalPrice()}}
                        </td>
                        <td>
                            @forelse($order->products as $product)
                                {{$product->name}},&nbsp;
                            @empty
                            @endforelse
                        </td>
                        <td>{{$order->status()}}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">empty</td>
                    </tr>
                @endforelse

                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation example">
            {{$orders->links('pagination.main')}}
        </nav>

    </main>
@endsection
