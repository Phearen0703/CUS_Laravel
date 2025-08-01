@if (session()->has('status'))
    @if (session()->get('status')=='success')
            <div class="alert alert-success">{{session()->get(key: 'sms')}}</div>
        @elseif(session()->get('status')=='error')
            <div class="alert alert-danger">{{session()->get('sms')}}</div>
        @elseif(session()->get('status') == 'warning')
            <div class="alert alert-warning">{{session()->get('sms')}}</div>
        @else
            @foreach (session()->get('data')-> messages() as $sms )
                <div class="alert alert-warning">{{$sms[0]}}</div>
            @endforeach
    @endif
@endif