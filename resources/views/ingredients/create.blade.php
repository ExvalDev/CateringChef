@extends('layouts.app')

@section('content')
    <h1>Zutaten</h1>
    <form method="POST" action="/tables">
        @csrf
        <div class="form-group">
                        
            <div class="col">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name" autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
                    
            <div class="col">
                <input id="supplier" type="text" class="form-control @error('supplier') is-invalid @enderror" name="supplier" value="{{ old('supplier') }}" placeholder="Lieferant" autocomplete="supplier" autofocus>

                @error('supplier')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
                    
            <div class="col">
                <input id="unit" type="text" class="form-control @error('unit') is-invalid @enderror" name="unit" value="{{ old('unit') }}" placeholder="unit" autocomplete="unit" autofocus>

                @error('unit')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group mb-0">
            <div class="col offset-md-4">
                <button type="submit" class="btn">
                    {{ __('Speichern') }}
                </button>
            </div>
        </div>
    </form>
@endsection