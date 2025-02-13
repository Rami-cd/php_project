<div class="module-card">
    <h4 class="module-title">{{ $module->name }}</h4>
    <p class="module-description">{{ $module->description }}</p>
    <div class="module-video">
        @if ($module->course_url)
            <video controls>
                <source src="{{ $module->course_url }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @else
            <p>No video available for this module.</p>
        @endif
    </div>

    <!-- Edit Button -->
    <a href="{{ route('module.edit', $module->id) }}" class="btn btn-primary">Edit Module</a>
</div>
