@extends('admin.layout.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>{{ __('admin.general.edit') }} {{ __('admin.general.blogs') ?? 'Blog' }}</h4>
        <a href="{{ route('admin.blogs.index', app()->getLocale()) }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> {{ __('admin.general.back') }}
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.blogs.update', ['locale' => app()->getLocale(), 'id' => $blog->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('admin.forms.title') }}</label>
                        <input type="text" name="title" class="form-control" required value="{{ old('title', $blog->title) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('admin.forms.title_ar') }}</label>
                        <input type="text" name="title_ar" class="form-control" value="{{ old('title_ar', $blog->title_ar) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $blog->slug) }}" placeholder="leave empty to keep current">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('admin.general.status') }}</label>
                        <select name="status" class="form-select" required>
                            <option value="draft" @selected(old('status', $blog->status)==='draft')>Draft</option>
                            <option value="published" @selected(old('status', $blog->status)==='published')>Published</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Published At</label>
                        <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at', $blog->published_at ? $blog->published_at->format('Y-m-d\\TH:i') : '') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">{{ __('admin.forms.image') }}</label>
                        <input type="file" name="image" class="form-control">
                        @if($blog->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="image" style="width:100px;height:100px;object-fit:cover;border-radius:6px;">
                            </div>
                        @endif
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">{{ __('admin.forms.description') }}</label>
                        <textarea name="content" class="form-control" rows="6">{{ old('content', $blog->content) }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">{{ __('admin.forms.description_ar') }}</label>
                        <textarea name="content_ar" class="form-control" rows="6">{{ old('content_ar', $blog->content_ar) }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('admin.general.save') }}</button>
            </form>
        </div>
    </div>
@endsection

