@extends('admin.layout.master')

@section('content')
    <div class="doc-example">
        <div class="tab-content doc-example-content" id="tab-tabContent" data-label="Example">
            <div class="tab-pane fade show active" id="table-basic-preview" role="tabpanel" aria-labelledby="table-basic-preview-tab">
                <div class="table-responsive">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <h4 class="mb-0">{{ __('admin.general.blogs') ?? 'Blogs' }}</h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.blogs.create', app()->getLocale()) }}" class="btn btn-primary">
                                <i class="bx bx-plus"></i> {{ __('admin.general.create') }} {{ __('admin.general.blogs') ?? 'Blog' }}
                            </a>
                        </div>
                    </div>

                    <form method="GET" action="{{ route('admin.blogs.index', app()->getLocale()) }}" class="row g-2 mb-3">
                        <div class="col-md-4">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __('admin.filters.search_placeholder') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">{{ __('admin.filters.all_statuses') }}</option>
                                <option value="draft" @selected(request('status')==='draft')>Draft</option>
                                <option value="published" @selected(request('status')==='published')>Published</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex gap-2">
                            <button type="submit" class="btn btn-outline-primary w-100">{{ __('admin.general.filter') }}</button>
                            <a href="{{ route('admin.blogs.index', app()->getLocale()) }}" class="btn btn-outline-secondary">{{ __('admin.general.reset') }}</a>
                        </div>
                    </form>

                    <table class="table mb-0 table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 60px;">{{ __('admin.general.id') }}</th>
                                <th style="width: 80px;">{{ __('admin.forms.image') }}</th>
                                <th style="width: 200px;">{{ __('admin.forms.title') }}</th>
                                <th style="width: 200px;">Slug</th>
                                <th style="width: 120px;">{{ __('admin.general.status') }}</th>
                                <th style="width: 150px;">Published At</th>
                                <th style="width: 150px;">Author</th>
                                <th style="width: 120px;">{{ __('admin.general.created_at') }}</th>
                                <th style="width: 120px;">{{ __('admin.general.updated_at') }}</th>
                                <th style="width: 100px;">{{ __('admin.general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $blog)
                            <tr>
                                <td>{{ $blog->id }}</td>
                                <td>
                                    <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('assets/images/blog/blog1.jpg') }}"
                                         alt="image" style="width:50px;height:50px;object-fit:cover;border-radius:6px;">
                                </td>
                                <td>{{ app()->getLocale()=='ar' ? ($blog->title_ar ?? $blog->title) : $blog->title }}</td>
                                <td>{{ $blog->slug }}</td>
                                <td>{{ ucfirst($blog->status) }}</td>
                                <td>{{ $blog->published_at ? $blog->published_at->format('Y-m-d') : '-' }}</td>
                                <td>{{ $blog->author?->name ?? '-' }}</td>
                                <td>{{ $blog->created_at ? $blog->created_at->format('Y-m-d') : '-' }}</td>
                                <td>{{ $blog->updated_at ? $blog->updated_at->format('Y-m-d') : '-' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('admin.blogs.edit', ['locale' => app()->getLocale(), 'id' => $blog->id]) }}">
                                                <i class="bx bx-edit-alt me-1"></i> {{ __('admin.general.edit') }}
                                            </a>
                                            <form action="{{ route('admin.blogs.destroy', ['locale' => app()->getLocale(), 'id' => $blog->id]) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item" onclick="return confirm('{{ __('admin.general.are_you_sure') }}')">
                                                    <i class="bx bx-trash me-1"></i> {{ __('admin.general.delete') }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

