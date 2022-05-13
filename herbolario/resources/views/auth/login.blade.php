
@include('layoutsCompartido.head')
<body class="login">
    @if(session()->has('success'))
        <div class="alert alert-success" style="width: 100%; height: auto; position:static!important;">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="container marg-top100px" style="background-color: white; border-radius:25px; box-shadow: 0 4px 6px 0 rgba(22, 26, 0.18); ">
        <div class="row justify-content-center">
            <h1 class="col-lg-12 marg-top45px" style="text-align: center">Iniciar Sesión</h1>
            <form method="POST" action="{{ route('login') }}" class="marg-top45px">
                @csrf

                <div class="row justify-content-center">
                    <h4 style="text-align: center" for="email" class="col-md-12">{{ __('Email Address') }}</h4>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control border_bottom @error('email') is-invalid @enderror " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo Electronico" >

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row justify-content-center marg-top30px" >
                    <h4 style="text-align: center" for="password" class="col-md-12">{{ __('Password') }}</h4>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control border_bottom @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3 marg-top15px">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
            <div class="col-lg-7 marg-top15px" style=" height: 30px; border-bottom: 1px solid black; text-align: center">
                <span style="font-size: 40px; background-color: #ffffff; padding: 0 9px;">
                 ¿Eres nuevo?
                </span>
            </div>

            <div class="col-lg-12"></div><br/><br/>
            <a href="{{route('register')}}" class="btn btn-danger col-lg-5 col-4" style="margin-bottom: 40px">Crear Cuenta</a>
        </div>
    </div>


</body>
