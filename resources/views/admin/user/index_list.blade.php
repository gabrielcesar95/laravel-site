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
                    <a href="" class="text-bold text-white" data-search-order="email" data-search-order-direction="{{ (isset($order) && $order['column'] == 'email' && $order['direction'] == 'asc') ? 'desc' : 'asc' }}" {{ (isset($order) && $order['column'] == 'email' ? 'data-search-order-active' : '') }}>
                        E-mail
                    </a>
                    @if(isset($order) && $order['column'] == 'email')
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
                    <a href="" class="text-bold text-white" data-search-order="last_login" data-search-order-direction="{{ (isset($order) && $order['column'] == 'last_login' && $order['direction'] == 'asc') ? 'desc' : 'asc' }}" {{ (isset($order) && $order['column'] == 'last_login' ? 'data-search-order-active' : '') }}>
                        Último Acesso
                    </a>
                    @if(isset($order) && $order['column'] == 'last_login')
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
                <td class="d-none d-md-table-cell">{{ $row->email }}</td>
                <td class="d-none d-md-table-cell">
                    @php
                        $date = Spatie\Activitylog\Models\Activity::causedBy($row)->where('description', 'login')->orderBy('created_at', 'desc')->first()->created_at ?? '';
                    @endphp
                    {{ $date ? date_format($date, 'd/m/Y H:i:s') : '' }}</td>
                <td class="text-right">
                    <div class="btn-group" role="group" aria-label="Ações">
                        @can('user@show')
                            <button type="button" class="btn btn-info text-white d-flex align-items-center justify-content-center" data-trigger-popup="{{ route('admin.user.show', $row->id) }}" data-toggle="tooltip" data-placement="top" title="Visualizar">
                                <i class="mdi mdi-eye"></i>
                            </button>
                        @endcan
                        @can('user@edit')
                            <button type="button" class="btn btn-primary text-white d-flex align-items-center justify-content-center" data-trigger-popup="{{ route('admin.user.edit', $row->id) }}" data-popup-size="lg" data-toggle="tooltip" data-placement="top" title="Editar">
                                <i class="mdi mdi-pencil"></i>
                            </button>
                        @endcan
                        @can('user@delete')
                            <div class="btn-group" role="group">
                                <button id="row-{{ $row->id }}-dropdown" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </button>
                                <div class="dropdown-menu" aria-labelledby="row-{{ $row->id }}-dropdown">
                                    @if($row->id !== Auth::id())
                                        <span class="dropdown-item c-pointer" data-trigger-popup="{{ route('admin.user.delete', $row->id) }}" href="#">Deletar</span>
                                    @endif
                                </div>
                            </div>
                        @endcan
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-danger text-center">
                    <span class="d-block text-bold">Nenhum usuário encontrado</span>
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
