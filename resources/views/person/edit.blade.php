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

    <div class="panel panel-default"><!-- Default panel contents -->
    <div class="panel-heading">
        <h3 class="panel-title">Editar Pessoa</h3>
    </div>
    <div class="panel-body" id="form-app">

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
        {!! Form::label('emails', 'Email(s) *') !!}
        <button type="button" @click="addNewEmail" class="btn btn-success">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        </button>
        <button type="button" @click="removeEmail" class="btn btn-warning">
            <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
        </button>
        </div>

        <template v-for="(email, index) in emails">
        <div class="form-group">
            <p>Email @{{ index + 1 }}</p>
            <input type="text" :name="'emails['+ index +'][email]'" v-model="email.email_address" class="form-control">
        </div>
        </template>

        <div class="form-group">
        {!! Form::label('phones', 'Telefone(s) *') !!}
        <button type="button" @click="addNewPhone" class="btn btn-success">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        </button>
        <button type="button" @click="removePhone" class="btn btn-warning">
            <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
        </button>
        </div>

        <template v-for="(phone, index) in phones">
        <div class="form-group">
            <p>Telefone @{{ index + 1 }}</p>
            <input type="text" :name="'phones['+ index +'][phone]'" v-model="phone.phone_number" class="form-control">
        </div>
        </template>

        <div class="form-group">
        {!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
    </div>

</div>

@endsection

@section('scripts')

<script>
new Vue({
    el: '#form-app',
    data: {
        emails: [
            @foreach ($person->emails as $email)
            @if ($loop->last)
            {
                email_address: '{{ $email->email }}'
            }
            @else
            {
                email_address: '{{ $email->email }}'
            },
            @endif
            @endforeach
        ],
        phones: [
            @foreach ($person->phones as $phone)
            @if ($loop->last)
            {
                phone_number: '{{ $phone->phone }}'
            }
            @else
            {
                phone_number: '{{ $phone->phone }}'
            },
            @endif
            @endforeach
        ]
    },
    methods: {
        addNewEmail() {
            if (this.emails.length < 3) {
                this.emails.push({
                    email_address: ''
                });
            }
        },
        removeEmail() {
            if (this.emails.length > 1) {
                this.emails.pop();
            }
        },
        addNewPhone() {
            if (this.phones.length < 3) {
                this.phones.push({
                    phone_number: ''
                });
            }
        },
        removePhone() {
            if (this.phones.length > 1) {
                this.phones.pop();
            }
        },
    }
});
</script>

@endsection