<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h6 class="mb-3">Current Assignments for: <strong>{{ $user->name }}</strong></h6>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Current Shift</h6>
                            <p class="card-text">
                                {{ $user->currentShift?->shift->name ?? 'No Shift Assigned' }}
                                @if($user->currentShift?->shift)
                                    <br><small class="text-muted">{{ $user->currentShift->shift->start_time }} - {{ $user->currentShift->shift->end_time }}</small>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Current Team</h6>
                            <p class="card-text">{{ $user->currentTeam?->team->name ?? 'No Team Assigned' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">LOB</h6>
                            <p class="card-text">{{ $user->lobRelation?->name ?? 'No LOB Assigned' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Direct Team</h6>
                            <p class="card-text">{{ $user->teamRelation?->name ?? 'No Direct Team Assigned' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <hr>
    
    <div class="row">
        <div class="col-md-6">
            <form method="POST" action="{{ route('users.change-shift', $user->id) }}">
                @csrf
                <div class="form-group mb-3">
                    <label class="form-label">Assign New Shift</label>
                    <select name="shift_id" class="form-control" required>
                        <option value="">Select Shift</option>
                        @foreach($shifts as $shift)
                            <option value="{{ $shift->id }}" {{ $user->currentShift?->shift_id == $shift->id ? 'selected' : '' }}>
                                {{ $shift->name }} ({{ $shift->start_time }} - {{ $shift->end_time }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Assign Shift</button>
            </form>
        </div>
        
        <div class="col-md-6">
            <form method="POST" action="{{ route('users.change-team', $user->id) }}">
                @csrf
                <div class="form-group mb-3">
                    <label class="form-label">Assign New Team</label>
                    <select name="team_id" class="form-control" required>
                        <option value="">Select Team</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}" {{ $user->currentTeam?->team_id == $team->id ? 'selected' : '' }}>
                                {{ $team->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success btn-sm">Assign Team</button>
            </form>
        </div>
    </div>
</div>
