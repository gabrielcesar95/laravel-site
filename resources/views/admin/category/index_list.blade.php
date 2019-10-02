@section('list')
    <table class="table table-hover table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">
                <div class="d-flex align-items-center">
                    <a href="" class="text-bold text-white" data-search-order="id" data-search-order-direction="{{ (isset($order) && $order['column'] == 'id' && $order['direction'] == 'asc') ? 'desc' : 'asc' }}" {{ (isset($order) && $order['column'] == 'id' ? 'data-search-order-active' : '') }}>
                        #
                    </a>
                    @if(isset($order) && $order['column'] == 'id')
                        @if($order['direction'] == 'desc')
                            <i class="ml-1 mdi mdi-arrow-down"></i>
                        @else
                            <i class="ml-1 mdi mdi-arrow-up"></i>
                        @endif
                    @endif
                </div>
            </th>
            <th scope="col">
                <div class="d-flex align-items-center">
                    <a href="" class="text-bold text-white" data-search-order="name" data-search-order-direction="{{ (isset($order) && $order['column'] == 'name' && $order['direction'] == 'asc') ? 'desc' : 'asc' }}" {{ (isset($order) && $order['column'] == 'name' ? 'data-search-order-active' : '') }}>
                        Nome
                    </a>
                    @if(isset($order) && $order['column'] == 'name')
                        @if($order['direction'] == 'desc')
                            <i class="ml-1 mdi mdi-arrow-down"></i>
                        @else
                            <i class="ml-1 mdi mdi-arrow-up"></i>
                        @endif
                    @endif
                </div>
            </th>
            <th scope="col" class="d-none d-md-table-cell">
                <div class="d-flex align-items-center">
                    <a href="" class="text-bold text-white" data-search-order="uri" data-search-order-direction="{{ (isset($order) && $order['column'] == 'uri' && $order['direction'] == 'asc') ? 'desc' : 'asc' }}" {{ (isset($order) && $order['column'] == 'uri' ? 'data-search-order-active' : '') }}>
                        Caminho
                    </a>
                    @if(isset($order) && $order['column'] == 'uri')
                        @if($order['direction'] == 'desc')
                            <i class="ml-1 mdi mdi-arrow-down"></i>
                        @else
                            <i class="ml-1 mdi mdi-arrow-up"></i>
                        @endif
                    @endif
                </div>
            </th>
            <th scope="col" class="text-right">
                <span class="text-bold text-white">
                    Ações
                </span>
            </th>
        </tr>
        </thead>
        <tbody>
        @forelse($data as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->name }}</td>
                <td class="d-none d-md-table-cell">
                    <a class="btn btn-outline-primary" href="{{ url($row->slug) }}" target="_blank">
                        <i class="mdi mdi-open-in-new"></i>
                        {{ $row->slug }}
                    </a>
                </td>
                <td class="text-right">
                    <div class="btn-group" role="group" aria-label="Ações">
                        @can('role@show')
                            <button type="button" class="btn btn-info text-white d-flex align-items-center justify-content-center" data-trigger-popup="{{ route('admin.category.show', $row->id) }}" data-toggle="tooltip" data-placement="top" title="Visualizar">
                                <i class="mdi mdi-eye"></i>
                            </button>
                        @endcan
                        @can('role@edit')
                            <button type="button" class="btn btn-primary text-white d-flex align-items-center justify-content-center" data-trigger-popup="{{ route('admin.category.edit', $row->id) }}" data-toggle="tooltip" data-placement="top" title="Editar">
                                <i class="mdi mdi-pencil"></i>
                            </button>
                        @endcan
                        <div class="btn-group" role="group">
                            <button id="row-ID-dropdown" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu" aria-labelledby="row-ID-dropdown">
                                @if(auth()->user()->can('role@delete'))
                                    <span class="dropdown-item c-pointer" data-trigger-popup="{{ route('admin.category.delete', $row->id) }}" href="#">Deletar</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-danger text-center">
                    <span class="d-block text-bold">Nenhuma categoria encontrada</span>
                    <div class="btn-toolbar mt-1 justify-content-center" role="toolbar" aria-label="Ações">
                        <button class="btn btn-sm btn-outline-danger d-flex align-items-center" data-search-clear>
                            <i class="mdi mdi-filter-remove mr-1"></i> Limpar Filtros
                        </button>
                    </div>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="w-100 d-flex justify-content-center">
        {{ $data->links() }}
    </div>
@stop
@yield('list')

<script>
	$(function () {

	});
</script>
