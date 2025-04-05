
{{-- Membership --}}
<div class="form-group mb-3">
    <label for="membership" class="form-label text-white">
        Membership
    </label>
    <select name="membership" id="membership" 
            class="form-select @error('membership') is-invalid @enderror" required>
        <option value="" disabled selected>Membership</option>
        <option value="Silver" {{ old('membership', $plan->membership ?? '') === "Silver" ? "selected" : '' }}>Silver</option>
        <option value="Gold" {{ old('membership', $plan->membership ?? '') === "Gold" ? "selected" : '' }}>Gold</option>
        <option value="Platinum" {{ old('membership', $plan->membership ?? '') === "Platinum" ? "selected" : '' }}>Platinum</option>
    </select>
    @error('membership')
        <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
    @enderror
</div>

{{-- Plan Type --}}
<div class="form-group mb-3">
    <label for="plan" class="form-label text-white">
        Plan Type
    </label>
    <select name="plan" id="plan" 
            class="form-select @error('plan') is-invalid @enderror" required>
        <option value="" disabled selected>Plan Type</option>
        <option value="Basic" {{ old('plan', $plan->plan ?? '') === "Basic" ? "selected" : '' }}>Basic</option>
        <option value="Premium" {{ old('plan', $plan->plan ?? '') === "Premium" ? "selected" : '' }}>Premium</option>
        <option value="Elite" {{ old('plan', $plan->plan ?? '') === "Elite" ? "selected" : '' }}>Elite</option>
    </select>
    @error('plan')
        <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
    @enderror
</div>


{{-- Price --}}
<div class="form-group mb-3">
    <label for="price" class="form-label text-white">
        Price
    </label>
    <input type="number" name="price" id="price" 
           value="{{ old('price', $plan->price ?? '') }}" 
           class="form-control @error('price') is-invalid @enderror" 
           placeholder="Enter Plan Price" 
           step="0.01" required>
    @error('price')
        <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
    @enderror
</div>

{{-- Duration --}}
<div class="form-group mb-3">
    <label for="duration" class="form-label text-white">
        Duration
    </label>
    <select name="duration" id="duration" 
            class="form-select @error('duration') is-invalid @enderror" required>
        <option value="" disabled selected>Duration</option>
        <option value="day" {{ old('duration', $plan->duration ?? '') === "day" ? "selected" : '' }}>Day</option>
        <option value="month" {{ old('duration', $plan->duration ?? '') === "month" ? "selected" : '' }}>Month</option>
        <option value="year" {{ old('duration', $plan->duration ?? '') === "year" ? "selected" : '' }}>Year</option>
    </select>
    @error('duration')
        <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
    @enderror
</div>


{{-- Features --}}
<div class="form-group mb-3">
    <label for="features" class="form-label text-white">
        Features
    </label>
    <textarea name="features" id="features" 
              class="form-control @error('features') is-invalid @enderror" 
              placeholder="Enter Features" rows="3">{{ old('features', $plan->features ?? '') }}</textarea>
    @error('features')
        <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
    @enderror
</div>
