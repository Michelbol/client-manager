@extends('layouts.app')

@section('content')
    <div class="table-wrapper">
        <div class="d-flex flex-row table-title">
            <div class="col-8 d-flex justify-content-start">
                <h3 class="bold">Cadastro de Clientes</h3>
            </div>
            <div class="col-2 d-flex justify-content-end">
                <form class="" action="{{ route('clients.index') }}">
                    <div class="input-group flex-nowrap">
                        <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
                        <input value="{{ $search }}" name="search" type="text" class="form-control" placeholder="Search" aria-label="Username" aria-describedby="addon-wrapping">
                    </div>
                </form>
            </div>
            <div class="col-2 d-flex justify-content-end">
                <a href="{{ route('clients.create') }}" type="button" class="btn btn-success"><i class="fas fa-plus-circle"></i> Adicionar Novo Cliente</a>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Data de Nascimento</th>
                <th scope="col">Gênero</th>
                <th scope="col">Cidade</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($clients as $client)
                <tr>
                    <th scope="row">{{ $client->id }}</th>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->date_of_birth->format(config('app.date_format')) }}</td>
                    <td>{{ __("enums.gender.$client->gender") }}</td>
                    <td>{{ $client->city_name }}</td>
                    <td>
                       <div class="d-flex">
                           <a type="button" class="btn btn-outline-warning btn-sm" href="{{ route('clients.edit', $client->id) }}">
                               <i class="fas fa-pen"></i>
                           </a>
                           <a
                               type="button"
                               class="btn btn-outline-danger btn-sm mx-1"
                               href="#"
                               onclick="event.preventDefault();if(confirm('Deseja excluir este item?')){document.getElementById('form-delete-{{ $client->id }}').submit();}"
                           >
                               <i class="fas fa-trash"></i>
                           </a>
                           <form method="POST" id="form-delete-{{ $client->id }}" action="{{ route('clients.destroy', $client->id) }}" class="mx-1">
                               {{ csrf_field() }}
                               <input name="_method" type="hidden" value="DELETE">
                           </form>
                       </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $clients->appends($search)->links() }}
    </div>
@endsection
