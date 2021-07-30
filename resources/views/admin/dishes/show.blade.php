@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card-info">
            <div class="row">
                <div class="col-md-6">
                    <h1>{{$dish->name}}
                        <span class="mb-3">
                            <a class="btn modify ml-3 mb-1" href="{{route('admin.dishes.edit', $dish->id)}}">MODIFICA</a>
                        </span>
                    </h1>
                    <h2>Ingredienti:</h2>
                    <p>{{$dish->ingredients}}</p>
                    <h2>Descrizione:</h2>
                    <p>{{$dish->description}}</p>
                    <h2>Prezzo:</h2>
                    <p>€{{number_format($dish->price, 2)}}</p>
                    <a class="btn show-info mt-5" href="{{route('admin.dishes.index')}}">Ritorna al Menù</a>
                </div>
                @if ($dish->image)
                    <div class="col-md-6">
                        <img class="img-fluid mt-5 rounded" src="{{asset('storage/' . $dish->image)}}" alt="{{$dish->name}}">
                    </div>
                @endif
            </div>
        </div>
    </div>
    
@endsection