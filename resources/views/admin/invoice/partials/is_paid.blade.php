@switch($invoice->is_paid)
    @case(1)
    <span class="badge bg-soft-success text-success ">PAID</span>
        @break
    @case(0)
    <span class="badge bg-soft-danger text-danger">PENDING</span>
        @break
    @default
        
@endswitch