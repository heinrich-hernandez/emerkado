<?php use App\Helpers\Functions; ?>
@php
    $lastDisplayedMonth = null; // Initialize a variable to track the last displayed month
@endphp

<div id="account-timeline" class="card">

    <!-- Card Header -->
    <div class="card-header border-transparent">
        <h3 class="card-title">Account Creation Timeline</h3 class="card-title">
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
        <div class="card-body">

            <!-- Display the users in a list -->
             <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="timeline">
                                
                                @foreach($users as $user)
                                    <div class="time-label">
                                    @php
                                        // Get the current month and year
                                        $currentMonth = $user->created_at ? $user->created_at->format('F') : null;
                                        $currentYear = $user->created_at ? $user->created_at->format('Y') : null;

                                        // Determine the class based on the month
                                        $class = '';
                                        if ($user->created_at) {
                                            $now = now(); // Get the current date
                                            $isCurrentMonth = $user->created_at->isCurrentMonth();
                                            $isPastMonth = $user->created_at->isSameMonth($now->subMonth()); // Check if it's the previous month

                                            if ($isCurrentMonth) {
                                                $class = 'bg-red';
                                            } elseif ($isPastMonth) {
                                                $class = 'bg-green';
                                            } else {
                                                $class = 'bg-blue';
                                            }
                                        }
                                    @endphp

                                    @if($currentMonth !== $lastDisplayedMonth) <!-- Check if the month is different from the last displayed month -->
                                        <span class="{{ $class }}">
                                            {{ $currentMonth ?? 'N/A' }}
                                        </span>
                                        @php
                                            $lastDisplayedMonth = $currentMonth; // Update the last displayed month
                                        @endphp
                                    @endif
                                    </div>
                                    <div><!-- update to include user profile pictures -->
                                        <i class="fas fa-user bg-blue"></i>
                                            <div class="timeline-item">
                                                <div class="timeline-header">
                                                    <span class="username">
                                                    <!-- Display user ID and name -->
                                                    <strong>{{ $user->user_id }}</strong> - <strong>{{ $user->name }}</strong>
                                                    <span class="float-right text-muted text-sm">{{ $user->created_at ? $user->created_at->diffForHumans() : 'N/A' }}</span>
                                                </div>
                                                <div class="timeline-body">
                                                <p>
                                                    User ID: {{ $user->user_id }}<br>
                                                    Name: {{ $user->name }}<br>
                                                    Created At: {{ $user->created_at ? $user->created_at->format('F j, Y h:i A') : 'N/A' }}<br>
                                                    Review Status: <span class="badge badge-pill {{ Functions::review_status_color($user->review_status) }}">{{ $user->review_status }}</span><br>
                                                    Reviewed By: {{ $user->reviewed_by ?? 'N/A' }}<br>
                                                </p>
                                                <!-- Additional user details can be added here -->
                                            </div>
                                        </div>
                                            <!-- Add a divider for each user -->
                                    </div>
                                @endforeach

                                @if($users->isEmpty())
                                    No users found.</li>
                                @endif
                                <div>
                                    <i class="fas fa-clock bg-gray"></i>
                                </div>
                            </div>
                            <!-- /.timeline -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>