@if (session('status'))
    @php $status = session('status'); @endphp

    @if ($status === 'success')
        <div class="alert alert-success">{{ session('sms') }}</div>
    @elseif ($status === 'error')
        <div class="alert alert-danger">{{ session('sms') }}</div>
    @elseif ($status === 'warning')
        <div class="alert alert-warning">{{ session('sms') }}</div>
    @else
        @foreach (session('data')->messages() as $sms)
            <div class="alert alert-warning">{{ $sms[0] }}</div>
        @endforeach
    @endif
@endif
