@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Usuários</h1>
@stop

@section('content')

    <section>
        <div class="accordion" id="filters">
            <div class="col-12 p-0 mb-1" id="filters-heading">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#filters-accordion" aria-expanded="true" aria-controls="filters-accordion">
                    Filtros
                </button>
            </div>
            {{-- TODO: Começar a fazer formulários com o package "glhd/aire" --}}
            <div id="filters-accordion" class="collapse show mb-1" aria-labelledby="filters-heading" data-parent="#filters">
                <div class="col-12 p-0">
                    <form method="post" action="" class="border px-1">
                        <div class="form-row">
                            <article class="form-group col-4">
                                <label for="name" class="label text-bold">Nome</label>
                                <input type="text" name="teste" id="teste" class="form-control">
                            </article>
                            <article class="form-group col-4">
                                <label for="name" class="label text-bold">Nome</label>
                                <input type="text" name="teste" id="teste" class="form-control">
                            </article>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section>
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
            </tr>
            </tbody>
        </table>
    </section>
@stop
