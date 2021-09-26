@switch($room->status)
    @case('vacant')
    <span class="badge bg-danger text-white p-1">VACANT</span>
        @break
    @case('occupied')
    <span class="badge bg-success text-white  p-1">OCCUPIED</span>
        @break
    @case('unavailable')
    <span class="badge bg-secondary text-white p-1">UNAVAILABLE</span>
        @break
    @default
   
@endswitch

