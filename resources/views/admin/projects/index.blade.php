@extends('layouts.admin')

@section('content')
    <div class="container">
        @isset($success)
            <div class="alert alert-success mt-4">
                {{ $success }}
            </div>
        @endisset

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <h1 class="mb-5 mt-4">TABELLA PROGETTI:</h1>

        <a class="btn btn-primary" href="{{ route('admin.projects.create') }}">Crea un nuovo progetto</a>
        <table class="table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Titolo</th>
                        <th scope="col">Tipologia</th>
                        <th scope="col" class="d-none d-sm-table-cell">Contenuto</th>
                        <th scope="col" class="d-none d-sm-table-cell">Data inizio</th>
                        <th scope="col" class="d-none d-sm-table-cell">Data fine</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <th scope="row">{{ $project->title }}</th>
                            <td>{{ $project->type?->name }}</td>
                            <td>
                                <p class="d-none d-lg-block">{{ $project->content }}</p>
                            </td>
                            <td class="d-none d-sm-table-cell ms_date">{{ $project->start_date }}</td>
                            <td class="d-none d-sm-table-cell ms_date">{{ $project->end_date }}</td>
                            <td class="text-nowrap d-flex">

                                <a class="btn btn-primary"
                                    href="{{ route('admin.projects.show', ['project' => $project->slug]) }}">Dettagli</a>
                                <a href="{{ route('admin.projects.edit', ['project' => $project->slug]) }}" type="button"class="btn btn-outlime-primary p-0 ms-5">
                                    <i class="fa-solid fa-pencil rounded-1 text-primary border border-primary p-2"></i>
                                </a>
                                <form action="{{ route('admin.projects.destroy', ['project'=>$project->slug]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn p-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa-solid fa-trash border border-danger text-danger p-2 rounded-1"></i>
                                    </button>

                                </form>


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
@endsection
