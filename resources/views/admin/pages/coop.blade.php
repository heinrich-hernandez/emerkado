<?php use App\Helpers\Functions; ?>

@extends('admin.main-layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('COOP') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Coop</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

<!-- start -->
    <div class="table-striped table-responsive">
        <table class="table m-0">
            <thead>
            <tr>
                <th>REVIEW ID</th>
                <th>REVIEWER</th>
                <th>REVIEWER NAME</th>
                <th>ACCOUNT</th>
                <th>REVIEW DESCRIPTION</th>
                <th>DATE</th>
            </tr> 
            </thead>
            <tbody>
            @foreach($reviews as $review)
            <tr>
                <td>{{$review->review_id}}</td>
                <td>{{$review->reviewer_id}}</td>
                <td>{{$review->reviewer->name}}</td>
                <td>{{$review->account_id}}</td>
                <td>{{$review->review_description}}</td>
                <td>{{$review->date}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
<!-- end -->

<div style="float: right"><b>Current Logged In ID:</b> {{Auth::user()->user_id; }}</div>

<br><br><br>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools border-transparent">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>

                            <div class="d-flex flex-column">
                                <h3 class="card-title">Coop Users</h3>
                                <a href="{{ route('pages.create_coop') }}" class="pt-2">
                                    <button class="btn btn-primary">Add Coop</button>
                                </a>
                                </div>
                                Role: <span id="status-badgeRole" class="badge badge-pill fontcolor-white {{ Functions::userrole_color('Coop') }}">Coop</span>
                            <!--div class="d-flex flex-column">
                                <h3 class="card-title">Coop Users</h3>
                            </div-->
                        </div>
                        <div class="card-body p-0">
                            <div class="table-striped table-responsive">
                                <table class="table m-0" id="coop_table">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Authorized Representative</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Created at</th>
                                            <th>Review Status</th>
                                            <th>Update Record</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coop as $coop)
                                            <tr id="table_row_{{$coop->id}}">
                                                <td  class="align-middle">{{ $coop->user_id }}</td>
                                                <td class="align-middle">
                                                    <img src="{{ $coop->profile_picture ? URL::to('/storage') . '/' . $coop->profile_picture : asset('images/guest.jpg') }}" alt="Profile" class="table-avatar" onerror="this.onerror=null;this.src='{{ asset('images/guest.jpg') }}">
                                                    {{ $coop->authorized_representative }}
                                                </td>
                                                <td class="align-middle">{{ $coop->email }}</td>
                                                <td>
                                                    <input data-id="{{$coop->id}}" class="approve_coop" type="checkbox" data-onstyle="success {{ $coop->review_status == 'Approved' ? '' : 'warning-disabled' }}" data-offstyle="warning {{ $coop->review_status == 'Approved' ? '' : 'warning-disabled' }}" data-toggle="toggle" data-on="Activate" data-off="Deactivate" {{ $coop->status ? 'checked' : '' }} {{ $coop->review_status == 'Approved' ? '' : 'disabled' }}>
                                                </td>
                                                <!-- <td class="align-middle"><span id="status-badgeStatus" class="badge badge-pill {{ Functions::status_color($coop->status) }} status-{{ $coop->user_id }}">{{ $coop->status }}</span></td> -->
                                                <td class="align-middle">{{ Functions::GetDateInterval($coop->created_at)  === "More than a week ago" ? $coop->created_at :  Functions::GetDateInterval($coop->created_at)}}</td>
                                                <td class="align-middle {{ Functions::review_status_color($coop->review_status) }}"><i class="fas {{ Functions::review_status($coop->review_status) }}"></i> {{ $coop->review_status }}</td>
                                                <td class="align-middle">
                                                    <a href="{{ route('pages.review_coop', $coop->id ) }}" class="btn btn-tool"><i class="fas fa-pen"></i></a>
                                                    <a href="javascript:void(0)" onclick="delete_coop('{{ $coop->id }}')" class="btn btn-tool"><i class="fa fa-trash color-danger"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
