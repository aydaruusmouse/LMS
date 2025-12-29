<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{__('login')}}</title>

    <!-- CSS Files -->
    <!--====== LineAwesome ======-->
    <link rel="stylesheet" href="{{ static_asset('admin/css/line-awesome.min.css') }}">
    <!--====== Dropzone CSS ======-->
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
    <!--====== Summernote CSS ======-->
    <link rel="stylesheet" href="{{ static_asset('admin/css/summernote-lite.min.css') }}">
    <!--====== Choices CSS ======-->
    <link rel="stylesheet" href="{{ static_asset('admin/css/choices.min.css') }}">
    <!--====== AppCSS ======-->
    <link rel="stylesheet" href="{{ static_asset('admin/css/app.css') }}">
    <!--====== ResponsiveCSS ======-->
    <link rel="stylesheet" href="{{ static_asset('admin/css/responsive.css') }}">


  </head>
  <body>

    <section class="login-section">
      <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
          <div class="col-lg-5 col-md-8 col-sm-10 position-relative">

              <img src="{{ static_asset('admin/img/shape/rect.svg') }}" alt="Rect Shape" class="bg-rect-shape">
              <img src="{{ static_asset('admin/img/shape/circle.svg') }}" alt="Rect Shape" class="bg-circle-shape">
              <img src="{{ static_asset('admin/img/shape/circle-block.svg') }}" alt="Rect Shape" class="bg-circle-block-shape">

              <div class="login-form bg-white rounded-20">
                <h3>{{__('login_to_your_account')}}</h3>

                <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="mb-30">
                    <label for="email" class="form-label">{{__('email')}} *</label>
                    <input type="text" class="form-control rounded-2" id="email" value="{{ old('email') ?? 'admin@spagreen.net' }}" name="email"  placeholder="{{ __('email') }}" required autofocus>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 nk-block-des text-danger" />
                  </div>
                  <div class="mb-30">
                    <label for="password" class="form-label">{{__('password')}} *</label>
                    <input type="password" class="form-control rounded-2" id="password" placeholder="{{ __('password') }}" value="123456" name="password" required autofocus>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 nk-block-des text-danger" />
                  </div>
                  <div class="mb-30">
                    <div id="html_element" class="g-recaptcha" data-sitekey="6LfEz2YkAAAAAN7F4TrgTRdlAXOs8r3UanKdUfji"></div>
                  </div>
                  <div class="custom-checkbox mb-30">
                    <label>
                        <input type="checkbox" id="remember_me" name="remember">
                        <span>{{__('stay_logged_in')}}</span>
                    </label>
                  </div>
                  <div class="mb-30"><button type="submit" class="btn btn-lg sg-btn-primary d-block w-100">{{__('login')}}</button></div>
                  @if (Route::has('password.request'))
                    <span class="text-center d-block">{{__('forgot_your')}} <a href="{{ route('password.request') }}" class="sg-text-primary">{{__('password')}}</a>?</span>
                  @endif
                </form>
              </div>
          </div>
        </div>
      </div>
    </section>




    <!-- JS Files -->
    <!--====== jQuery ======-->
    <script src="{{ static_asset('admin/js/jquery.min.js') }}"></script>
    <!--====== Bootstrap & Popper JS ======-->
    <script src="{{ static_asset('admin/js/bootstrap.bundle.min.js') }}"></script>
    <!--====== NiceScroll ======-->
    <script src="{{ static_asset('admin/js/jquery.nicescroll.min.js') }}"></script>
    <!--====== Bootstrap-Select JS ======-->
    <script src="{{ static_asset('admin/js/choices.min.js') }}"></script>
    <!--====== Summernote JS ======-->
    <script src="{{ static_asset('admin/js/summernote-lite.min.js') }}"></script>
    <!--====== Dropzone JS ======-->
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
    <!--====== ReCAPTCHA ======-->
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    <!--====== MainJS ======-->
    <script src="{{ static_asset('admin/js/app.js') }}"></script>

    <script type="text/javascript">
      var onloadCallback = function() {
        grecaptcha.render('html_element', {
          'sitekey' : '6LfEz2YkAAAAAN7F4TrgTRdlAXOs8r3UanKdUfji',
          'size' : 'md'
        });
      };
    </script>

  </body>
  </html>
