<div class="avatar avatar-online">
    @if(isset($avatar))
        <img src="{{asset('assets/')}}{{$avatar}}" alt="{{$name ?? ''}}" class="w-px-40 h-auto rounded-circle">
    @else
        <span class="avatar-initial rounded-circle bg-label-success">{{$iniciales ?? 'N/A' }}</span>  
    @endif
</div>