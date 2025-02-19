<div class="container">
    <h2>Become a Teacher</h2>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @php
        $existingRequest = Auth::user()->teacherRequest; // Fetch the user's request
    @endphp

    @if(!$existingRequest)
        <form action="{{ route('become.teacher') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="reason" class="form-label">Why do you want to become a teacher?</label>
                <textarea name="reason" id="reason" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Request</button>
        </form>
    @else
        <div class="alert alert-info">
            You have already submitted a request. Status:  
            <strong>{{ ucfirst($existingRequest->status) }}</strong>
        </div>
    @endif
</div>
