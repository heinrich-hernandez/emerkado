<?php
use App\Helpers\Functions;
use App\Helpers\CreatedAt;
?>

<!-- GET URL VARIABLES STATUS AND USER_ID -->
  @if (request()->query('status') === 'success' && request()->query('user_id'))
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    showSuccess("{{ request()->query('user_id') }} was successfully created!"); //SHOW SUCCESS MESSAGE VIA TOASTER.JS
  });
  </script>
  @endif

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
                        <button class="btn btn-primary">Registration</button>
                    </a>
                </div>
                Role: <span id="status-badgeRole" class="badge badge-pill fontcolor-white {{ Functions::userrole_color('Coop') }}">Merchant</span>
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
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($merchants as $merchants)
                    <tr>
                        <td class="align-middle">{{$merchants->user_id}}</td>
                        <td class="align-middle">
                            <img src="{{ $merchants->profile_picture ? URL::to('/storage') . '/' . $merchants->profile_picture : asset('images/guest.jpg') }}" alt="Profile" class="table-avatar" onerror="this.onerror=null;this.src='{{ asset('images/guest.jpg') }}">
                            {{$merchants->name}}
                        </td>
                        <td class="align-middle">{{$merchants->email}}</td>
                        <td class="align-middle">{{ Functions::GetDateInterval($merchants->created_at)  === "More than a week ago" ? $merchants->created_at :  Functions::GetDateInterval($merchants->created_at)}}</td>
                        <td class="align-middle">
                            <a href="javascript:void(0)" onclick="delete_merchants('{{ $merchants->id }}')" class="btn btn-tool"><i class="fa fa-trash color-danger"></i></a>
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
