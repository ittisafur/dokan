@extends('layouts.app')

@section('page-title' , 'All Products')

@section('header')

    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
    <style>
        .barcode-sticker{
            background: #FFF;
            padding: 8px;
            padding-bottom: 0;
        }
        .barcode-sticker img{
            max-width: 100%;
            width: 185px;
            height: 46px;
        }
        span.product-id {
            text-align: center;
            display: inherit;
            font-weight: bold;
            color: #000;
            font-size: 12px;
            letter-spacing: 8px;
        }
    </style>

@stop
@section('footer')
    <script src="{{ asset('assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "order": ['0' , 'desc']
            });
        } );
    </script>
@stop

@section('page-content')
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-uppercase pb-2">All Products</h1>
                <a class="btn btn-primary" href="{{ route('products.create') }}">Add New</a>
                <table id="datatable" class="table table-hover">
                    <thead>
                        <tr>
                            <th width="6%">ID#</th>
                            <th width="20%">Product Name</th>
                            <th width="20%">Barcode</th>
                            <th>Buy Price</th>
                            <th>Sell Price</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                <div class="barcode-sticker">
                                <img 
                                    src="data:image/png;base64,{{ DNS1D::getBarcodePNG(str_pad($product->id, 8, '0', STR_PAD_LEFT), "C128B") }}"
                                    alt="product-id-{{ str_pad($product->id, 8, '0', STR_PAD_LEFT) }}"
                                    title="product-id-{{ str_pad($product->id, 8, '0', STR_PAD_LEFT) }}"
                                    >
                                    <span class="product-id">{{ str_pad($product->id, 8, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </td>
                            <td>{{ $product->buy_price }}</td>
                            <td>{{ $product->sell_price }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <a href="{{ route('products.edit' , $product->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                <form action="{{ route('products.destroy' , $product->id) }}" method="POST" style="display: inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop