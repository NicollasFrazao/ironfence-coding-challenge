@extends('layouts.app')

@push('css')
@endpush

@section('content-header')
    <div class="row">
        <div class="col-sm-6">
            <h1>{{ __('Criar Tarefa') }}</h1>
        </div>
        
        <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">{{ __('Tarefas') }}</a></li>
                <li class="breadcrumb-item active">{{ __('Criar Tarefa') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="card card-info">
        <div class="card-body">
            @if (Route::has('tasks.store'))
                {!! \Form::open(['route' => ['tasks.store']]) !!}
                    @include('tasks.fields')
                {!! \Form::close() !!}
            @endif
        </div>
    </div>
@endsection

@push('scripts')
@endpush