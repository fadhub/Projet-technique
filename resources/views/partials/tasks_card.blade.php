@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach($tasks as $task)
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="{{ asset($task->image) }}" class="card-img-top" alt="{{ $task->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $task->title }}</h5>
                    <p class="card-text">{{ $task->description }}</p>
                    <p class="card-text"><small class="text-muted">Créé le {{ $task->created_at }}</small></p>
                    @if($task->is_completed)
                    <span class="badge bg-success">Complété</span>
                    @else
                    <span class="badge bg-danger">En cours</span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection