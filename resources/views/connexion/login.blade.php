
<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 9 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="fr">
<!--begin::Head-->
<head><base href="../../../../">
    <meta charset="utf-8" />
    <title>Gna  | Connexion</title>
    <meta name="description" content="Login page example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="backend/assets/css/pages/login/classic/login-2.css?v=7.0.5" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="backend/assets/plugins/global/plugins.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
    <link href="backend/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
    <link href="backend/assets/css/style.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="backend/assets/css/themes/layout/header/base/light.css?v=7.0.5" rel="stylesheet" type="text/css" />
    <link href="backend/assets/css/themes/layout/header/menu/light.css?v=7.0.5" rel="stylesheet" type="text/css" />
    <link href="backend/assets/css/themes/layout/brand/dark.css?v=7.0.5" rel="stylesheet" type="text/css" />
    <link href="backend/assets/css/themes/layout/aside/dark.css?v=7.0.5" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="backend/assets/media/logos/logo-letter-1.png" />
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-row-fluid bg-white" id="kt_login">
        <!--begin::Aside-->
        <div class="login-aside order-2 order-lg-1 d-flex flex-column-fluid flex-lg-row-auto bgi-size-cover bgi-no-repeat p-7 p-lg-10">
            <!--begin: Aside Container-->
            <div class="d-flex flex-row-fluid flex-column justify-content-between">
                <!--begin::Aside body-->
                <div class="d-flex flex-column-fluid flex-column flex-center mt-5 mt-lg-0">
                    <a href="#" class="mb-15 text-center">
                        <img src="backend/assets/media/logos/logo-letter-1.png" class="max-h-90px" alt="" />
                    </a>
                    <!--begin::Signin-->
                    <div class="login-form login-signin">
                        <div class="text-center mb-10 mb-lg-20">
                            <p class="text-muted font-weight-bold">Entrer vos identifiants</p>
                        </div>
                        <!--begin::Form-->
                        <form class="form" novalidate="novalidate" id="kt_login_signin_form" method="post"
                              action="{{ url('connexion') }}">
                            {{ csrf_field() }}
                            <!--begin::Title-->
                            <div class="text-center pb-8">
                                <h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Se connecter</h2>
                                <!-- <span class="text-muted font-weight-bold font-size-h4">Ou
                                 <a href="" class="text-primary font-weight-bolder" id="kt_login_signup">Créer un Compte</a></span>
                                 -->
                                @if ($errors->any())

                                <div class="alert alert-custom alert-danger fade show" role="alert">
                                    <div class="alert-text">
                                        <strong> </strong>   Votre Email ou votre mot de passe est incorrect !
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
                            </div>
                            <!--end::Title-->
                            <!--begin::Form group-->
                            <div class="form-group">
                                <label class="font-size-h6 font-weight-bolder text-dark">Identifiant</label>
                                <input class="form-control form-control-solid h-auto py-5 px-6 rounded-lg" placeholder="Identifiant"
                                       required="required"
                                       type="text" name="username" autocomplete="off"/>
                            </div>
                            <!--end::Form group-->
                            <!--begin::Form group-->
                            <div class="form-group">
                                <div class="d-flex justify-content-between mt-n5">
                                    <label class="font-size-h6 font-weight-bolder text-dark pt-5">Mot de passe</label>
                                    <a href="{{ url('motdepasseoublie') }}"
                                       class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5"
                                       id="kt_login_forgot" style="color: #ff8608">Mot de passe oublié ?</a>
                                </div>
                                <input class="form-control form-control-solid h-auto py-5 px-6 rounded-lg"  placeholder="Mot de passe"
                                       required="required"
                                       type="password" name="password" autocomplete="off"/>
                            </div>
                            <div class="form-group ">
                                <div class="captcha">
                                    <span>{!! captcha_img() !!}</span>
                                    <button type="button" class="btn btn-danger" class="reload" id="reload" style="background-color: #ff8608;border-color: #FF8608;color: #FFFFFF">
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
                            <!--begin::Action-->
                            <div class="text-center pt-2">
                                <input type="submit" id="kt_login_signin_submit" name="connecter"
                                       class="btn btn-dark font-weight-bolder font-size-h6 px-8 py-4 my-3"
                                       value="Se connecter" style="background-color: #ff8608;border-color: #FF8608;color: #FFFFFF">
                            </div>
                            <!--end::Action-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Signin-->
                    <!--begin::Signup-->
                    <div class="login-form login-signup">
                        <div class="text-center mb-10 mb-lg-20">
                            <h3 class="">Sign Up</h3>
                            <p class="text-muted font-weight-bold">Enter your details to create your account</p>
                        </div>
                        <!--begin::Form-->
                        <form class="form" novalidate="novalidate" id="kt_login_signup_form">
                            <div class="form-group py-3 m-0">
                                <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="text" placeholder="Fullname" name="fullname" autocomplete="off" />
                            </div>
                            <div class="form-group py-3 border-top m-0">
                                <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="password" placeholder="Email" name="email" autocomplete="off" />
                            </div>
                            <div class="form-group py-3 border-top m-0">
                                <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="password" placeholder="Password" name="password" autocomplete="off" />
                            </div>
                            <div class="form-group py-3 border-top m-0">
                                <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="password" placeholder="Confirm password" name="cpassword" autocomplete="off" />
                            </div>
                            <div class="form-group mt-5">
                                <div class="checkbox-inline">
                                    <label class="checkbox checkbox-outline">
                                        <input type="checkbox" name="agree" />
                                        <span></span>I Agree the
                                        <a href="#" class="ml-1">terms and conditions</a>.</label>
                                </div>
                            </div>
                            <div class="form-group d-flex flex-wrap flex-center">
                                <button id="kt_login_signup_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Submit</button>
                                <button id="kt_login_signup_cancel" class="btn btn-outline-primary font-weight-bold px-9 py-4 my-3 mx-2">Cancel</button>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Signup-->
                    <!--begin::Forgot-->
                    <div class="login-form login-forgot">
                        <div class="text-center mb-10 mb-lg-20">
                            <h3 class="">Forgotten Password ?</h3>
                            <p class="text-muted font-weight-bold">Enter your email to reset your password</p>
                        </div>
                        <!--begin::Form-->
                        <form class="form" novalidate="novalidate" id="kt_login_forgot_form">
                            <div class="form-group py-3 border-bottom mb-10">
                                <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="email" placeholder="Email" name="email" autocomplete="off" />
                            </div>
                            <div class="form-group d-flex flex-wrap flex-center">
                                <button id="kt_login_forgot_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Submit</button>
                                <button id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">Cancel</button>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Forgot-->
                </div>
                <!--end::Aside body-->
                <!--begin: Aside footer for desktop-->
                <div class="d-flex flex-column-auto justify-content-between mt-15">
                    <div class="text-dark-50 font-weight-bold order-2 order-sm-1 my-2">© 20201 GNA-CI</div>
                    <div class="d-flex order-1 order-sm-2 my-2">
                        <a href="#" class="text-muted text-hover-primary">Politique de confidentialité</a>
                        <a href="#" class="text-muted text-hover-primary ml-4">Mention légale</a>
                    </div>
                </div>
                <!--end: Aside footer for desktop-->
            </div>
            <!--end: Aside Container-->
        </div>
        <!--begin::Aside-->
        <!--begin::Content-->
        <div class="order-1 order-lg-2 flex-column-auto flex-lg-row-fluid d-flex flex-column p-7" style="background-image: url(backend/assets/media/bg/bg-4.jpg);">
            <!--begin::Content body-->
            <div class="d-flex flex-column-fluid flex-lg-center">
                <div class="d-flex flex-column justify-content-center">
                    <h3 class="display-3 font-weight-bold my-7 text-white">Bienvenue sur Admin GNA-CI!</h3>
                    <p class="font-weight-bold font-size-lg text-white opacity-80">L'Assurance Toutes Les Générations .</p>
                </div>
            </div>
            <!--end::Content body-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Login-->
</div>
<!--end::Main-->
<script>var HOST_URL = "https://keenthemes.com/metronic/tools/preview";</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="backend/assets/plugins/global/plugins.bundle.js?v=7.0.5"></script>
<script src="backend/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.5"></script>
<script src="backend/assets/js/scripts.bundle.js?v=7.0.5"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Scripts(used by this page)-->
<script src="backend/assets/js/pages/custom/login/login-general.js?v=7.0.5"></script>
<!--end::Page Scripts-->
</body>
<!--end::Body-->
</html>
