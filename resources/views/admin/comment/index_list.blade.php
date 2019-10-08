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
            <th scope="col" class="d-none d-md-table-cell">
                <div class="d-flex align-items-center">
                    <a href="" class="text-bold text-white" data-search-order="created_at" data-search-order-direction="{{ (isset($order) && $order['column'] == 'created_at' && $order['direction'] == 'asc') ? 'desc' : 'asc' }}" {{ (isset($order) && $order['column'] == 'created_at' ? 'data-search-order-active' : '') }}>
                        Data
                    </a>
                    @if(isset($order) && $order['column'] == 'created_at')
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
                    <span class="text-bold text-white">Autor</span>
                </div>
            </th>
            <th scope="col">
                <div class="d-flex align-items-center">
                    <span class="text-bold text-white">Postagem</span>
                </div>
            </th>
            <th scope="col" class="d-none d-md-table-cell">
                <div class="d-flex align-items-center">
                    <a href="" class="text-bold text-white" data-search-order="approved" data-search-order-direction="{{ (isset($order) && $order['column'] == 'approved' && $order['direction'] == 'asc') ? 'desc' : 'asc' }}" {{ (isset($order) && $order['column'] == 'approved' ? 'data-search-order-active' : '') }}>
                        Situação
                    </a>
                    @if(isset($order) && $order['column'] == 'approved')
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
                <td class="d-none d-md-table-cell">{{ $row->created_at }}</td>
                <td class="d-none d-md-table-cell">
                    {{ $row->user->name }}
                </td>
                <td>
                    {{ $row->commentable->name }}
                </td>
                <td class="d-none d-md-table-cell">
                    @if($row->approved)
                        <span class="badge badge-pill badge-success ml-auto px-2 py-2" data-toggle="tooltip" title="Aprovado">
                            <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                    @else
                        <span class="badge badge-pill badge-danger ml-auto px-2 py-2" data-toggle="tooltip" title="Aguardando Aprovação">
                            <i class="mdi mdi-close-circle-outline"></i>
                        </span>
                    @endif
                </td>
                <td class="text-right">
                    <div class="btn-group" role="group" aria-label="Ações">
                        @can('comment@show')
                            <button type="button" class="btn btn-info text-white d-flex align-items-center justify-content-center" data-trigger-popup="{{ route('admin.comment.show', $row->id) }}" data-popup-size="lg" data-toggle="tooltip" data-placement="top" title="Visualizar">
                                <i class="mdi mdi-eye"></i>
                            </button>
                        @endcan
                        <div class="btn-group" role="group">
                            <button id="row-{{ $row->id }}-dropdown" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu" aria-labelledby="row-{{ $row->id }}-dropdown">
                                @if(auth()->user()->can('comment@delete'))
                                    <span class="dropdown-item c-pointer" data-trigger-popup="{{ route('admin.comment.delete', $row->id) }}" href="#">Deletar</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-danger text-center">
                    <span class="d-block text-bold">Nenhum comentário encontrado</span>
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
