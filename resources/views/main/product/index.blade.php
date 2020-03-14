@extends('main.layout')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <h2>Products</h2>
        @if (session('message'))
            <div class="alert alert-warning">
                {{ session('message') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Vendor</th>
                    <th>Price</th>
                    <th>New price</th>
                </tr>
                </thead>
                <tbody>
                @forelse($products as $product)
                    <tr>
                        <td class="product">{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>
                            {{$product->vendor->name}}
                        </td>
                        <td class="price">
                            <span>{{$product->price}}</span>
                        </td>
                        <td class="set-price">
                            <form action="{{route('products.update', $product->id)}}" method="POST">
                                {{method_field('PUT')}}
                                {{ csrf_field() }}
                                <input type="text" class="form-control-sm price-val" name="price" value="{{old('price')}}">
                                <button class="btn btn-sm btn-outline-primary save-price" type="button">Save</button>
                            </form>
                        </td>
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
            {{$products->links('pagination.main')}}
        </nav>

    </main>
@endsection

@push('scripts')
<script>
    $(function (){
        $('.save-price').on('click', function (e) {
            let price = $(this).siblings('.price-val').val();
            let oldPrice = $(this).closest('.set-price').siblings('.price').find('span');
            let product = $(this).closest('.set-price').siblings('.product').html();
            price = (price < 0 || typeof price === 'undefined' || price === null || price ===  '') ? 0 : price;
            $.ajax({
                method: 'GET',
                url: '{{route('api.product.update')}}',
                data: {
                    price: price,
                    id: product
                },
            })
                .done(function(json) {
                    console.log(json);
                    oldPrice.html(json.price);
                })
                .fail(function() {
                    alert( "error input" );
                })
        })
    });
</script>
@endpush
