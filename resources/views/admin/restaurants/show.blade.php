@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card-info">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="mb-3">{{$restaurant->name}}</h1>
                    <a class="btn add text-uppercase mb-5" href="{{route('admin.dishes.index')}}">Visualizza il tuo menù</a>
                    <div>
                        <h3>P.IVA: <span>{{ $restaurant->vat_number }}</span></h3>
                        <h3>INDIRIZZO: <span> {{ $restaurant->address }} </span></h3>
                        <h3>
                            TIPOLOGIE: @foreach ($restaurant->types as $type)
                            <span>
                                {{ $type->name }}
                            </span>
                            @endforeach
                        </h3>
                    </div>
                    <div class="mt-5 d-flex justify-content-center flex-wrap">
                        <a class="btn show-info text-uppercase mr-2 mt-3" href="{{route('admin.orders.index')}}">Storico Ordini</a>
                        <a class="btn modify text-uppercase pr-3 pl-3 mr-2 mt-3" href="{{route('admin.restaurants.edit', $restaurant->id)}}">Modifica</a>
                        <form class="delete-form d-inline-block" action="{{route('admin.restaurants.destroy', $restaurant->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn delete mt-3" value="CANCELLA RISTORANTE">
                        </form>
                    </div>
                </div>
                @if ($restaurant->image)
                    <div class="col-md-6">
                        <img class="img-fluid mt-5 rounded" src="{{asset('storage/' . $restaurant->image)}}" alt="{{$restaurant->name}}">
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection