@if ($paginator->hasPages())
  <ul class="pagination pagination-sm pull-right">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
      <li class="disabled"><a href="#">First</a></li>
      <li class="disabled"><a href="#">Previous</a></li>
    @else
      <li><a href="{{ $paginator->url('1') }}">First</a></li>
      <li><a href="{{ $paginator->previousPageUrl() }}">Previous</a></li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li><a>{{ $element }}</a></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="disabled"><a style="background-color: #3c8dbc; color: white;">{{ $page }}</a></li>
                @else
                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach
    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())

        <li><a href="{{ $paginator->nextPageUrl() }}">Next</a></li>
    @else
        <li class="disabled"><a>Next</a></li>
    @endif
  </ul>
@endif
