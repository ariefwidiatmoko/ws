@if ($paginator->hasPages())
<div class="dataTables_paginate fg-buttonset ui-buttonset fg-buttonset-multi ui-buttonset-multi paging_full_numbers" id="DataTables_Table_0_paginate">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
          <a tabindex="0" class="first ui-corner-tl ui-corner-bl fg-button ui-button ui-state-default ui-state-disabled" id="DataTables_Table_0_first">First</a>
          <a tabindex="0" class="previous fg-button ui-button ui-state-default ui-state-disabled" id="DataTables_Table_0_previous">Previous</a>
        @else
          <a href="{{ $paginator->url('1') }}" rel="prev" tabindex="0" class="first ui-corner-tl ui-corner-bl fg-button ui-button ui-state-default" id="DataTables_Table_0_first">First</a>
          <a href="{{ $paginator->previousPageUrl() }}" rel="prev" tabindex="0" class="previous fg-button ui-button ui-state-default" id="DataTables_Table_0_previous">Previous</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a tabindex="0" class="fg-button ui-button ui-state-default">{{ $element }}</a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a tabindex="0" class="fg-button ui-button ui-state-default ui-state-disabled">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}" tabindex="0" class="fg-button ui-button ui-state-default">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" tabindex="0" class="next fg-button ui-button ui-state-default" id="DataTables_Table_0_next">Next</a>
        @else
            <a tabindex="0" class="next fg-button ui-button ui-state-disabled" id="DataTables_Table_0_next">Next</a>
        @endif
    </div>
@endif
