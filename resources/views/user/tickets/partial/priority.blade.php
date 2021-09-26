@switch($ticket->priority)
    @case('low')
    <span class="badge bg-soft-secondary text-secondary">Low</span>
        @break
    @case('medium')
    <span class="badge bg-soft-warning text-warning">Medium</span>
        @break
    @case('high')
    <span class="badge bg-soft-danger text-danger">High</span>
        @break
    @default
        
@endswitch