<div class="form-group mb-3">
    <label for="title" class="form-label text-white">Title</label>
    <input type="text" name="title" id="title" 
           value="{{ old('title', $blog->title ?? '') }}" 
           class="form-control @error('title') is-invalid @enderror" 
           placeholder="Enter Blog Title" required>
    @error('title')
        <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="description" class="form-label text-white">Description</label>
    <textarea name="description" id="description" 
              class="form-control @error('description') is-invalid @enderror" 
              placeholder="Enter Blog Description" rows="4" required>{{ old('description', $blog->description ?? '') }}</textarea>
    @error('description')
        <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="image" class="form-label text-white">Image</label>
    <input type="file" name="image" id="image" 
           class="form-control @error('image') is-invalid @enderror">
    @error('image')
        <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="publish_date" class="form-label text-white">Publish Date</label>
    <input type="date" name="publish_date" id="publish_date" 
           value="{{ old('publish_date', $blog->publish_date ?? '') }}" 
           class="form-control @error('publish_date') is-invalid @enderror">
    @error('publish_date')
        <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="category" class="form-label text-white">Category</label>
    <input type="text" name="category" id="category" 
           value="{{ old('category', $blog->category ?? '') }}" 
           class="form-control @error('category') is-invalid @enderror" 
           placeholder="Enter Blog Category" required>
    @error('category')
        <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="status" class="form-label text-white">Status</label>
    <select name="status" id="status" 
            class="form-select @error('status') is-invalid @enderror" required>
        <option value="" disabled {{ old('status', $blog->status ?? '') === null ? 'selected' : '' }}>Select Status</option>
        <option value="draft" {{ old('status', $blog->status ?? '') === "draft" ? "selected" : '' }}>Draft</option>
        <option value="published" {{ old('status', $blog->status ?? '') === "published" ? "selected" : '' }}>Published</option>
        <option value="archived" {{ old('status', $blog->status ?? '') === "archived" ? "selected" : '' }}>Archived</option>
    </select>
    @error('status')
        <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
    @enderror
</div>
