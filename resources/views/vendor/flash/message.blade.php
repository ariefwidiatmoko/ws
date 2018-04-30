@foreach ((array) session('flash_notification') as $message)
@php $message = (array)$message[0]; @endphp
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div style="
          background-color: #bcd6b1 !important;
          border-color: #bde2af !important;
          color: #3c763d !important;
          margin-top: 5px;
          margin-left: 14px;
          margin-bottom: -30px;
          margin-right: 16px"
          class="alert alert-{{ $message['level'] }}
                    {{ $message['important'] ? 'alert-important' : '' }}"
                    role="alert"
        >
            @if ($message['important'])
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;</button>
            @endif

            {!! $message['message'] !!}
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
