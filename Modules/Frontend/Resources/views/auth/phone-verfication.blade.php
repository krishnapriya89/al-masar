<form action="{{ route('user.register.store') }}" id="RegisterForm" name="RegisterForm" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name" class="form-label">Name*</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}"
            class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">
        @error('name')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="attachment" class="form-label">Attachment</label>
        <input type="file" id="attachment" name="attachment" value="{{ old('attachment') }}"
            class="form-control @error('attachment') is-invalid @enderror" placeholder="Enter attachment">
        @error('attachment')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="baseBtn hoveranim"><span>Register</span></button>
</form>