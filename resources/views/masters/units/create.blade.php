@extends('web.layouts.main')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Add Unit</h2>
        <div class="breadcrumb">
            <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
            <a class="active" href="{{ route('units.index') }}">Units</a>
            <a class="active">Add Unit</a>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card p-4">
        <form method="POST" action="{{ route('units.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                
                <div class="col-md-4">
                    <label class="form-label">LOB <span class="text-danger">*</span></label>
                    <select name="lob_id" id="lob_id" class="form-control" required>
                        <option value="">Select LOB</option>
                        @foreach($lobs as $lob)
                            <option value="{{ $lob->id }}" {{ old('lob_id') == $lob->id ? 'selected' : '' }}>{{ $lob->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-4">
                    <label class="form-label">Team <span class="text-danger">*</span></label>
                    <select name="team_id" id="team_id" class="form-control" required disabled>
                        <option value="">Select Team</option>
                    </select>
                </div>
            </div>
            
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('units.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('lob_id').addEventListener('change', function() {
    const lobId = this.value;
    const teamSelect = document.getElementById('team_id');
    
    teamSelect.innerHTML = '<option value="">Select Team</option>';
    teamSelect.disabled = true;
    
    if(lobId) {
        fetch(`/api/teams/${lobId}`)
            .then(response => response.json())
            .then(teams => {
                teams.forEach(team => {
                    const option = new Option(team.name, team.id);
                    teamSelect.add(option);
                });
                teamSelect.disabled = false;
            })
            .catch(error => {
                console.error('Error fetching teams:', error);
            });
    }
});
</script>

@endsection