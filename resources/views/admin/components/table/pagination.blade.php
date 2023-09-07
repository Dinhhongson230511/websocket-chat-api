@if($paginator->hasPages())
    <div class="row mt-4">
        <div class="col-12">
            <div>
                <ul class="pagination text justify-content-end flex-wrap mb-0">
                    {{-- Previous Page Link --}}
                    <li @class(['paginate_button page-item', 'disabled' => $paginator->onFirstPage()])>
                        <a href="{{ $paginator->previousPageUrl()  }}" class="page-link">@lang('pagination.previous')</a>
                    </li>

                    {{-- Pagination Elements --}}
                    @foreach($elements as $element)
                        {{-- Three Dots Separator --}}
                        @if (is_string($element))
                            <li class="paginate_button page-item disabled">
                                <span class="page-link">{{ $element }}</span>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if(is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page === $paginator->currentPage())
                                    <li class="paginate_button page-item active">
                                        <span class="page-link" href="{{ $url }}">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="paginate_button page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    <li @class(['paginate_button page-item', 'disabled' => !$paginator->hasMorePages()])>
                        <a href="{{ $paginator->nextPageUrl()  }}" class="page-link">@lang('pagination.next')</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endif
