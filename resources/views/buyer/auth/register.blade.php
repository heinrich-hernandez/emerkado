@extends('layouts.guest')

@section('content')
<body class="hold-transition login-page layout-fixed">
    <div>
        <div class="login-logo">
            <a href="/">{{ config('app.name', 'eMerkado') }}</a>
        </div>
        <!-- /.login-logo -->
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // This assumes you have a 'showError' function available globally (e.g., from toaster.js or a custom script)
                showError('Error processing buyer registration. Please check the form for details.');
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
    <section class="content-header" style="padding-bottom: 0.2rem;">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1>{{ __('Buyer Registration') }}</h1>
            </div>
            <div>
                <p class="text-muted" style="margin-bottom: 0.2rem; ">{{ __('Join our platform as a Buyer! Fill out the form below to register yourself and gain access to exclusive features tailored for buyers.') }}</p>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // This assumes you have a 'showError' function available globally (e.g., from toaster.js or a custom script)
                showError('Error processing buyer registration. Please check the form for details.');
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
    <div class="bd-content">
        <div class="container-fluid">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4>{{ __('Register New Buyer Account') }}</h4>
                        </div>
                        {{-- The form action should point to the specific POST route for buyer registration --}}
                        <form id="buyerForm" action="{{ route('buyer.auth.register') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{-- @method('post') is not needed for a standard POST form --}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-row">
                                            <div class="col-12 md-3">
                                                <div class="form-group">
                                                    <label for="buyer_name">{{ __('Buyer Name') }}</label>
                                                    <input type="text" class="form-control {{ $errors->has('buyer_name') ? 'is-invalid' : '' }}" value="{{ old('buyer_name') }}" id="buyer_name" aria-describedby="buyer_name" name="buyer_name">
                                                    <div class="error-container text-danger mt-1" style="font-size: 12px;">
                                                    <p class="text-danger">
                                                        @error('buyer_name')
                                                            {{ $message }}
                                                        @enderror
                                                    </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Address') }}</label>
                                                    <input type="text" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" value="{{ old('address') }}" id="address" aria-describedby="address" name="address">
                                                    <div class="error-container text-danger mt-1" style="font-size: 12px;">
                                                    <p class="text-danger">
                                                        @error('address')
                                                            {{ $message }}
                                                        @enderror
                                                    </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="contact_number">{{ __('Contact Number') }}</label>
                                                    <input type="text" class="form-control {{ $errors->has('contact_number') ? 'is-invalid' : '' }}" value="{{ old('contact_number') }}" id="contact_number" aria-describedby="contact_number" name="contact_number">
                                                    <div class="error-container text-danger mt-1" style="font-size: 12px;">
                                                    <p class="text-danger">
                                                        @error('contact_number')
                                                            {{ $message }}
                                                        @enderror
                                                    </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="email">{{ __('Email Address') }}</label>
                                                    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" id="email" aria-describedby="email" name="email">
                                                    <div class="error-container text-danger mt-1" style="font-size: 12px;">
                                                    <p class="text-danger">
                                                        @error('email')
                                                            {{ $message }}
                                                        @enderror
                                                    </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12">
                                                <label for="buyer_profile_picture">{{ __('Profile Picture') }}</label>
                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="buyer_profile_picture" name="buyer_profile_picture">
                                                        <label class="custom-file-label" for="buyer_profile_picture" aria-describedby="buyer_profile_picture">{{ __('Choose File') }}</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="buyer_profile_picture">{{ __('Upload') }}</span>
                                                    </div>
                                                </div>
                                                @error('buyer_profile_picture')
                                                <div class="error-container text-danger mt-1" style="font-size: 12px;">
                                                    <p class="text-danger">{{ $message }}</p>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12">
                                                <label for="buyer_valid_id_picture">{{ __('Valid ID Picture') }}</label>
                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="buyer_valid_id_picture" name="buyer_valid_id_picture">
                                                        <label class="custom-file-label" for="buyer_valid_id_picture" aria-describedby="buyer_valid_id_picture">{{ __('Choose File') }}</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="buyer_valid_id_picture">{{ __('Upload') }}</span>
                                                    </div>
                                                </div>
                                                @error('buyer_valid_id_picture')
                                                <div class="error-container text-danger mt-1" style="font-size: 12px;">
                                                    <p class="text-danger">{{ $message }}</p>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 mb-1">
                                                <div id="agency_affiliation_details" class="d-none">
                                                    <div class="form-group">
                                                        <label for="agency_affiliation_name">{{ __('Agency Affiliation Name') }}</label>
                                                        <input type="text" id="agency_affiliation_name" name="agency_affiliation_name" class="form-control {{ $errors->has('agency_affiliation_name') ? 'is-invalid' : '' }}" value="{{ old('agency_affiliation_name') }}">
                                                        <div class="error-container text-danger mt-1" style="font-size: 12px;">
                                                        <p class="text-danger">
                                                            @error('agency_affiliation_name')
                                                                {{ $message }}
                                                            @enderror
                                                        </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="username">{{ __('Username') }}</label>
                                                    <input type="text" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" value="{{ old('username') }}" id="username" aria-describedby="username" name="username">
                                                    <div class="error-container text-danger mt-1" style="font-size: 12px;">
                                                    <p class="text-danger">
                                                        @error('username')
                                                            {{ $message }}
                                                        @enderror
                                                    </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="password">{{ __('Password') }}</label>
                                                    <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" aria-describedby="password" name="password">
                                                    <div class="error-container text-danger mt-1" style="font-size: 12px;">
                                                    <p class="text-danger">
                                                        @error('password')
                                                            {{ $message }}
                                                        @enderror
                                                    </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                                                    <input type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" id="password_confirmation" aria-describedby="password_confirmation" name="password_confirmation">
                                                    <div class="error-container text-danger mt-1" style="font-size: 12px;">
                                                    <p class="text-danger">
                                                        @error('password_confirmation')
                                                            {{ $message }}
                                                        @enderror
                                                    </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary px-5">{{ __('Register Buyer Account') }}</button>
                            </div>
                        </form>
                    </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    </div>
</div>
</body>
@endsection

@push('scripts')
    <script src="{{ asset('js/display_file_name.js') }}"></script>
    <script>
        // JavaScript to show/hide agency affiliation name field
        document.addEventListener('DOMContentLoaded', function() {
            const agencyAffiliationSelect = document.getElementById('agency_affiliation');
            const agencyAffiliationDetails = document.getElementById('agency_affiliation_details');
            const agencyAffiliationNameInput = document.getElementById('agency_affiliation_name');

            function toggleAgencyAffiliationName() {
                if (agencyAffiliationSelect.value === 'yes') {
                    agencyAffiliationDetails.classList.remove('d-none');
                    agencyAffiliationNameInput.setAttribute('required', 'required'); // Make required if 'yes'
                } else {
                    agencyAffiliationDetails.classList.add('d-none');
                    agencyAffiliationNameInput.removeAttribute('required'); // Remove required if 'no' or empty
                    agencyAffiliationNameInput.value = ''; // Clear value when hidden
                }
            }

            // Initial check on page load
            toggleAgencyAffiliationName();

            // Add event listener for changes
            agencyAffiliationSelect.addEventListener('change', toggleAgencyAffiliationName);
        });
    </script>
@endpush
