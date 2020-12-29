@extends('layouts.app')

@section('content')
    <div class="form-title p-2">
        <h3>Edição de Cliente</h3>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger mt-2">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="form-input p-3">
        <form action="{{ route('clients.update', $client->id) }}" method="POST">
            <input name="_method" type="hidden" value="PUT">
            @include('clients._form')
        </form>
    </div>
@endsection
