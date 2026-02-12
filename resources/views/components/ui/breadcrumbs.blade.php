@props(['items' => []])

@php
    $items = collect($items)
        ->map(function ($item) {
            if (is_string($item)) {
                return ['label' => $item, 'url' => null];
            }

            return [
                'label' => $item['label'] ?? '',
                'url' => $item['url'] ?? null,
            ];
        })
        ->filter(function ($item) {
            return filled($item['label']);
        })
        ->values();
@endphp

@if ($items->isNotEmpty())
    <nav aria-label="Breadcrumb" {{ $attributes->merge(['class' => 'breadcrumbs text-sm text-base-content/80 mb-2']) }}>
        <ol>
            @foreach ($items as $index => $item)
                <li>
                    @if ($item['url'] && $index !== $items->count() - 1)
                        <a href="{{ $item['url'] }}" class="hover:text-primary">
                            {{ $item['label'] }}
                        </a>
                    @else
                        <span class="font-semibold text-base-content">
                            {{ $item['label'] }}
                        </span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif
