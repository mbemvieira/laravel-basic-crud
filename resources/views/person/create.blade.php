@extends('layouts.layout')
@section('content')

<div class="container">

    <ol class="breadcrumb">
        <li><a href="{{ route('person.index') }}">Home</a></li>
        <li class="active">Create</li>
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
        <h3 class="panel-title">Adicionar Pessoa</h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'person.store', 'method' => 'POST']) !!}
        
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

        {{-- <div id="form-email">
        <a type="button" class="btn btn-default" @click="addNewEmail">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New Email
		</a></br>
        <div class="form-group">
        {!! Form::label('email', 'Email *') !!}
        <template v-for="email in emails">
            <input type="text" name="emails[]" v-model="email.email_address" class="form-control">
        </template>
        </div>
        </div> --}}

        <div class="form-group">
        {!! Form::submit('Adicionar', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
    </div>

</div>
    
@endsection