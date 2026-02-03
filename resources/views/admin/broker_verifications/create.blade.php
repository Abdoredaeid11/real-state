<form action="{{ route('admin.broker_verifications.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="form-label">Broker</label>
        <select name="user_id" class="form-control">
            @foreach($brokers as $b)
                <option value="{{ $b->id }}">{{ $b->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">ID Image</label>
        <input type="file" name="id_image" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Selfie Image</label>
        <input type="file" name="selfie_image" class="form-control">
    </div>

    <button class="btn btn-primary">Submit</button>

</form>
