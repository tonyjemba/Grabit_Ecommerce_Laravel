@extends('Frontend.main_master')

@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Login</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content">
    <div class="container">
      <div class="sign-in-page">
        <div class="row">
          <!-- Sign-in -->
          <div class="col-md-6 col-sm-6 sign-in">
            <h4 class="">Sign in</h4>
            <p class="">Hello, Welcome to your account.</p>
            <div class="social-sign-in outer-top-xs">
              <a href="#" class="facebook-sign-in"
                ><i class="fa fa-facebook"></i> Sign In with Facebook</a
              >
              <a href="#" class="twitter-sign-in"
                ><i class="fa fa-twitter"></i> Sign In with Twitter</a
              >
            </div>
            <form method="POST" action="{{ isset($guard)?url($guard.'/login'):route('login') }}" class="register-form outer-top-xs" role="form">
                @csrf
              <div class="form-group">
                <label class="info-title" for="exampleInputEmail1"
                  >Email Address <span>*</span></label
                >
                <input
                  type="email"
                  class="form-control unicase-form-control text-input"
                  id="email"
                  name="email"
                />
              </div>
              <div class="form-group">
                <label class="info-title" for="exampleInputPassword1"
                  >Password <span>*</span></label
                >
                <input
                  type="password"
                  class="form-control unicase-form-control text-input"
                  id="password"
                  name="password"
                />
              </div>
              <div class="radio outer-xs">
                <label>
                  <input
                    type="radio"
                    name="optionsRadios"
                    id="optionsRadios2"
                    value="option2"
                  />Remember me!
                </label>
                <a href="{{ route('password.request') }}" class="forgot-password pull-right"
                  >Forgot your Password?</a
                >
              </div>
              <button
                type="submit"
                class="btn-upper btn btn-primary checkout-page-button"
              >
                Login
              </button>
            </form>
          </div>
          <!-- Sign-in -->

          <!-- create a new account -->
          <div class="col-md-6 col-sm-6 create-new-account">
            <h4 class="checkout-subtitle">Create a new account</h4>
            <p class="text title-tag-line">Create your new account.</p>
            <form class="register-form outer-top-xs" role="form">
              <div class="form-group">
                <label class="info-title" for="exampleInputEmail2"
                  >Email Address <span>*</span></label
                >
                <input
                  type="email"
                  class="form-control unicase-form-control text-input"
                  id="exampleInputEmail2"
                />
              </div>
              <div class="form-group">
                <label class="info-title" for="exampleInputEmail1"
                  >Name <span>*</span></label
                >
                <input
                  type="email"
                  class="form-control unicase-form-control text-input"
                  id="exampleInputEmail1"
                />
              </div>
              <div class="form-group">
                <label class="info-title" for="exampleInputEmail1"
                  >Phone Number <span>*</span></label
                >
                <input
                  type="email"
                  class="form-control unicase-form-control text-input"
                  id="exampleInputEmail1"
                />
              </div>
              <div class="form-group">
                <label class="info-title" for="exampleInputEmail1"
                  >Password <span>*</span></label
                >
                <input
                  type="email"
                  class="form-control unicase-form-control text-input"
                  id="exampleInputEmail1"
                />
              </div>
              <div class="form-group">
                <label class="info-title" for="exampleInputEmail1"
                  >Confirm Password <span>*</span></label
                >
                <input
                  type="email"
                  class="form-control unicase-form-control text-input"
                  id="exampleInputEmail1"
                />
              </div>
              <button
                type="submit"
                class="btn-upper btn btn-primary checkout-page-button"
              >
                Sign Up
              </button>
            </form>
          </div>
          <!-- create a new account -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.sigin-in-->
      <!-- ============================================== BRANDS CAROUSEL ============================================== -->
      @include('Frontend.Body.brand')
      <!-- /.logo-slider -->
      <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div>
    <!-- /.container -->
  </div>

@endsection

{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

 <form method="POST" action="{{ route('user.login') }}">
            @csrf
 
            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Login') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}
