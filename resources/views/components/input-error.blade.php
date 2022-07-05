@props(['for' => '', 'error' => ''])
@error($for)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
