@extends('layouts.app')

@section('content')

   <div class="container">
        <div class="card-info">
            <h1>AGGIUNGI UN NUOVO PIATTO</h1>
            <form method="POST" action="{{route('admin.dishes.store')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="mb-3">
                    <label for="name" class="control-table">Nome*</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name')}}" required maxlength="50">
                    @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="ingredients" class="control-table">Ingredienti*</label>
                    <textarea class="form-control @error('ingredients') is-invalid @enderror" id="ingredients" name="ingredients" rows="10" required>{{old('ingredients')}}</textarea>
                    @error('ingredients')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="control-table">Descrizione*</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="10" required>{{old('description')}}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="control-table">Prezzo*</label>
                    <input type="number" step="0.1" class="form-control @error('price') is-invalid @enderror" name="price" id="price" max="999" value="{{old('price')}}" required >
                    @error('price')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="visibility" class="control-table mr-3">VISIBILITÀ:</label>
                    <input type="checkbox" name="visibility" id="visibility" checked>
                </div>
                <div class="mb-3">
                    <div>
                        <label for="image">Immagine Piatto</label>
                    </div>
                    <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
                    @error('image')
                        <div>{{$message}}</div>
                    @enderror
                </div>
                
                    <button type="submit" class="btn add text-uppercase pr-3 pl-3">Salva</button>
                    <a class="btn btn-danger text-uppercase ml-2 " href="{{route('admin.dishes.index')}}">Indietro</a>

                
            </form>
        </div>
   </div>

@endsection