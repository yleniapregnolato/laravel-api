@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mt-4">Modifica:</h1>


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.projects.update', ['project' => $project->slug]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $project->title) }}">
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Tipologia</label>
                <select name="type_id" id="type">
                    <option value="">SELEZIONA</option>
                    @foreach ($types as $type)
                        <option @selected(old('type_id', $project->type?->id == $type->id)) value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <p>Tecnologie</p>
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    @foreach ($technologies as $technology)
                        @if (old('technologies') !== null)
                            <input @checked(in_array($technology->id, old('technologies'))) name="technologies[]" type="checkbox" class="btn-check"
                                value="{{ $technology->id }}" id="technology-{{ $technology->id }}" autocomplete="off">
                        @else
                            <input @checked($project->technologies->contains($technology)) name="technologies[]" type="checkbox" class="btn-check"
                                value="{{ $technology->id }}" id="technology-{{ $technology->id }}" autocomplete="off">
                        @endif
                        <label class="btn btn-outline-primary"
                            for="technology-{{ $technology->id }}">{{ $technology->name }}</label>
                    @endforeach
                </div>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Contenuto</label>
                <textarea class="form-control" id="content" name="content" rows="3">{{ old('content', $project->content) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="start_date" class="form-label">Data di inizio</label>
                <input type="text" class="form-control" id="start_date" name="start_date"
                    value="{{ old('start_date', $project->start_date) }}">
            </div>

            <div class="mb-3">
                <label for="end_date" class="form-label">Data di fine</label>
                <input type="text" class="form-control" id="end_date" name="end_date"
                    value="{{ old('end_date', $project->end_date) }}">
            </div>

            <button class="btn btn-success" type="submit">Salva</button>
        </form>
    </div>
@endsection
