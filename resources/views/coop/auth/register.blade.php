@extends('layouts.guest')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1>{{ __('Coop Registration') }}</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // This assumes you have a 'showError' function available globally (e.g., from toaster.js or a custom script)
                showError('Error processing coop registration. Please check the form for details.');
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4>{{ __('Register New Coop Account') }}</h4>
                        </div>
                        {{-- The form action should point to the specific POST route for coop registration --}}
                        <form id="coopForm" action="{{ route('coop.auth.register') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{-- @method('post') is not needed for a standard POST form --}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="authorized_representative">{{ __('Authorized Representative') }}</label>
                                                    <input type="text" class="form-control {{ $errors->has('authorized_representative') ? 'is-invalid' : '' }}" value="{{ old('authorized_representative') }}" id="authorized_representative" aria-describedby="authorized_representative" name="authorized_representative">
                                                    <div class="error-container text-danger mt-1" style="font-size: 12px;">
                                                    <p class="text-danger">
                                                        @error('authorized_representative')
                                                            {{ $message }}
                                                        @enderror
                                                    </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="coop_name">{{ __('Coop Name') }}</label>
                                                    <input type="text" class="form-control {{ $errors->has('coop_name') ? 'is-invalid' : '' }}" value="{{ old('coop_name') }}" id="coop_name" aria-describedby="coop_name" name="coop_name">
                                                    <div class="error-container text-danger mt-1" style="font-size: 12px;">
                                                    <p class="text-danger">
                                                        @error('coop_name')
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
                                                <label for="coop_profile_picture">{{ __('Profile Picture') }}</label>
                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="coop_profile_picture" name="coop_profile_picture">
                                                        <label class="custom-file-label" for="coop_profile_picture" aria-describedby="coop_profile_picture">{{ __('Choose File') }}</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="coop_profile_picture">{{ __('Upload') }}</span>
                                                    </div>
                                                </div>
                                                @error('coop_profile_picture')
                                                <div class="error-container text-danger mt-1" style="font-size: 12px;">
                                                    <p class="text-danger">{{ $message }}</p>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12">
                                                <label for="coop_valid_id_picture">{{ __('Valid ID Picture') }}</label>
                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="coop_valid_id_picture" name="coop_valid_id_picture">
                                                        <label class="custom-file-label" for="coop_valid_id_picture" aria-describedby="coop_valid_id_picture">{{ __('Choose File') }}</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="coop_valid_id_picture">{{ __('Upload') }}</span>
                                                    </div>
                                                </div>
                                                @error('coop_valid_id_picture')
                                                <div class="error-container text-danger mt-1" style="font-size: 12px;">
                                                    <p class="text-danger">{{ $message }}</p>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12">
                                                <div class="form-group mb-3">
                                                    <label for="agency_affiliation">{{ __('Agency Affiliation') }}</label>
                                                    <select class="custom-select {{ $errors->has('agency_affiliation') ? 'is-invalid' : '' }}" id="agency_affiliation" name="agency_affiliation">
                                                        <option value="" selected disabled>{{ __('Are your business affiliated with any government agencies?') }}</option>
                                                        <option value="yes" {{ old('agency_affiliation') == 'yes' ? 'selected' : '' }}>{{ __('Yes') }}</option>
                                                        <option value="no" {{ old('agency_affiliation') == 'no' ? 'selected' : '' }}>{{ __('No') }}</option>
                                                    </select>
                                                    <div class="error-container text-danger mt-1" style="font-size: 12px;">
                                                        @error('agency_affiliation')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
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
                                                <div class="form-group mb-3">
                                                    <div class="mb-3">
                                                        <label for="business_description">{{ __('Business Description') }}</label>
                                                        <textarea class="form-control {{ $errors->has('business_description') ? 'is-invalid' : '' }}" id="business_description" name="business_description" rows="3">{{ old('business_description') }}</textarea>
                                                        @error('business_description')
                                                        <div class="error-container text-danger mt-1" style="font-size: 12px;">
                                                            <p class="text-danger">{{ $message }}</p>
                                                        </div>
                                                        @enderror
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
                                <button type="submit" class="btn btn-primary px-5">{{ __('Register Coop Account') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
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
