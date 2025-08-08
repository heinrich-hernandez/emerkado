<?php use App\Helpers\Functions; ?>

@extends('merchant.main-layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Review Buyer Profile') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('merchant-dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('merchant.pages.buyer') }}">Buyer</a></li>
                        <li class="breadcrumb-item active">Review</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
        
    <div class="d-flex align-items-center">
      <div>
        <p>
          <span class="identity-clause">Logged In ID:</span> 
          {{Auth::user()->user_id; }}<br/>
        </p>
      </div>
      <div class="ml-auto">
        <a href="javascript:void(0)"
          class="btn {{ $buyer->review_status == 'For Review' ? 'btn-danger' : ($buyer->review_status == 'In Progress' ? 'btn-warning' : 'btn-success') }} approval-button fw-bolder " 
          data-toggle="modal"
          data-target="#modal-default">
            <!-- Approval : {{ $buyer->review_status == 'For Review' ? 'Unassigned' : $buyer->review_status }} -->
            Approval : {{ $buyer->review_status }}
        </a>
      </div>
    </div>  
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showError('Error processing merchant record.'); //SHOW WARNING MESSAGE VIA TOASTER.JS
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

 
<!-- Modal -->
<form action="{{ route('merchant.approved.review_buyer', $buyer->id ) }}" method="post" enctype="multipart/form-data">
@csrf
  <div class="modal fade" id="modal-default" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-userapproval">
      <div class="modal-content modal-userapproval">
        <!-- Modal left: Image section -->
        <div class="modal-left">
          <img src="{{asset('images/magnifying-approval.png') }}" alt="Magnifying Glass">
        </div>

        <!-- Modal right: Form section -->
        <div class="modal-right">
          <div class="modal-header modal-userapproval">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <span class="modal-title" id="approvalModalLabel">Submit for approval?</span>
          <p>Account will be denied if any of the following conditions are met:</p>
          <div class="modal-body modal-userapproval">
              <div class="form-check modal-checklist">
                <input class="form-check-input check-item" type="checkbox" id="subCampaign1">
                <label class="form-check-label" for="subCampaign1">Does not adhere proper naming convention</label>
              </div>
              <div class="form-check modal-checklist">
                <input class="form-check-input check-item" type="checkbox" id="subCampaign2">
                <label class="form-check-label" for="subCampaign2">Name does not match with the provided identification</label>
              </div>
              <div class="form-check modal-checklist">
                <input class="form-check-input check-item" type="checkbox" id="subCampaign3">
                <label class="form-check-label" for="subCampaign3">No valid ID (e.g., government-issued ID, passport, driver’s license)</label>
              </div>
              <div class="form-check modal-checklist">
                <input class="form-check-input check-item" type="checkbox" id="subCampaign4">
                <label class="form-check-label" for="subCampaign4">Username does not meet platform guidelines</label>
              </div>
              <div class="form-check modal-checklist">
                <input class="form-check-input check-item" type="checkbox" id="subCampaign5">
                <label class="form-check-label" for="subCampaign5">Account History has been reviewed (user had previous account)</label>
              </div>
              <div class="form-check modal-checklist">
                <input class="form-check-input check-item" type="checkbox" id="subCampaign6">
                <label class="form-check-label" for="subCampaign6">Flags or Suspicious Activity (e.g., fraudulent attempts, previous bans)</label>
              </div>
          </div>
          <p style="margin-top: 10px; font-style: italic"></p>
          <div class="modal-footer modal-userapproval">
            <button type="submit" class="btn btn-danger" id="denied-account-modal" name="denied-account-modal" style="display: none;"><i class="fas fa-trash"></i> DENY ACCOUNT (<span id="checked-count">0</span>) </button>
            <button type="submit" class="btn btn-success" id="approved-account-modal" name="approved-account-modal"><i class="fas fa-check"></i> APPROVED ACCOUNT</button>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<!-- /.modal -->

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
                       src="{{ $buyer->profile_picture ? URL::to('/storage') . '/' . $buyer->profile_picture : asset('images/guest.jpg') }}" alt="User profile picture">
                </div>

                <p class="text-muted text-center">{{ $buyer->name }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Account Created</b> <a class="float-right">{{ $buyer->created_at->format('d/m/Y') }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Account Activation</b> <a class="float-right">{{ $buyer->status ? 'Activated' : 'For Activation' }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Account Status</b> <a class="float-right">{{ $buyer->review_status == 'For Review' ? 'Unassigned' : $buyer->review_status }}</a>
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
                <h3 class="card-title">About Buyer</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

                <p class="text-muted">
                {{ $buyer->email }}
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>

                <p class="text-muted">{{ $buyer->address }}</p>

                <hr>

                <strong><i class="fas fa-phone mr-1"></i> Contact Number</strong>

                <p class="text-muted">{{ $buyer->contact_number }}</p>

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
                  <li class="nav-item"><a class="nav-link" href="#notification" data-toggle="tab">Notification</a></li>
                  <li class="nav-item"><a class="nav-link" href="#information" data-toggle="tab">Information</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content" id="information">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    @if($buyer->review_status !='Approved')
                    <div class="post">
                      <div class="banner-review"><img src="{{asset('images/banner-design-review.png') }}" alt="user image"></div>
                      <div class="user-block account-review">
                        <h5>This account is <b>FOR REVIEW</b>.  You may contact our support team for urgent account activation or call us at&nbsp;&nbsp;<i class="fas fa-phone fa-2xs"></i> +63 994 566 301.</h5>
                        <h4><b>Dear {{ $buyer->username }}</b>,</h4>
                        <br/>
                        For added security, our system requires a thorough check of all accounts. This process ensures that each account is verified and meets our security standards. You may experience a brief delay in accessing certain features. We appreciate your patience as we work to keep your account secure.
                        <br/><br/>
                        Please review your account information provided below:
                        <br/><br/>
                      <div class="active tab-pane" id="information" >
                        <table class="table table-bordered table-striped">
                        <tr>
                            <th></th>
                            <th style="width: 40px"></th>
                            <th></th>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">ID</td>
                            <td>:</td>
                            <td>{{ $buyer->user_id }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Buyer Name</td>
                            <td>:</td>
                            <td>{{ $buyer->name }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Address</td>
                            <td>:</td>
                            <td>{{ $buyer->address }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Contact Number</td>
                            <td>:</td>
                            <td>{{ $buyer->contact_number }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Email</td>
                            <td>:</td>
                            <td>{{ $buyer->email }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Username</td>
                            <td>:</td>
                            <td>{{ $buyer->username }}</td>
                          </tr>
                          @if($buyer->agency_affiliation =='yes')
                          <tr>
                            <td style="font-weight: 800;">Agency Affiliation Name</td>
                            <td>:</td>
                            <td>{{ $buyer->agency_affiliation_name }}</td>
                          </tr>
                          @endif
                          <tr>
                            <td style="font-weight: 800;">Account Created</td>
                            <td>:</td>
                            <td>{{ $buyer->created_at->format('d/m/Y') }}</td>
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
                        <h4><b>Dear {{ $buyer->username }}</b>,</h4>
                        <br/>
                        Your account has been successfully <b>APPROVED.</b> Account verification has been completed, You may now access all features and functionalities. Thank you for your buyereration!
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
                            <td>{{ $buyer->user_id }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Buyer Name</td>
                            <td>:</td>
                            <td>{{ $buyer->name }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Address</td>
                            <td>:</td>
                            <td>{{ $buyer->address }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Contact Number</td>
                            <td>:</td>
                            <td>{{ $buyer->contact_number }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Email</td>
                            <td>:</td>
                            <td>{{ $buyer->email }}</td>
                          </tr>
                          <tr>
                            <td style="font-weight: 800;">Username</td>
                            <td>:</td>
                            <td>{{ $buyer->username }}</td>
                          </tr>
                          @if($buyer->agency_affiliation =='yes')
                          <tr>
                            <td style="font-weight: 800;">Agency Affiliation Name</td>
                            <td>:</td>
                            <td>{{ $buyer->agency_affiliation_name }}</td>
                          </tr>
                          @endif
                          <tr>
                            <td style="font-weight: 800;">Account Created</td>
                            <td>:</td>
                            <td>{{ $buyer->created_at->format('d/m/Y') }}</td>
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
              <div class="tab-pane" id="notification">
              <!-- /.card-header -->
              
              <div class="mailbox-read-info">
                <h5>Compose New Message</h5>
                <h6>To: {{ $buyer->name }}
                  <span class="mailbox-read-time float-right">15 Feb. 2015 11:03 PM</span></h6>
              </div>
              <div class="card-body">
                
                <div class="form-group">
                  <input class="form-control" placeholder="Subject:">
                </div>
                <div class="form-group">
                    <textarea id="compose-textarea" class="form-control" style="height: 300px">
                      <h1><u>Heading Of Message</u></h1>
                      <h4>Subheading</h4>
                      <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain
                        was born and I will give you a complete account of the system, and expound the actual teachings
                        of the great explorer of the truth, the master-builder of human happiness. No one rejects,
                        dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know
                        how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again
                        is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain,
                        but because occasionally circumstances occur in which toil and pain can procure him some great
                        pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise,
                        except to obtain some advantage from it? But who has any right to find fault with a man who
                        chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that
                        produces no resultant pleasure? On the other hand, we denounce with righteous indignation and
                        dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so
                        blinded by desire, that they cannot foresee</p>
                      <ul>
                        <li>List item one</li>
                        <li>List item two</li>
                        <li>List item three</li>
                        <li>List item four</li>
                      </ul>
                      <p>Thank you,</p>
                      <p>John Doe</p>
                    </textarea>
                </div>
                <div class="form-group">
                  <div class="btn btn-default btn-file">
                    <i class="fas fa-paperclip"></i> Attachment
                    <input type="file" name="attachment">
                  </div>
                  <p class="help-block">Max. 32MB</p>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-right">
                  <button type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Draft</button>
                  <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                </div>
                <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
              </div>
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

