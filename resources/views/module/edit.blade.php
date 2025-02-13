
<div class="module-edit">
    <h1>Edit Module: {{ $module->name }}</h1>

    <form action="{{ route('module.update', $module->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Module Name</label>
            <input type="text" id="name" name="name" value="{{ $module->name }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="description">Module Description</label>
            <textarea id="description" name="description" class="form-control">{{ $module->description }}</textarea>
        </div>

        <!-- <div class="form-group">
            <label for="course_url">Video URL</label>
            <input type="file" id="course_url" name="course_url" value="{{ Storage::url($module->course_url) }}" class="form-control">
        </div> -->

        <button type="submit" class="btn btn-primary">Update Module</button>
    </form>
</div>

