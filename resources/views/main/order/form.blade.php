@extends('main.layout')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <h2>Order {{$order->id}}</h2>
        <div class="col-md-6">
            <div class="panel-body">
                <form method="POST" action="{{route('orders.update', $order->id)}}" enctype="multipart/form-data">
                    {{method_field('PUT')}}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email">Client email</label>
                        <input class="form-control" required="" minlength="5" name="email" type="text" id="email" value="{{old('email', $order->client_email ?? null)}}">
                    </div>
                    <div class="form-group">
                        <label for="partner">Partner</label>
                        <select class="form-control" name="partner" id="partner">
                            @foreach($partners as $partner)
                                <option @if(isset($order)) @if($order->partner_id == $partner->id) selected @endif @endif value="{{ $partner->id }}">{{ $partner->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <table class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($order->products as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->pivot->quantity}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">empty</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                        <label for="price">Total price</label>
                        <input class="form-control" required="" minlength="2" name="price" type="text" id="price" disabled value="{{old('price', $order->totalPrice() ?? null)}}">
                    </div>
                    <div class="form-group">
                        <label for="status">Order status</label>
                        <select class="form-control" name="status" id="status">
                            @foreach($order->status(1) as $key => $status)
                                <option @if(isset($order)) @if($key == $order->status) selected @endif @endif value="{{$key}}">{{$status}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Сохранить">
                </form>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>

    </main>
@endsection
