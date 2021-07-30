@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card-info">
            <h1>Ordine del cliente: <span>{{$order->customer_name}} {{$order->customer_lastname}}</span></h1>
            <h3>Recapito Telefonico: {{$order->phone_number}}</h3>
            <h3>Indirizzo: {{$order->customer_address}}</h3>
            <h3>Importo Pagato: € {{number_format($order->tot_paid, 2)}}</h3>
            <h3>Data e Ora: <span>{{date_format($order->created_at, 'd/m/Y H:i:s')}}</span></h3>
            <a class="btn show-info" href="{{route('admin.orders.index')}}">Torna allo Storico Ordini</a>
        </div>
    </div>
@endsection