@extends('layout')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Đăng kí</div>
                <div class="card-body">
                    <form action="{{ route('store') }}" method="post">
                        @csrf
                        <div class="mb-3 row">
                            <label for="display_name" class="col-md-4 col-form-label text-md-end text-start">Tên hiển thị</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('display_name') is-invalid @enderror" id="display_name" name="display_name" value="{{ old('display_name') }}">
                                @if ($errors->has('display_name'))
                                    <span class="text-danger">{{ $errors->first('display_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="username" class="col-md-4 col-form-label text-md-end text-start">Tên đăng nhập</label>
                            <div class="col-md-6">
                                <input class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}">
                                @if ($errors->has('username'))
                                    <span class="text-danger">{{ $errors->first('username') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-end text-start">Địa chỉ email</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-md-4 col-form-label text-md-end text-start">Mật khẩu</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-end text-start">Nhập lại mât khẩu</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Register">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
