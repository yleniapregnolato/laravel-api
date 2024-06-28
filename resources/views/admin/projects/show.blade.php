@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mt-4">DETTAGLI DEL PROGETTO:</h1>

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="mt-5">
            <h3>Titolo:</h3>
            <p class="fw-bold">{{ $project->title }}</p>
        </div>
        <div class="mt-5">
            <h3>Tipologia:</h3>
            <p class="fw-bold">{{ $project->type?->name }}</p>
        </div>
        <div class="mt-5">
            <h3>Tecnologie utilizzate:</h3>
            @forelse ($project->technologies as $technology)
                <p class="fw-bold">{{ $technology->name }}</p>
                <h5>Descrizione della tescnologia utilizzata:</h4>
                <p>{{ $technology->description }}</p>
            @empty
                <p>Nessuna tecnologia presente</p>
            @endforelse
        </div>
        <div class="mt-5">
            <h3>Contenuto:</h3>
            <p>{{ $project->content }}</p>
        </div>
        <div class="mt-5">
            <h3>Slug:</h3>
            <p>{{ $project->slug }}</p>
        </div>
    </div>
@endsection
