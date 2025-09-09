
@if ($paginator->hasPages())
    <div class="g-pagination col-xs-12">
        <ul class="d-flex justify-content-center pagination">
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="next"><i class="bi bi-chevron-right"></i></a></li>

            @foreach ($elements as $element)

                @if (is_string($element))

                    <li class="current"><strong>{{ $element }}</strong></li>
                @endif



                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="current"><a>{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach



            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="bi bi-chevron-left"></i></a></li>
            @else
                <li><strong><i class="la la-angle-double-left"></i></strong></li>
            @endif
        </ul>
    </div>
@endif
