@if(isset($data['navbarItems']) && $data['navbarItems']->count() > 0)
    @foreach($data['navbarItems'] as $item)
        @if($item->children->count() > 0)
            <li class="dropdown dropdown-with-hover">
                <a href="{{ $item->slug ? url($item->slug) : '#' }}" class="dropdown-toggle" id="dropdownMenuButton{{ $item->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ $item->title }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $item->id }}">
                    @foreach($item->children as $child)
                        <li>
                            <a class="dropdown-item" href="{{ $child->slug ? url($child->slug) : '#' }}">
                                {{ $child->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @else
            <li>
                <a href="{{ $item->slug ? url($item->slug) : '#' }}">
                    {{ $item->title }}
                </a>
            </li>
        @endif
    @endforeach
@endif
