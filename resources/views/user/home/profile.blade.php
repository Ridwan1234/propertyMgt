@extends('layout.user')

@section('content')

<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    
                </div>
                <h4 class="page-title">My Profile</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <!-- Form row -->
    <div class="row">
        <div class="col-lg-4 col-xl-4">
            <div class="card-box text-center">
                <img src="{{ asset('assets/images/users/1.jpg')}}" class="rounded-circle avatar-lg img-thumbnail"
                    height="44" width="44" alt="profile-image">

                <h4 class="mb-0">{{ auth()->user()->name}}</h4>
                <p class="text-muted"> {{ auth()->user()->roles->first()->display_name}}</p>

                <div class="text-left mt-3">
                    <h4 class="font-13 text-uppercase">About Me :</h4>

                    <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span
                            class="ml-2">{{ auth()->user()->name}}</span></p>



                    <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span
                            class="ml-2 ">{{ auth()->user()->email}}</span></p>

                    <p class="text-muted mb-1 font-13"><strong>Registered On :</strong> <span
                            class="ml-2">{{ auth()->user()->created_at->diffForHumans()}}</span></p>
                </div>


            </div> <!-- end card-box -->

        </div> <!-- end col-->

        <div class="col-lg-8 col-xl-8">
            <!-- end card-box-->

            @livewire('admin.user.profile')
        </div> <!-- end col -->
    </div>
    <!-- end row-->

    <!-- end row -->


    <!-- end row-->

</div>

@endsection