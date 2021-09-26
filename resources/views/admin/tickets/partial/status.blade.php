@switch($ticket->status)
    @case('open')
    <span class="badge badge-success">Open</span>
        @break
    @case('closed')
    <span class="badge badge-secondary">Closed</span>
        @break
    @default
        
@endswitch