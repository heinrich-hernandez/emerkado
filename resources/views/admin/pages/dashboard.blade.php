<?php use App\Helpers\Functions; ?>
@extends('admin.main-layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('DASHBOARD') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>System End-Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-monitor"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53</h3>

                <p>New Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-people"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>Waiting Approval</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Disapproved</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-trash"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

        
        <!-- TABLE: DASHBOARD -->
        <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">System Users</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-striped table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>User ID</th>
                      <th>Name</th>
                      <th>User Role</th>
                      <th>Status</th>
                      <!-- <th>View Profile</th> -->
                    </tr> 
                    </thead>
                    <tbody>
                    @foreach($users as $column)
                    <tr>
                        <td>{{$column->user_id}}</td>
                        <td>{{$column->name}}</td>
                        <td><span id="status-badgeRole" class="badge badge-pill {{ Functions::userrole_color($column->user_role) }}">{{$column->user_role}}</span></td>
                        <td><span id="status-badgeStatus" class="badge badge-pill {{ Functions::status_color($column->status) }}">{{ $column->status ? 'Activated' : 'Deactivated' }}</span></td>
                        <!-- <td class="align-middle"><i class="fas fa-search"></i></td> -->
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
          </div> <!-- /.card-body -->
          <!-- END TABLE: DASHBOARD -->

        </div>
    </div><!-- /.container-fluid -->
    <!-- /.content -->
@endsection