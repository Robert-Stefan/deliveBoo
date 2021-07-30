@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('deleted'))
    <div class="alert alert-success">
        Ristorante
        <strong>{{ session('deleted') }} </strong>
        cancellato con successo
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if ($user->restaurant)
                <div class="card-info big-font text-center">
                    <h1><a href="{{ route('admin.restaurants.show', $user->restaurant->id) }}">{{$user->restaurant->name}}</a></h1>
                    <img class="img-fluid" src="{{asset('storage/' . $user->restaurant->image)}}" :alt="{{$user->restaurant->name}}">
                </div>
            @endif

            <div>
                @if (!$user->restaurant)
                    <a class="btn add ml-3 mb-3 mt-5" href="{{ route('admin.restaurants.create') }}"><h1>Aggiungi qui il tuo ristorante</h1></a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
