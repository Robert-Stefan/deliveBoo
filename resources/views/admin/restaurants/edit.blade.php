@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="card-info">
            <h1>Modifica il Ristorante:
                <a href="{{route('admin.restaurants.show', $restaurant->id)}}">{{$restaurant->name}}</a>
            </h1>
            <form method="POST" action="{{route('admin.restaurants.update', $restaurant->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="name" class="control-table">Nome*</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name', $restaurant->name)}}" required maxlength="30">
                    @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            
                <div class="mb-3">
                    <label for="vat_number" class="control-table">P.IVA*</label>
                    <input type="text" class="form-control @error('vat_number') is-invalid @enderror" id="vat_number" name="vat_number" required maxlength="11" minlength="11" value="{{old('vat_number.name', $restaurant->vat_number)}}">
                    @error('vat_number')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address" class="control-table">Indirizzo*</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" required maxlength="50" value="{{old('adress.name', $restaurant->address)}}">
                    @error('address')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3 d-flex flex-column align-items-center text-uppercase">
                    <h4>Tipologie Ristorante*</h4>
                    <ul>
                        @foreach ($types as $type)
                            <li class="list-unstyled">
                                <input class="@error('types') is-invalid @enderror" type="checkbox" name="types[]" id="type{{ $loop->iteration }}"
                                    value="{{ $type->id}}"
                                    @if ($errors->any() && in_array($type->id, old('types')))
                                        checked
                                    @elseif (! $errors->any() && $restaurant->types->contains($type->id))
                                        checked
                                    @endif
                                >
                                <label for="type{{ $loop->iteration }}">
                                    {{$type->name}}
                                </label>
                            </li>
                        @endforeach
                    </ul>
            
                    @error('types')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <div>
                        <label for="image">Immagine Ristorante</label>
                    </div>
                    @if ($restaurant->image)
                        <div class="mb-3">
                            <img width="200" src="{{asset('storage/' . $restaurant->image)}}" alt="{{$restaurant->name}}">
                        </div>
                    @endif
                    <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
                    @error('image')
                        <div>{{$message}}</div>
                    @enderror
                    <button id="sub-btn" type="submit" class="btn add text-uppercase pr-3 pl-3">Salva</button>
                    <a class="btn btn-danger text-uppercase ml-2 " href="{{route('admin.restaurants.show', $restaurant->id)}}">Indietro</a>
                </div>
            </form>
        </div>
    </div>
    
@endsection