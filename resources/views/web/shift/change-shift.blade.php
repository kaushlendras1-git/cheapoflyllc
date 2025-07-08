<form method="POST" action="{{ route('users.change-shift', $user->id) }}">
    @csrf
    <select name="shift_id" class="form-control">
        @foreach($shifts as $shift)
            <option value="{{ $shift->id }}">{{ $shift->name }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary">Change Shift</button>
</form>
