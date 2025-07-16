@extends('admin.main-layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Buyer') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('pages.buyer') }}">Buyer</a></li>
                        <li class="breadcrumb-item active">Registration</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
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
    
    <!-- Main content -->
    <div class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4>Add New Buyer</h4>
                        </div>
                        <form id="BuyerForm" action="{{ route('create.buyer') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="authorized_representative">Authorized Representative</label>
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
                                                    <label for="name">Buyer name</label>
                                                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}" id="name" aria-describedby="name" name="name">
                                                    <div class="error-container text-danger mt-1" style="font-size: 12px;">
                                                    <p class="text-danger">
                                                        @error('name')
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
                                                    <label for="address">Address</label>
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
                                                    <label for="contact_number">Contact number</label>
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
                                                    <label for="email">Email address</label>
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
                                                <label for="buyer_profile_picture">Profile picture</label>
                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="buyer_profile_picture" name="buyer_profile_picture">
                                                        <label class="custom-file-label" for="buyer_profile_picture" aria-describedby="buyer_profile_picture">Choose File</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="buyer_profile_picture">Upload</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12">
                                                <label for="buyer_valid_id_picture">Valid ID picture</label>
                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="buyer_valid_id_picture" name="buyer_valid_id_picture">
                                                        <label class="custom-file-label" for="buyer_valid_id_picture" aria-describedby="buyer_valid_id_picture">Choose File</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="buyer_valid_id_picture">Upload</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="username">Username</label>
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
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" id="password" aria-describedby="password" name="password">
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
                                                    <label for="password_confirmation">Confirm Password</label>
                                                    <input type="password" class="form-control" id="password_confirmation" aria-describedby="password_confirmation" name="password_confirmation">
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
                                <button type="submit" class="btn btn-primary px-5">Submit</button>
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
@endpush
