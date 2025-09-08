<div class="tab-pane fade" id="conversations" role="tabpanel" aria-labelledby="conversations-tab">
    <div class="card p-4 show-booking-card">
        <div class="card card-action mt-4">
            <div class="card-header align-items-center pb-0">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <h5 class="card-action-title mb-0 d-flex align-items-center">
                        <i class="icon-base ri ri-bar-chart-2-line icon-24px text-body me-3"></i>
                        Conversations
                    </h5>
                    <button type="button" class="btn rounded-pill btn-icon btn-primary waves-effect waves-light">
                        <span class="icon-base ri ri-information-2-fill icon-22px"></span>
                    </button>
                </div>
            </div>
            <div class="card-body pt-3 viwer_seen">
                @if(isset($logs) && $logs->count() > 0)
                    @php
                        $logsByDate = $logs->groupBy(function($log) {
                            return $log->created_at->format('Y-m-d');
                        });
                    @endphp
                    
                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs mb-4" id="timelineTabs" role="tablist">
                        @foreach($logsByDate as $date => $dateLogs)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link save-feedback-btn {{ $loop->first ? 'active' : '' }}" 
                                        id="tab-{{ $date }}" 
                                        data-bs-toggle="tab" 
                                        data-bs-target="#content-{{ $date }}" 
                                        type="button" 
                                        role="tab" 
                                        aria-controls="content-{{ $date }}" 
                                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                    {{ \Carbon\Carbon::parse($date)->format('M d, Y') }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    
                    <!-- Tab Content -->
                    <div class="tab-content" id="timelineTabContent">
                        @foreach($logsByDate as $date => $dateLogs)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                                 id="content-{{ $date }}" 
                                 role="tabpanel" 
                                 aria-labelledby="tab-{{ $date }}">
                                <ul class="timeline card-timeline mb-0">
                                    @foreach($dateLogs as $log)
                                        <li class="timeline-item timeline-item-transparent">
                                            <span class="timeline-point timeline-point-{{ $log->operation == 'Viewed' ? 'success' : 'primary' }}"></span>
                                            <div class="timeline-event">
                                                <div class="viewer-wrapper d-flex align-items-center justify-content-between">
                                                    <div class="viewer-left-side">
                                                        <div class="avatar avatar-sm me-2 d-flex align-items-center">
                                                            <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle">
                                                            <div class="about-viewer ms-3 pe-5">
                                                                <div class="d-flex align-items-center mb-1">
                                                                    <p class="mb-0 small user-viewer">{{ $log->user->name ?? 'Unknown' }}</p>
                                                                    <div class="seprator-name"></div>
                                                                    <small class="text-body-secondary" style="white-space: nowrap;">{{ $log->created_at->format('Y-m-d H:i:s') }}</small>
                                                                </div>
                                                            </div>
                                                            <p class="mb-0 comment-viewer ms-5">{{ $log->comment }} @ {{ $log->created_at->diffForHumans() }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="viewer-right-side">
                                                        <h6 class="mb-0">{{ $log->operation }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <p class="text-muted">No conversation history available.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>