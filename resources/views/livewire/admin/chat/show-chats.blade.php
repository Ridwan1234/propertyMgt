<div>
    <div class="row">
        <!-- start chat users-->
        <div class="col-xl-3 col-lg-4">
            <div class="card">
                <div class="card-body">

                    <div class="media mb-3">
                        <img src="{{ asset('assets/images/users/1.jpg')}}" class="mr-2 rounded-circle" width="42"
                             height="42" alt="Profile picture">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 font-15">
                                <p class="text-reset">{{ auth()->user()->name}}</p>
                            </h5>
                            <p class="mt-1 mb-0 text-muted font-14">
                                <small class=""></small> {{ auth()->user()->roles->first()->display_name}}
                            </p>
                        </div>
                        <div>
                            {{-- <a href="javascript: void(0);" wire:click="$refresh" class="text-reset font-20">
                                <i class="mdi mdi-refresh"></i>
                            </a> --}}
                        </div>
                    </div>

                    <!-- start search box -->
                    <div class="search-bar mb-3">
                        <div class="position-relative">
                            <input type="text" class="form-control form-control-light" wire:model="searchTerm"
                                   placeholder="Search contacts...">
                            <span class="mdi mdi-magnify"></span>
                        </div>
                    </div>
                    <!-- end search box -->

                    <h6 class="font-13 text-muted text-uppercase mb-2">Contacts</h6>


                    <div style="height:375;overflow: auto; max-height:375px;" data-simplebar>
                        <div class="list-group list-group-flush">


                            @forelse ($users as $user)
                                {{-- <a wire:click="showChats({{ $user->id}})">
                                <div class="media p-2  {{ $senderId ==$user->id ? 'bg-light':'' }} ">
                                    <img src="{{ asset('assets/images/users/1.jpg')}}" class="mr-2 rounded-circle"
                                        height="38" width="38" alt="Brandon Smith" />
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-0 font-14">
                                            <span class="float-right text-muted font-weight-normal font-12">4:30am</span>
                                            {{ $user->name }}
                                        </h5>
                                        <p class="mt-1 mb-0 text-muted font-14">
                                            <span class="w-25 float-right text-right">

                                                @if ($user->unread_replies_count > 0)
                                                <span
                                                    class="badge badge-soft-danger">{{ $user->unread_replies_count}}</span>
                                                @endif


                                            </span>
                                            <span class="w-75">{{ Str::words($user->latestReply->message ?? '',3)
                                                }}</span>
                                        </p>
                                    </div>
                                </div>
                                </a> --}}

                                <a href="javascript:void(0);" wire:click="showChats('{{$user->id}}')"
                                   class="list-group-item list-group-item-action ">
                                    <div class="media">
                                        <img src="{{ asset('assets/images/users/1.jpg')}}" class="mr-2 rounded-circle"
                                             height="32" width="32" alt="Brandon Smith"/>
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-0 font-14">

                                            <span class="float-right text-muted font-weight-normal font-12">

                                                {{ $user->latestReply ? \Carbon\Carbon::parse($user->latestReply->created_at)->format('g:i A'): '' }}
                                            </span>
                                                {{ $user->name }}
                                            </h5>
                                            <p class="mt-1 mb-0 text-muted font-14">
                                            <span class="w-25 float-right text-right">

                                                @if ($user->unread_replies_count > 0)
                                                    <span
                                                        class="badge badge-soft-danger">{{ $user->unread_replies_count}}</span>
                                                @endif


                                            </span>
                                                <span class="w-75">{{ Str::words($user->latestReply->message ?? '',3)
                                                }}</span>
                                            </p>
                                        </div>
                                    </div>

                                </a>
                            @empty

                            @endforelse

                        </div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <!-- end chat users-->

        <!-- chat area -->
        <div class="col-xl-9 col-lg-8">

            <div class="card">
                <div class="card-body py-2 px-3 border-bottom border-light">
                    <div class="media py-1">
                        {{-- <img src="{{ asset('assets/images/users/1.jpg')}}" class="mr-2 rounded-circle" height="36"
                        width="36" alt="Brandon Smith"> --}}
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 font-15">
                                <span class="text-reset">{{ $senderName}}</span>
                            </h5>
                            <p class="mt-1 mb-0 text-muted font-12">
                                <small class=""></small> {{ $senderRole}}
                            </p>
                        </div>
                        <div>

                            <div wire:loading wire:target="showChats"
                                 class="spinner-border spinner-border-sm text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>

                            @if (!empty($senderRole))
                                <a href="javascript: void(0);" wire:click="triggerDelete"
                                   class="text-reset font-19 py-1 px-2 d-inline-block" data-toggle="tooltip"
                                   data-placement="top" title="" data-original-title="Delete Chat">
                                    <i class="fe-trash-2"></i>
                                </a>
                            @endif


                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="conversation-list" wire:poll.7000ms="getUserChats" data-simplebar
                        style="max-height:460px;overflow:auto;">

                        @forelse ($userMessages as $item)

                            <li class="clearfix {{ $item->sender_id==auth()->id() ? 'odd':'' }} ">
                                <div class="chat-avatar">
                                    <i>{{ $item->created_at->diffForHumans(null,true,true)}}</i>
                                </div>
                                <div class="conversation-text">
                                    <div class="ctext-wrap">
                                        <i>{{ $item->sender_id==auth()->id() ? 'ME':$senderName }}</i>
                                        <p>
                                            {{ $item->message}}
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @empty

                        @endforelse

                    </ul>

                    @if (!empty($senderRole))
                        <div class="row">
                            <div class="col">
                                <div class="mt-2 bg-light p-3 rounded">

                                    <div class="row">
                                        <div class="col mb-2 mb-sm-0">
                                            <input type="text" class="form-control border-0"
                                                   placeholder="Enter your text"
                                                   required="" wire:model.defer="replyMessage">

                                            @error('replyMessage')
                                            <span class="text-danger">
                                            Please enter your messsage
                                        </span>
                                            @enderror

                                        </div>
                                        <div class="col-sm-auto">

                                            <div class="btn-group">

                                                <button wire:loading.attr="disabled"
                                                        class="btn btn-success chat-send btn-block"
                                                        wire:click="sendReply">


                                                    <div wire:loading wire:target="sendReply"
                                                         class="spinner-border spinner-border-sm" role="status">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>

                                                    <i class='fe-send'></i>
                                                </button>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row-->

                                </div>
                            </div> <!-- end col-->
                        </div>
                @endif






                <!-- end row -->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div>
        <!-- end chat area-->
    </div>

</div>
