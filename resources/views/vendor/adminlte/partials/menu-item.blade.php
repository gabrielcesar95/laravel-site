@if (is_string($item))
    <li class="header">{{ $item }}</li>
@elseif (isset($item['header']))
    <li class="header">{{ $item['header'] }}</li>
@elseif (isset($item['search']) && $item['search'])
    <form action="{{ $item['href'] }}" method="{{ $item['method'] }}" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="{{ $item['input_name'] }}" class="form-control" placeholder="{{ $item['text'] }}">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="d-flex btn btn-flat">
                    <i class="mdi mdi-search"></i>
                </button>
            </span>
        </div>
    </form>
@else
    <li class="{{ $item['class'] }}">
        <a href="{{ $item['href'] }}" @if (isset($item['target'])) target="{{ $item['target'] }}" @endif>
            <i class="mr-2 mdi mdi-{{ $item['icon'] ?? '' }} {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>
            <span>
                {{ $item['text'] }}
            </span>

            @if (isset($item['label']))
                <span class="ml-auto mr-1 badge-wrap">
                    <span class="badge badge-pill badge-{{ $item['label_color'] ?? 'primary' }}">
                        {{ $item['label'] }}
                    </span>
                </span>
            @elseif (isset($item['submenu']))
                {{-- <span class="ml-auto mr-1 submenu-caret"> --}}
                {{-- <i class="mdi mdi-keyboard-arrow-left"></i> --}}
                {{-- </span> --}}
            @endif
        </a>
        @if (isset($item['submenu']))
            <ul class="{{ $item['submenu_class'] }}">
                @each('adminlte::partials.menu-item', $item['submenu'], 'item')
            </ul>
        @endif
    </li>
@endif
