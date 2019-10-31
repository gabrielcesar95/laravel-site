@section('list')

    <table class="table table-hover table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col" class="d-none d-md-table-cell">
                <div class="d-flex align-items-center">
                    <a href="" class="text-bold text-white" data-search-order="requester" data-search-order-direction="{{ (isset($order) && $order['column'] == 'requester' && $order['direction'] == 'asc') ? 'desc' : 'asc' }}" {{ (isset($order) && $order['column'] == 'requester' ? 'data-search-order-active' : '') }}>
                        Requisitante
                    </a>
                    @if(isset($order) && $order['column'] == 'requester')
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
                    <a href="" class="text-bold text-white" data-search-order="subject" data-search-order-direction="{{ (isset($order) && $order['column'] == 'subject' && $order['direction'] == 'asc') ? 'desc' : 'asc' }}" {{ (isset($order) && $order['column'] == 'subject' ? 'data-search-order-active' : '') }}>
                        Assunto
                    </a>
                    @if(isset($order) && $order['column'] == 'subject')
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
                        Data/Hora
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
                <td class="d-none d-md-table-cell">{{ $row->requester }}</td>
                <td>{{ $row->subject }}</td>
                <td class="d-none d-md-table-cell">
                    {{ $row->created_at }}
                </td>
                <td class="text-right">
                    <div class="btn-group" role="group" aria-label="Ações">
                        @can('contact@show')
                            <button type="button" class="btn btn-info text-white d-flex align-items-center justify-content-center" data-trigger-popup="{{ route('admin.contact.show', $row->id) }}" data-popup-size="lg" data-toggle="tooltip" data-placement="top" title="Visualizar">
                                <i class="mdi mdi-eye"></i>
                            </button>
                        @endcan
                        <div class="btn-group" role="group">
                            <button id="row-{{ $row->id }}-dropdown" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu" aria-labelledby="row-{{ $row->id }}-dropdown">
                                @if(auth()->user()->can('contact@delete'))
                                    <span class="dropdown-item c-pointer" data-trigger-popup="{{ route('admin.contact.delete', $row->id) }}" href="#">Deletar</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-danger text-center">
                    <span class="d-block text-bold">Nenhuma requisição encontrada</span>
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
