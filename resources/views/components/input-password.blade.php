<div class="form-group">
    <input name="{{$name}}" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
    @error('email')
                <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                 </span>
     @enderror
</div>