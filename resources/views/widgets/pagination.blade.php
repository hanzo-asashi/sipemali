@if ($paginator['current_page'] > 1)
    <nav>
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator['current_page'] === 1)
                <li class="page-item disabled" aria-disabled="true" aria-label="previous">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="#" wire:click="setPage('{{ $paginator['prev_page_url'] }}')" rel="prev" aria-label="previous">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($paginator['links'] as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @if ($element['label'] == $paginator['current_page'])
                        <li class="page-item {{ $element['active'] ? 'active' : '' }}" aria-current="page">
                            <span class="page-link">{{ $element['label'] }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="#" wire:click="setPage('{{ $element['url'] }}')">
                                {!! $element['label'] !!}
                            </a>
                        </li>
                    @endif
{{--                    @foreach ($element as $page => $url)--}}
{{--                        @if ($page['label'] == $paginator['current_page'])--}}
{{--                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>--}}
{{--                        @else--}}
{{--                            <li class="page-item"><a class="page-link" href="#" wire:click="setPage('{{ $url }}')">{{ $page }}</a></li>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator['total'] > 1)
                <li class="page-item">
                    <a class="page-link" href="#" wire:click="setPage('{{ $paginator['next_page_url'] }}')" rel="next" aria-label="next">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="next">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
