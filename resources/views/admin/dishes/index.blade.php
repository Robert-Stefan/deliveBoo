@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card-info">
            @if(session('deleted'))
                <div class="alert alert-success">
                    Piatto
                    <strong>{{ session('deleted') }} </strong>
                    cancellato con successo
                </div>
            @endif
            <h1 class="mb-5 text-center"><a href="{{ route('admin.restaurants.show', $restaurant->id)}}">{{$restaurant->name}}</a></h1>
            <h2>MENÙ</h2>
            <a class="btn show-info text-uppercase mr-3" href="{{route('admin.restaurants.show', $restaurant->id)}}">Ritorna al ristorante</a>
            <a class="btn add text-uppercase pr-3 pl-3" href="{{route('admin.dishes.create')}}">Aggiungi Piatto</a>
            <table class="table tt mt-5">
                <thead>
                    <tr>
                        <th>Nome Piatto</th>
                        <th>Prezzo</th>
                        <th>Visibilità</th>
                        <th colspan="3">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dishes as $dish)
                        <tr>
                            <td>{{$dish->name}}</td>
                            <td>€{{number_format($dish->price, 2)}}</td>
                            <td><button class="btn btn-secondary ml-2" disabled> {{$dish->visibility ? 'Sì' : 'No'}} </button></td>
                            <td>
                                <a class="btn show-info" href="{{route('admin.dishes.show', $dish->id)}}">Mostra Dettagli</a>
                            </td>
                            <td>
                                <a class="btn modify" href="{{route('admin.dishes.edit', $dish->id)}}">Modifica Dettagli</a>
                            </td>
                            <td>
                                <form class="delete-form" action="{{route('admin.dishes.destroy', $dish->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn delete" value="ELIMINA PIATTO">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection