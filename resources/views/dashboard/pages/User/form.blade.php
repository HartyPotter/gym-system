{{-- Full Name --}}
<div class="form-group mb-3">
    <label for="fullname" class="form-label text-white">
        Full Name 
    </label>
    <input type="text" name="fullname" id="fullname" 
           value="{{ old('fullname', $user->fullname ?? '') }}" 
           class="form-control @error('fullname') is-invalid @enderror" 
           placeholder="Enter Full Name" 
           required>
    @error('fullname')
        <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
    @enderror
</div>


{{-- Username --}}
<div class="form-group mb-3">
    <label for="username" class="form-label text-white">
        Username <span class="text-danger">*</span>
    </label>
    <input type="text" name="username" id="username" 
           value="{{ old('username', $user->username ?? '') }}" 
           class="form-control @error('username') is-invalid @enderror" 
           placeholder="Enter Username" 
           required>
    @error('username')
        <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
    @enderror
</div>



{{-- Email --}}
<div class="form-group mb-3">
    <label for="email" class="form-label text-white">
        Email <span class="text-danger">*</span>
    </label>
    <input type="email" name="email" id="email" 
           value="{{ old('email', $user->email ?? '') }}" 
           class="form-control @error('email') is-invalid @enderror" 
           placeholder="Enter Email">
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
    @enderror
</div>

{{-- Image --}}
<div class="form-group mb-3">
    <label for="image" class="form-label text-white">
        Profile Image
    </label>
    <input type="file" name="image" id="image" 
           class="form-control @error('image') is-invalid @enderror" 
           accept="image/*">
    @error('image')
        <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
    @enderror
</div>

{{-- Phone --}}
<div class="form-group mb-3">
    <label for="phone" class="form-label text-white">
        Phone <span class="text-danger">*</span>
    </label>
    <input type="text" name="phone" id="phone" 
           value="{{ old('phone', $user->phone ?? '') }}" 
           class="form-control @error('phone') is-invalid @enderror" 
           placeholder="Enter Phone Number" 
           required>
    @error('phone')
        <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
    @enderror
</div>


{{-- User Type --}}
<div class="form-group mb-3">
    <label for="user_type" class="form-label text-white">
        User Type
    </label>
    <select name="user_type" id="user_type" 
            class="form-select @error('user_type') is-invalid @enderror">
        <option value="" disabled selected>Select User Type</option>
        <option value="admin" {{ old('user_type', $user->user_type) === "admin" ? "selected" : '' }}>Admin</option>
        <option value="customer" {{ old('user_type', $user->user_type) === "customer" ? "selected" : '' }}>Customer</option>
        <option value="trainer" {{ old('user_type', $user->user_type) === "trainer" ? "selected" : '' }}>trainer</option>
    </select>
    @error('user_type')
        <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
    @enderror
</div>
{{-- Specialization (Visible only for Trainer) --}}
<div class="form-group mb-3" id="specialization-field" style="display: none;">
    <label for="specialization" class="form-label text-white">
        Specialization
    </label>
    <input type="text" name="specialization" id="specialization" 
           value="{{ old('specialization', $user->specialization ?? '') }}" 
           class="form-control @error('specialization') is-invalid @enderror" 
           placeholder="Enter Trainer Specialization">
    @error('specialization')
        <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
    @enderror
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userTypeField = document.getElementById('user_type');
        const specializationField = document.getElementById('specialization-field');

        userTypeField.addEventListener('change', function() {
            if (this.value === 'trainer') {
                specializationField.style.display = 'block';
            } else {
                specializationField.style.display = 'none';
            }
        });

        // Trigger change event on page load to set initial state
        if (userTypeField.value === 'trainer') {
            specializationField.style.display = 'block';
        }
    });
</script>


