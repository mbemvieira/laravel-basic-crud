@extends('layouts.layout')
@section('content')

<div class="container">

    <ol class="breadcrumb">
        <li><a href="{{ route('person.index') }}">Home</a></li>
        <li class="active">Edit</li>
    </ol>

    @if (count($errors) > 0)<!-- error-message -->
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif<!-- /error-message -->

    <div class="flash-message"><!-- flash-message -->
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close" aria-hidden="close">&times;</a></p>
        @endif
    @endforeach
    </div><!-- /flash-message -->

    <div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">
        <h3 class="panel-title">Editar Pessoa</h3>
    </div>
    <div class="panel-body">

        {!! Form::model($person, ['route' => ['person.update', $person], 'method' => 'PATCH']) !!}
        
        <div class="form-group">
        {!! Form::label('name', 'Nome *') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'maxlength' => '255']) !!}
        </div>
        
        <div class="form-group">
        {!! Form::label('cpf', 'CPF *') !!}
        {!! Form::text('cpf', null, ['class' => 'form-control', 'maxlength' => '11']) !!}
        </div>

        <div class="form-group">
        {!! Form::label('course', 'Curso *') !!}
        {!! Form::text('course', null, ['class' => 'form-control', 'maxlength' => '255']) !!}
        </div>

        <div class="form-group">
        {!! Form::label('institution', 'Instituição *') !!}
        {!! Form::text('institution', null, ['class' => 'form-control', 'maxlength' => '255']) !!}
        </div>

        <div class="form-group">
        {!! Form::label('emails[0][email]', 'Email *') !!}
        {!! Form::email('emails[0][email]', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
        {!! Form::label('phones[0][phone]', 'Telephone *') !!}
        {!! Form::text('phones[0][phone]', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
        {!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
    </div>

</div>

@endsection