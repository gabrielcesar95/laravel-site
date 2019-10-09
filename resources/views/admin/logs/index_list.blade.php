@section('list')

    <table class="table table-hover table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">
                <div class="d-flex align-items-center">
                    <a href="" class="text-bold text-white" data-search-order="log_name" data-search-order-direction="{{ (isset($order) && $order['column'] == 'log_name' && $order['direction'] == 'asc') ? 'desc' : 'asc' }}" {{ (isset($order) && $order['column'] == 'log_name' ? 'data-search-order-active' : '') }}>
                        @lang('logs.log_name')
                    </a>
                    @if(isset($order) && $order['column'] == 'log_name')
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
                    <a href="" class="text-bold text-white" data-search-order="description" data-search-order-direction="{{ (isset($order) && $order['column'] == 'description' && $order['direction'] == 'asc') ? 'desc' : 'asc' }}" {{ (isset($order) && $order['column'] == 'description' ? 'data-search-order-active' : '') }}>
                        @lang('logs.description')
                    </a>
                    @if(isset($order) && $order['column'] == 'description')
                        @if($order['direction'] == 'desc')
                            <i class="ml-1 mdi mdi-arrow-down"></i>
                        @else
                            <i class="ml-1 mdi mdi-arrow-up"></i>
                        @endif
                    @endif
                </div>
            </th>
            <th scope="col" class="d-none d-md-table-cell">
                <span class="text-bold text-white">
                    @lang('logs.causer')
                </span>
            </th>
            <th scope="col" class="d-none d-md-table-cell">
                <div class="d-flex align-items-center">
                    <a href="" class="text-bold text-white" data-search-order="created_at" data-search-order-direction="{{ (isset($order) && $order['column'] == 'created_at' && $order['direction'] == 'asc') ? 'desc' : 'asc' }}" {{ (isset($order) && $order['column'] == 'created_at' ? 'data-search-order-active' : '') }}>
                        @lang('logs.date_time')
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
                <td>@lang("logs.log_names.$row->log_name")</td>
                <td>@lang("logs.descriptions.$row->description")</td>
                <td class="d-none d-md-table-cell">{{ $row->causer ? $row->causer->name ?? $row->causer->id : '' }}</td>
                <td class="d-none d-md-table-cell">
                    {{ date_format($row->created_at, 'd/m/Y H:i:s') }}</td>
                <td class="text-right">
                    <div class="btn-group" role="group" aria-label="Ações">
                        @can('logs@show')
                            <button type="button" class="btn btn-info text-white d-flex align-items-center justify-content-center" data-trigger-popup="{{ route('admin.logs.show', $row->id) }}" data-popup-size="lg" data-toggle="tooltip" data-placement="top" title="Visualizar">
                                <i class="mdi mdi-eye"></i>
                            </button>
                        @endcan
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-danger text-center">
                    <span class="d-block text-bold">Nenhum registro encontrado</span>
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
