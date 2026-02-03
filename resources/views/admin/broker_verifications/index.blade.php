@extends('admin.layout.master')
@section('content')
    <div class="doc-example">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>{{ __('admin.general.broker_verifications') }}</h4>
        </div>

        <div class="table-responsive">
            <table class="table mb-0 table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('admin.general.id') }}</th>
                        <th>{{ __('admin.general.users') }}</th>
                        <th>{{ __('admin.general.id_image') }}</th>
                        <th>{{ __('admin.general.selfie_image') }}</th>
                        <th>{{ __('admin.general.status') }}</th>
                        <th>{{ __('admin.general.review_info') }}</th>
                        <th>{{ __('admin.general.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($verifications as $verification)
                        <tr>
                            <td>{{ $verification->id }}</td>
                            <td>{{ $verification->user->name ?? '-' }}</td>

                            <td>
                                @if ($verification->id_image)
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#idImageModal{{ $verification->id }}">
                                        {{ __('admin.general.view_id') }}
                                    </button>

                                    <!-- ID Image Modal -->
                                    <div class="modal fade" id="idImageModal{{ $verification->id }}" tabindex="-1"
                                        aria-labelledby="idImageModalLabel{{ $verification->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="idImageModalLabel{{ $verification->id }}">{{ __('admin.general.id_image') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{ asset('storage/' . $verification->id_image) }}"
                                                        class="img-fluid" alt="ID Image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>

                            <td>
                                @if ($verification->selfie_image)
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#selfieImageModal{{ $verification->id }}">
                                        {{ __('admin.general.view_selfie') }}
                                    </button>

                                    <!-- Selfie Image Modal -->
                                    <div class="modal fade" id="selfieImageModal{{ $verification->id }}" tabindex="-1"
                                        aria-labelledby="selfieImageModalLabel{{ $verification->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="selfieImageModalLabel{{ $verification->id }}">{{ __('admin.general.selfie_image') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{ asset('storage/' . $verification->selfie_image) }}"
                                                        class="img-fluid" alt="Selfie Image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>

                            <td>
                                @if ($verification->status == 'pending')
                                    <span class="badge bg-secondary">{{ __('admin.verification_statuses.pending') }}</span>
                                @elseif($verification->status == 'approved')
                                    <span class="badge bg-success">{{ __('admin.verification_statuses.approved') }}</span>
                                @else
                                    <span class="badge bg-danger">{{ __('admin.verification_statuses.rejected') }}</span>
                                @endif
                            </td>

                            <td>
                                @if($verification->reviewed_at)
                                    <small class="text-muted d-block">
                                        {{ optional($verification->reviewed_at)->format('Y-m-d H:i') }}
                                    </small>
                                @endif
                                @if($verification->rejection_reason)
                                    <button type="button" class="btn btn-sm btn-outline-danger mt-1" data-bs-toggle="modal"
                                        data-bs-target="#reasonModal{{ $verification->id }}">
                                        {{ __('admin.general.view_reason') }}
                                    </button>

                                    <div class="modal fade" id="reasonModal{{ $verification->id }}" tabindex="-1"
                                        aria-labelledby="reasonModalLabel{{ $verification->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="reasonModalLabel{{ $verification->id }}">{{ __('admin.general.rejection_reason') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ $verification->rejection_reason }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>

                            <td>
                                @if ($verification->status == 'pending')
                                    <form action="{{ route('admin.broker-verifications.approve', ['locale' => app()->getLocale(), 'id' => $verification->id]) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-sm btn-success">{{ __('admin.general.approve') }}</button>
                                    </form>

                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#rejectModal{{ $verification->id }}">
                                        {{ __('admin.general.reject') }}
                                    </button>

                                    <div class="modal fade" id="rejectModal{{ $verification->id }}" tabindex="-1"
                                        aria-labelledby="rejectModalLabel{{ $verification->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('admin.broker-verifications.reject', ['locale' => app()->getLocale(), 'id' => $verification->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('POST')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="rejectModalLabel{{ $verification->id }}">{{ __('admin.general.reject_verification') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">{{ __('admin.general.rejection_reason_optional') }}</label>
                                                            <textarea name="rejection_reason" rows="3" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('admin.general.cancel') }}</button>
                                                        <button type="submit" class="btn btn-danger">{{ __('admin.general.reject') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif

                                <form action="{{ route('admin.broker-verifications.destroy', ['locale' => app()->getLocale(), 'id' => $verification->id]) }}"
                                    method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('{{ __('admin.general.are_you_sure') }}')">{{ __('admin.general.delete') }}</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $verifications->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
