@props(['items' => []])

@if (count($items))
    <nav class="breadcrumbs container" aria-label="Breadcrumb">
        <ol class="breadcrumbs__list">
            @foreach ($items as $item)
                <li class="breadcrumbs__item">
                    @if (!empty($item['url']) && !$loop->last)
                        <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                    @else
                        <span @if ($loop->last) aria-current="page" @endif>{{ $item['label'] }}</span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif
