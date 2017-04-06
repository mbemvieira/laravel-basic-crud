@extends('layout')
@section('content')

<div class="container">

    <ol class="breadcrumb">
    <li class="active">Home</li>
    </ol>

    <div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">
        <h3 class="panel-title">Listar Pessoas</h3>
    </div>
    <div class="panel-body">

        <a type="button" class="btn btn-primary btn-lg btn-block" href="{{ route('person.create') }}">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Pessoa
		</a></br>

        <!-- Table -->
        <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Curso</th>
            <th>Instituição</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Mateus</td>
            <td>12341234</td>
            <td>Engenharia da Computação</td>
            <td>UNIFEI</td>
        </tr>
        </tbody>
        </table>
    </div>
    </div>

</div> <!-- /container -->
    
@stop