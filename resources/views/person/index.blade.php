@extends('layouts.layout')
@section('content')

<div class="container" id="my-app">

  <ol class="breadcrumb">
      <li class="active">Home</li>
  </ol>

  <div class="panel panel-default"><!-- Panel -->
    <div class="panel-heading"><!-- Panel Heading -->
      <h3 class="panel-title">Listar Pessoas</h3>
    </div><!-- /Panel Heading -->
    <div class="panel-body"><!-- Panel Body -->

      <a type="button" class="btn btn-primary btn-lg btn-block" href="{{ route('person.create') }}">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Pessoa
      </a></br>

      <div><!-- Table -->
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>Nome</th>
              <th>CPF</th>
              <th>Curso</th>
              <th>Instituição</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
          @foreach($people as $person)
            <tr>
              <td>{{ $person->name }}</td>
              <td>{{ $person->cpf }}</td>
              <td>{{ $person->course }}</td>
              <td>{{ $person->institution }}</td>
              <td>
                <div style="text-align: center;">
                  <a href="{{ route('person.edit', $person) }}" class="btn btn-warning glyphicon glyphicon-pencil"></a>
                  <a onclick="confirmation({{ $person->id }})" class="btn btn-danger glyphicon glyphicon-remove"></a>
                  {!! Form::open(['method' => 'DELETE', 'route' => ['person.destroy', $person], 'id' => 'delete-person-form_'.$person->id]) !!}
                  {!! Form::close() !!}
                </div>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div><!-- /Table -->

		  {{ $people->links() }}<!-- Create links for Pagination -->

      {{--  <ais-index
        app-id="{{ config('scout.algolia.id') }}"
        api-key="{{ env('ALGOLIA_SEARCH') }}"
        index-name="people"
      >
        <ais-search-box></ais-search-box></br>

        <ais-sort-by-selector :indices="[
            {
              name: 'people',
              label: 'A-Z'
            },
            {
              name: 'people_cpf_asc',
              label: 'CPF crescente'
            }
          ]"
        ></ais-sort-by-selector>

        <ais-stats></ais-stats>

        <ais-results inline-template :results-per-page="{{ 10 }}">
          <div class="table-responsive"><!-- Table -->
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>CPF</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="result in results" :key="result.id">
                  <td>@{{ result.name }}</td>
                  <td>@{{ result.cpf }}</td>
                </tr>
            </tbody>
            </table>
          </div><!-- /Table -->
        </ais-results>

        <ais-pagination class="pagination" :class-names="{
            'ais-pagination': 'pagination',
            'ais-pagination__item--active': 'active',
            'ais-pagination__item--disabled': 'disabled'
        }"></ais-pagination>

        <ais-no-results>
          <template scope="props">
            No person found for <i>@{{ props.query }}</i>.
          </template>
        </ais-no-results>

      </ais-index>  --}}

    </div><!-- /Panel Body -->
  </div><!-- /Panel -->

</div> <!-- /container -->

@stop

@section('local-scripts')

<script src="{{ asset('js/person.js') }}"></script>

<script>
function confirmation($person_id) {
	if (confirm("Deseja excluir este registro?")){
		document.getElementById("delete-person-form_" + $person_id).submit();
	}
}
</script>

@stop
