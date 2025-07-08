<form method="POST" action="{{ route('users.change-shift', $user->id) }}">
    @csrf
    <div class="form-group">
        <label>Shift</label>
        <select name="shift_id" class="form-control">
            @foreach($shifts as $shift)
                <option value="{{ $shift->id }}">{{ $shift->name }} {{ $shift->start_time }} - {{ $shift->end_time }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-primary mt-2">Assign Shift</button>
</form>

<hr>

<form method="POST" action="{{ route('users.change-team', $user->id) }}">
    @csrf
    <div class="form-group">
        <label>Team</label>
        <select name="team_id" class="form-control">
            @foreach($teams as $team)
                <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-success mt-2">Assign Team</button>
</form>
