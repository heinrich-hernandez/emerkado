<?php use App\Helpers\Functions; ?>

@extends('coop.main-layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('coop-dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Profile</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
        
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showError('Error processing coop record.'); //SHOW WARNING MESSAGE VIA TOASTER.JS
            });
        </script>
        <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

 

    <!-- Main content -->
    <div class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ $coop->profile_picture ? URL::to('/storage') . '/' . $coop->profile_picture : asset('images/guest.jpg') }}" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ $coop->authorized_representative }}</h3>

                <p class="text-muted text-center">{{ $coop->name }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Account Created</b> <a class="float-right">{{ $coop->created_at->format('d/m/Y') }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Account Activation</b> <a class="float-right">{{ $coop->status ? 'Activated' : 'For Activation' }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Account Status</b> <a class="float-right">{{ $coop->review_status == 'For Review' ? 'Unassigned' : $coop->review_status }}</a>
                  </li>
                </ul>
                <!-- <textarea class="form-control form-control-sm" type="text" placeholder="Type a comment"></textarea>
                <br>
                <a href="#" class="btn btn-primary btn-block"><b>SEND REVIEW</b></a> -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Coop</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

                <p class="text-muted">
                {{ $coop->email }}
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>

                <p class="text-muted">{{ $coop->address }}</p>

                <hr>

                <strong><i class="fas fa-phone mr-1"></i> Contact Number</strong>

                <p class="text-muted">{{ $coop->contact_number }}</p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Business Description</strong>

                <p class="text-muted">{{ $coop->business_description }}</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                  <livewire:notification />
                  <li class="nav-item"><a class="nav-link" href="#information" data-toggle="tab">Information</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    @if($coop->review_status !='Approved')
                    <div class="post">
                      <div class="banner-review"><img src="{{asset('images/banner-design-review.png') }}" alt="user image"></div>
                      <div class="user-block account-review">
                        <h5>This account is <b>FOR REVIEW</b>.  You may contact our support team for urgent account activation or call us at&nbsp;&nbsp;<i class="fas fa-phone fa-2xs"></i> +63 994 566 301.</h5>
                        <h4><b>Dear {{ $coop->username }}</b>,</h4>
                        <br/>
                        For added security, our system requires a thorough check of all accounts. This process ensures that each account is verified and meets our security standards. You may experience a brief delay in accessing certain features. We appreciate your patience as we work to keep your account secure.
                        <br/><br/>
                        Please review your account information provided below:
                        <br/><br/>
                      <div class="active tab-pane" id="activity" >
                        <table class="table table-bordered table-striped">
                        <tr>
                            <th></th>
                            <th style="width: 40px"></th>
                            <th></th>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">ID</td>
                            <td>:</td>
                            <td>{{ $coop->user_id }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Authorized Representative&nbsp;&nbsp;</td>
                            <td>:</td>
                            <td>{{ $coop->authorized_representative }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Coop Name</td>
                            <td>:</td>
                            <td>{{ $coop->name }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Address</td>
                            <td>:</td>
                            <td>{{ $coop->address }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Contact Number</td>
                            <td>:</td>
                            <td>{{ $coop->contact_number }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Email</td>
                            <td>:</td>
                            <td>{{ $coop->email }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Username</td>
                            <td>:</td>
                            <td>{{ $coop->username }}</td>
                          </tr>
                          @if($coop->agency_affiliation =='yes')
                          <tr>
                            <td style="font-weight: 800;">Agency Affiliation Name</td>
                            <td>:</td>
                            <td>{{ $coop->agency_affiliation_name }}</td>
                          </tr>
                          @endif
                          <tr>
                            <td style="font-weight: 800;">Account Created</td>
                            <td>:</td>
                            <td>{{ $coop->created_at->format('d/m/Y') }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Business Description</td>
                            <td>:</td>
                            <td>{{ $coop->business_description }}</td>
                          </tr>
                        </table>
                      </div>
                      <br/><br/>
                      <i>To edit your account information, you may access the <b>"Information"</b> tab provided on the top of this form.</i>
                      <div class="banner-review-bottom"><img src="{{asset('images/banner-design-review-line.png') }}" alt="banner image"></div>
                      </div>
                      <!-- /.user-block -->
                    </div> 
                    @else
                    <div class="post">
                      <div class="banner-review-bottom"><img src="{{asset('images/banner-design.png') }}" alt="user image"></div>
                      <div class="user-block account-approved">
                        <h5>This account is <b>ACTIVATED</b>. You may now log in to access your account.</h5>
                        <h4><b>Dear {{ $coop->username }}</b>,</h4>
                        <br/>
                        Your account has been successfully <b>APPROVED.</b> Account verification has been completed, You may now access all features and functionalities. Thank you for your cooperation!
                        <br/><br/>
                        Please review your account information provided below:
                        <br/><br/>
                        <table>
                        <tr>
                            <th></th>
                            <th style="width: 40px"></th>
                            <th></th>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">ID</td>
                            <td>:</td>
                            <td>{{ $coop->user_id }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Authorized Representative&nbsp;&nbsp;</td>
                            <td>:</td>
                            <td>{{ $coop->authorized_representative }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Coop Name</td>
                            <td>:</td>
                            <td>{{ $coop->name }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Address</td>
                            <td>:</td>
                            <td>{{ $coop->address }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Contact Number</td>
                            <td>:</td>
                            <td>{{ $coop->contact_number }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Email</td>
                            <td>:</td>
                            <td>{{ $coop->email }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Username</td>
                            <td>:</td>
                            <td>{{ $coop->username }}</td>
                          </tr>
                          @if($coop->agency_affiliation =='yes')
                          <tr>
                            <td style="font-weight: 800;">Agency Affiliation Name</td>
                            <td>:</td>
                            <td>{{ $coop->agency_affiliation_name }}</td>
                          </tr>
                          @endif
                          <tr>
                            <td style="font-weight: 800;">Account Created</td>
                            <td>:</td>
                            <td>{{ $coop->created_at->format('d/m/Y') }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Business Description</td>
                            <td>:</td>
                            <td>{{ $coop->business_description }}</td>
                          </tr>
                        </table>
                      <br/><br/>
                      <i>Please log in to continue. For additional inquiry may contact our support team at&nbsp;&nbsp;<i class="fas fa-phone fa-2xs"></i> +63 994 566 301.</i><br/>
                      <div class="banner-review-bottom"><img src="{{asset('images/banner-design-line.png') }}" alt="user image"></div>
                      </div>
                      <!-- /.user-block -->
                    </div>
                    @endif
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
              
                  <div class="tab-pane " id="notification">
                  </div>
              
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="information">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@endsection

