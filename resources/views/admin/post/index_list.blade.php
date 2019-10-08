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
            <th scope="col" class="d-none d-md-table-cell">
                <div class="d-flex align-items-center">
                    <a href="" class="text-bold text-white" data-search-order="posted_at" data-search-order-direction="{{ (isset($order) && $order['column'] == 'posted_at' && $order['direction'] == 'asc') ? 'desc' : 'asc' }}" {{ (isset($order) && $order['column'] == 'posted_at' ? 'data-search-order-active' : '') }}>
                        Publicação
                    </a>
                    @if(isset($order) && $order['column'] == 'posted_at')
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
                    <a class="btn btn-outline-primary" href="{{ route('web.post.show', $row->slug) }}" target="_blank">
                        <i class="mdi mdi-open-in-new"></i>
                        {{ $row->slug }}
                    </a>
                </td>
                <td class="d-none d-md-table-cell">
                    @if($row->posted_at)
                        <span class="badge badge-pill badge-success ml-auto px-3 py-2" data-toggle="tooltip" title="Publicada em {{ $row->posted_at }}">
                            <i class="mdi mdi-check-circle-outline"></i> Publicada
                        </span>
                    @else
                        <span class="badge badge-pill badge-danger ml-auto px-3 py-2">
                            <i class="mdi mdi-close-circle-outline"></i> Não Publicada
                        </span>
                    @endif
                </td>
                <td class="text-right">
                    <div class="btn-group" role="group" aria-label="Ações">
                        @can('post@show')
                            <button type="button" class="btn btn-info text-white d-flex align-items-center justify-content-center" data-trigger-popup="{{ route('admin.post.show', $row->id) }}" data-popup-size="lg" data-toggle="tooltip" data-placement="top" title="Visualizar">
                                <i class="mdi mdi-eye"></i>
                            </button>
                        @endcan
                        @can('post@edit')
                            <button type="button" class="btn btn-primary text-white d-flex align-items-center justify-content-center" data-trigger-popup="{{ route('admin.post.edit', $row->id) }}" data-popup-size="lg" data-toggle="tooltip" data-placement="top" title="Editar">
                                <i class="mdi mdi-pencil"></i>
                            </button>
                        @endcan
                        <div class="btn-group" role="group">
                            <button id="row-{{ $row->id }}-dropdown" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu" aria-labelledby="row-{{ $row->id }}-dropdown">
                                @if(auth()->user()->can('comment@index'))
                                    <span class="dropdown-item c-pointer" data-trigger-popup="{{ route('admin.post.comments', $row->id) }}" data-popup-size="lg" href="#">Comentários</span>
                                @endif
                                @if(auth()->user()->can('post@delete'))
                                    <span class="dropdown-item c-pointer" data-trigger-popup="{{ route('admin.post.delete', $row->id) }}" href="#">Deletar</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-danger text-center">
                    <span class="d-block text-bold">Nenhuma postagem encontrada</span>
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
