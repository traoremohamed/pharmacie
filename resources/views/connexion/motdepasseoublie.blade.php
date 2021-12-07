<!DOCTYPE html>
<html lang="fr">
<!--begin::Head-->
<head>
    <base href="../../../">
    <meta charset="utf-8"/>
    <title>Victoire Immobilier | Connexion</title>
    <meta name="description" content="Login Victoire Immobilier "/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="{{ asset('backend/assets/css/pages/login/login-2.css?v=7.0.5') }}" rel="stylesheet" type="text/css"/>
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ asset('backend/assets/plugins/global/plugins.bundle.css?v=7.0.5') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('backend/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.5') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('backend/assets/css/style.bundle.css?v=7.0.5') }}" rel="stylesheet" type="text/css"/>
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{ asset('backend/assets/css/themes/layout/header/base/light.css?v=7.0.5') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('backend/assets/css/themes/layout/header/menu/light.css?v=7.0.5') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('backend/assets/css/themes/layout/brand/dark.css?v=7.0.5') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('backend/assets/css/themes/layout/aside/dark.css?v=7.0.5') }}" rel="stylesheet"
          type="text/css"/>
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="{{ asset('backend/assets/media/logos/favicon.ico') }}"/>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body"
      class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
        <!--begin::Aside-->
        <div class="login-aside order-2 order-lg-1 d-flex flex-row-auto position-relative overflow-hidden">
            <!--begin: Aside Container-->
            <div class="d-flex flex-column-fluid flex-column justify-content-between py-9 px-7 py-lg-13 px-lg-35">
                <!--begin::Logo-->
                 <a href="#" class="text-center pt-2">
                    <img src="{{ asset('backend/assets/media/logos/logo.png') }}" class="max-h-130px" alt=""/>
                   <br> <img src="{{ asset('backend/assets/media/logos/slogan.png') }}"  class="max-h-65px"alt=""/>
                </a>

                <!--end::Logo-->
                <!--begin::Aside body-->
                <div class="d-flex flex-column-fluid flex-column flex-center">


                        <div class="login-form login-signin py-11">
                            <!--begin::Form-->
                            <form class="form" novalidate="novalidate" id="kt_login_signin_form" method="post"
                                  action="{{ url('motdepasseoublie') }}">
                            {{ csrf_field() }}
                            <!--begin::Title-->
                                <div class="text-center pb-8">
                                    <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Mot de passe oublié ?</h3>
                                    <p class="text-muted font-weight-bold font-size-h5">Veuillez saisir votre identifiant de connexion</p>
                                    <!-- <span class="text-muted font-weight-bold font-size-h4">Ou
                                <a href="" class="text-primary font-weight-bolder" id="kt_login_signup">Créer un Compte</a></span>
                                -->
                                    @if ($errors->any())

                                        <div class="alert alert-custom alert-danger fade show" role="alert">
                                            <div class="alert-text">
                                                <strong> </strong> Votre identifiant ne correspond pas !
                                            </div>
                                            <div class="alert-close">
                                                <button type="button" class="btn-sx close" data-dismiss="alert"
                                                        aria-label="Close">
                                                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                                </button>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($message = Session::get('error'))
                                        <div class="alert alert-custom alert-danger fade show">
                                            {{ $message }}
                                        </div>
                                    @endif
									@if ($message = Session::get('success'))
                                        <div class="alert alert-custom alert-success fade show">
                                            {{ $message }}
                                        </div>
                                    @endif
                                </div>
                                <!--end::Title-->
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <label class="font-size-h6 font-weight-bolder text-dark pt-5">Votre identifiant</label><br>
                                    <input class="form-control form-control-solid h-auto py-5 px-6 rounded-lg" type="text" placeholder="Identifiant" name="username" autocomplete="off" />
                                </div>
								<div class="form-group ">
                                <div class="captcha">
                                    <span>{!! captcha_img() !!}</span>
                                    <button type="button" class="btn btn-danger" class="reload" id="reload">
                                        &#x21bb;
                                    </button>
                                </div>
                            </div>

                            <div class="form-group  ">
                                <div class="d-flex justify-content-between mt-n5">
                                    <label class="font-size-h6 font-weight-bolder text-dark pt-5">Saisir le mot ci-dessus</label>

                                </div>
                                <input id="captcha" type="text" autocomplete="off" class="form-control form-control-solid h-auto py-5 px-6 rounded-lg" placeholder="Vérificateur de sécurité" name="captcha">
                            </div>
                                <!--end::Form group-->
                                <!--begin::Form group-->
                                <div class="form-group d-flex flex-wrap flex-center pb-lg-0 pb-3">

                                    <input type="submit" id="kt_login_signin_submit" name="connecter"
                                           class="btn btn-danger font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4"
                                           value="Envoyer">
                                    <a class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4" href="{{ route('connexion') }}"> Retour</a>
                                </div>
                                <!--end::Form group-->
                            </form>
                            <!--end::Form-->

                        <!--end::Forgot-->
                    </div>

                </div>
                <!--end::Aside body-->
                <!--begin: Aside footer for desktop-->
                <div class="text-center">
                    <a href="{{ url('/') }}"
                       class="btn btn-light-primary font-weight-bolder px-8 py-4 my-3 font-size-h6">

                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/social-icons/google.svg-->
                        <svg xmlns='http://www.w3.org/2000/svg' width='50' height='50' viewBox='0 0 500 500'><title>ionicons-v5-i</title><path
                                d='M80,212V448a16,16,0,0,0,16,16h96V328a24,24,0,0,1,24-24h80a24,24,0,0,1,24,24V464h96a16,16,0,0,0,16-16V212'
                                style='fill:none;stroke:#e20505;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/><path
                                d='M480,256,266.89,52c-5-5.28-16.69-5.34-21.78,0L32,256'
                                style='fill:none;stroke:#e20505;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/><polyline
                                points='400 179 400 64 352 64 352 133'
                                style='fill:none;stroke:#e20505;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/></svg>
                                <!--end::Svg Icon-->
                            </span>Retourner sur le site
                    </a>
                </div>
                <!--end: Aside footer for desktop-->
            </div>
            <!--end: Aside Container-->
        </div>
        <!--begin::Aside-->
        <!--begin::Content-->
        <div class="content order-1 order-lg-2 d-flex flex-column w-100 pb-0" style="background-color: #f6f6f6;">
            <!--begin::Title-->
            <div
                class="d-flex flex-column justify-content-center text-center pt-lg-40 pt-md-5 pt-sm-5 px-lg-0 pt-5 px-7">
                <h3 class="display4 font-weight-bolder my-7 text-dark" style="color: #986923;">Mon espace</h3>
                <p class="font-weight-bolder font-size-h2-md font-size-lg text-dark opacity-70">
                     </p>
            </div>
            <!--end::Title-->
            <!--begin::Image-->
            <div class="content-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"
                 style="background-image: url(backend/assets/media/svg/illustrations/login-visual-2.svg);"></div>
            <!--end::Image-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Login-->
</div>
<!--end::Main-->
<script>var HOST_URL = "https://keenthemes.com/metronic/tools/preview";</script>
<!--begin::Global Config(global config for global JS scripts)-->
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{ asset('backend/assets/plugins/global/plugins.bundle.js?v=7.0.5') }}"></script>
<script src="{{ asset('backend/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.5') }}"></script>
<script src="{{ asset('backend/assets/js/scripts.bundle.js?v=7.0.5') }}"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Scripts(used by this page)-->
<script src="{{ asset('backend/assets/js/pages/custom/login/login-general.js?v=7.0.5') }}"></script>
<!--end::Page Scripts-->
<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });

</script>


</body>
<!--end::Body-->
</html>
