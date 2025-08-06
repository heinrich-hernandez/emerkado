<?php use App\Helpers\Functions; ?>

@extends('merchant.main-layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('BUYER') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('merchant-dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Buyer</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div>
    <p>
        <span class="identity-clause">Logged In ID:</span> 
        {{Auth::user()->user_id; }}<br/>
    </p>
</div>

<br>
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

                                Role: <span id="status-badgeRole" class="badge badge-pill fontcolor-white {{ Functions::userrole_color('Buyer') }}">Buyer</span>
                            <!--div class="d-flex flex-column">
                                <h3 class="card-title">Buyer Users</h3>
                            </div-->
                        </div>
                        <div class="card-body p-0">
                            <div class="table-striped table-responsive">
                                <table class="table m-0" id="buyer_table">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Created at</th>
                                            <th>Review Status</th>
                                            <th>Update Record</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($buyer as $buyer)
                                            <tr id="table_row_{{$buyer->id}}">
                                                <td  class="align-middle">{{ $buyer->user_id }}</td>
                                                <td class="align-middle">
                                                    <img src="{{ $buyer->profile_picture ? URL::to('/storage') . '/' . $buyer->profile_picture : asset('images/guest.jpg') }}" alt="Profile" class="table-avatar" onerror="this.onerror=null;this.src='{{ asset('images/guest.jpg') }}">
                                                    {{ $buyer->name }}
                                                </td>
                                                <td class="align-middle">{{ $buyer->email }}</td>
                                                <td>
                                                    <input data-id="{{$buyer->id}}" class="merchant_approve_buyer" type="checkbox" data-onstyle="success {{ $buyer->review_status == 'Approved' ? '' : 'warning-disabled' }}" data-offstyle="warning {{ $buyer->review_status == 'Approved' ? '' : 'warning-disabled' }}" data-toggle="toggle" data-on="Activated" data-off="Inactive" {{ $buyer->status ? 'checked' : '' }} {{ $buyer->review_status == 'Approved' ? '' : 'disabled' }}>
                                                </td>
                                                <td class="align-middle">{{ Functions::GetDateInterval($buyer->created_at)  === "More than a month ago" ? $buyer->created_at :  Functions::GetDateInterval($buyer->created_at)}}</td>
                                                <td class="align-middle {{ Functions::review_status_color($buyer->review_status) }}"><i class="fas {{ Functions::review_status($buyer->review_status) }}"></i> {{ $buyer->review_status }}</td>
                                                <td class="align-middle">
                                                    <a href="{{ route('pages.review_buyer', $buyer->id ) }}" class="btn btn-tool"><i class="fas fa-pen"></i></a>
                                                    <a href="javascript:void(0)" onclick="delete_buyer('{{ $buyer->id }}')" class="btn btn-tool"><i class="fa fa-trash color-danger"></i></a>
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