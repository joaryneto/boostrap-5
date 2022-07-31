@extends('layouts.auth-master')

@section('content')
    <form method="post" action="{{ route('verify.perform') }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <img class="mb-4" src="{!! url('images/bootstrap-logo.svg') !!}" alt="" width="72" height="57">
        <label for="verification_code" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
        <input type="hidden" name="numero_telefone" value="{{session('numero_telefone')}}">
        <div class="form-group form-floating mb-3">
            <input type="tel" class="form-control" name="verification_code" value="{{ old('verification_code') }}" placeholder="Username" required="required" autofocus>
            @if ($errors->has('verification_code'))
                <span class="text-danger text-left">{{ $errors->first('verification_code') }}</span>
            @endif
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
        
        @include('auth.partials.copy')
    </form>
@endsection