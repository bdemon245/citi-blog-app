@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="f">
        {{-- results hint --}}

        {{-- page links --}}
        @foreach ($elements as $element)
            {{-- Array Of Links --}}
            <ul class="pagination justify-content-center">
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li aria-current="page" class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a href="{{ $url }}" class="page-link"
                                    aria-label="{{ __('Go to page :page', ['page' => $page]) }}">{{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        @endforeach

        <div class="d-flex align-items-center justify-content-between px-5 mt-2">
            <p class="ms-3">
                {!! __('Showing') !!}
                @if ($paginator->firstItem())
                    <span class="">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="">{{ $paginator->lastItem() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
                {!! __('of') !!}
                <span class="">{{ $paginator->total() }}</span>
                {!! __('results') !!}
            </p>
            {{-- action btns --}}
            <div class="d-flex gap-2">
                {{-- previous btn --}}
                <div class="">
                    @if (!$paginator->onFirstPage())
                        <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-dark">
                            {!! __('pagination.previous') !!}
                        </a>
                    @endif
                </div>
                {{-- next page btn --}}
                <div class="">
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-default">
                            {!! __('pagination.next') !!}
                        </a>
                    @endif
                </div>
            </div>

        </div>

    </nav>
@endif
