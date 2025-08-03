<?php use App\Helpers\Functions; ?>

@extends('admin.main-layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('MERCHANT') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Merchant</li>
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
        <!-- MERCHANT TABLE -->
        <div class="card">
              <div class="card-header border-transparent">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>

                <div class="d-flex flex-column">
                    <h3 class="card-title">Merchant Users</h3>
                    <a href="{{ route('pages.create_merchant') }}" class="pt-2">
                        <button class="btn btn-primary">Add Merchant</button>
                    </a>
                </div>
                Role: <span id="status-badgeRole" class="badge badge-pill fontcolor-white {{ Functions::userrole_color('Merchant') }}">Merchant</span>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-striped table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>User ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Created at</th>
                      <th>Update Record</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($merchant as $merchant)
                    <tr id="table_row_{{$merchant->id}}">
                        <td class="align-middle">{{$merchant->user_id}}</td>
                        <td class="align-middle">
                            <img src="{{ $merchant->profile_picture ? URL::to('/storage') . '/' . $merchant->profile_picture : asset('images/guest.jpg') }}" alt="Profile" class="table-avatar" onerror="this.onerror=null;this.src='{{ asset('images/guest.jpg') }}">
                            {{$merchant->name}}
                        </td>
                        <td class="align-middle">{{$merchant->email}}</td>
                        <td>
                            <input data-id="{{$merchant->id}}" class="approve_merchant" type="checkbox" data-onstyle="success" data-offstyle="warning" data-toggle="toggle" data-on="Activated" data-off="Inactive" {{ $merchant->status ? 'checked' : '' }}>
                        </td>
                        <td class="align-middle">{{ Functions::GetDateInterval($merchant->created_at)  === "More than a month ago" ? $merchant->created_at :  Functions::GetDateInterval($merchant->created_at)}}</td>
                        <td class="align-middle">
                            <a href="javascript:void(0)" onclick="delete_merchant('{{ $merchant->id }}')" class="btn btn-tool"><i class="fa fa-trash color-danger"></i></a>
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
          </div> <!-- /.card-body -->
          <!-- /.MERCHANT TABLE -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
