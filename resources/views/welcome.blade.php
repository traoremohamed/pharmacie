<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8"/>
    <title>Victoire Immobilier</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="email" content="info@victoirimmobilier.ci"/>
    <meta name="website" content="http://www.victoireimmobilier.ci"/>
    <link rel="shortcut icon" href="fontend/images/favicon.ico">
    <!-- Bootstrap -->
    <link href="fontend/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Magnific -->
    <link href="fontend/css/magnific-popup.css" rel="stylesheet" type="text/css"/>
    <!-- Icons -->
    <link href="fontend/css/materialdesignicons.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <!-- Slider -->
    <link rel="stylesheet" href="fontend/css/owl.carousel.min.css"/>
    <link rel="stylesheet" href="fontend/css/owl.theme.default.min.css"/>
    <!-- Main Css -->
    <link href="fontend/css/style.css" rel="stylesheet" type="text/css" id="theme-opt"/>
    <link href="fontend/css/colors/default.css" rel="stylesheet" id="color-opt">

</head>

<body>

<div id="preloader">
    <div id="status" align="center">
        <img src="fontend/images/logo-light.png" width="250px">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>
</div>

<!-- Navbar STart -->
<header id="topnav" class="defaultscroll sticky">
    <div class="container">
        <!-- Logo container-->
        <div>
            <a class="logo" href="#">
                <img src="fontend/images/logo-light.png" class="l-dark" height="24" alt="">
                <img src="fontend/images/logo-light.png" class="l-light" height="70" alt="">
            </a>
        </div>
        <div class="buy-button">
        <!--<a href="{{ url('reservation') }}">
            <div class="btn btn-primary login-btn-primary">RESERVATION</div>
                <div class="btn btn-light login-btn-light">RESERVATION</div>
            </a>-->
			
			<?php
                         if (Auth::check()) {?>
                            <a href="{{ url('dashboard') }}">
                                 <div class="btn btn-primary login-btn-primary">Tableau de bord</div>
								 <div class="btn btn-light login-btn-light">Tableau de bord</div>
                            </a>
                           <?php } else {?>
                            <a href="{{ url('connexion') }}">
                                <div class="btn btn-primary login-btn-primary">MON ESPACE</div>
								<div class="btn btn-light login-btn-light">MON ESPACE</div>
                            </a>
                        <?php }?>
           


        </div><!--end login button-->
        <!-- End Logo container-->
        <div class="menu-extras">
            <div class="menu-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </div>
        </div>

        <div id="navigation">

            <div class="buy-menu-btn d-none">
				<?php
                         if (Auth::check()) {?>
                            <a href="{{ url('dashboard') }} "class="btn btn-primary">Tableau de bord</a>
                           <?php } else {?>
                            <a href="{{ url('connexion') }}" class="btn btn-primary">MON ESPACE </a>
                        <?php }?>
               
            </div><!--end login button-->
        </div><!--end navigation-->
    </div><!--end container-->
</header><!--end header-->
<!-- Navbar End -->

<!-- Hero Start -->
<section class="bg-half-170 pb-0 bg-primary d-table w-100"
         style="background: url('fontend/images/bg2.png') center center;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 col-md-6">
                <div class="title-heading">
                    <h4 class="text-white-50">Bienvenue</h4>
                    <h4 class="heading text-white title-dark"> Trouver un bel endroit <br> ou Vivre </h4>
                    <p class="para-desc text-white-50">Achetez ou Louez des Biens à des Prix Génial.</p>
                    <div class="mt-4 pt-2">
                        <a href="http://victoireimmobilier.ci/nos-offres" target="blank" class="btn btn-light">Consulter nos offres</a>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-5 col-md-6 mt-5 mt-sm-0">
                <img src="fontend/images/hero1.png" class="img-fluid" alt="">
            </div>
        </div><!--end row-->
    </div> <!--end container-->
</section><!--end section-->
<!-- Hero End -->

<!-- Partners start -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row justify-content-center">

        </div><!--end col-->
    </div><!--end row-->
</section><!--end section-->
<!-- Partners End -->

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="section-title mb-4 pb-2">
                    <h4 class="title mb-4">Les Services de <span class="text-primary font-weight-bold">Victoire Immobilier</span>
                    </h4>
                    <p class="text-muted para-desc mb-0 mx-auto">Vous êtes acheteur, vendeur, investisseur,
                        locataire,... <span class="text-primary font-weight-bold"></span> Nous développons pour vous sur
                        tout le territoire des prestations dédiées à tout type de projet.</p>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-lg-3 col-md-4 mt-4 pt-2">
                <div
                    class="card features fea-primary rounded p-4 bg-light text-center position-relative overflow-hidden border-0">
                            <span class="h1 icon2 text-primary">
                                <img src="fontend/images/gestion-01.svg" class="iconini" alt="">
                                <!--<i class="uil uil-chart-line"></i>-->
                            </span>
                    <div class="card-body p-0 content">
                        <h5>Gestion Immobilière</h5>
                        <p class="para text-muted mb-0">Assurer le rendement maximal de votre bien tout en sécurisant
                            vos revenus.</p>
                    </div>
                    <span class="big-icon text-center">
                                <i class="uil uil-chart-line"></i>
                            </span>
                </div>
            </div><!--end col-->

            <div class="col-lg-3 col-md-4 mt-4 pt-2">
                <div
                    class="card features fea-primary rounded p-4 bg-light text-center position-relative overflow-hidden border-0">
                            <span class="h1 icon2 text-primary">
                                  <img src="fontend/images/achatvente.svg" class="iconini" alt="">
                            </span>
                    <div class="card-body p-0 content">
                        <h5>Achat / Vente</h5>
                        <p class="para text-muted mb-0">Annonces immobilières de biens à vendre.<br/> <br/></p>
                    </div>
                    <span class="big-icon text-center">
                                <i class="uil uil-crosshairs"></i>
                            </span>
                </div>
            </div><!--end col-->

            <div class="col-lg-3 col-md-4 mt-4 pt-2">
                <div
                    class="card features fea-primary rounded p-4 bg-light text-center position-relative overflow-hidden border-0">
                            <span class="h1 icon2 text-primary">
                                <img src="fontend/images/location.svg" class="iconini" alt="">
                            </span>
                    <div class="card-body p-0 content">
                        <h5>Location</h5>
                        <p class="para text-muted mb-0">Victoire Immobilier permet de trouver rapidement une maison.</p>
                    </div>
                    <span class="big-icon text-center">
                                <i class="uil uil-airplay"></i>
                            </span>
                </div>
            </div><!--end col-->

            <div class="col-lg-3 col-md-4 mt-4 pt-2">
                <div
                    class="card features fea-primary rounded p-4 bg-light text-center position-relative overflow-hidden border-0">
                            <span class="h1 icon2 text-primary">
                                <img src="fontend/images/construction-01.svg" class="iconini" alt="">
                            </span>
                    <div class="card-body p-0 content">
                        <h5>Construction <br> Renovation</h5>
                        <p class="para text-muted mb-0">En neuf ou en rénovation, notre entreprise réalise des travaux
                            de maçonnerie..</p>
                    </div>
                    <span class="big-icon text-center">
                                <i class="uil uil-rocket"></i>
                            </span>
                </div>
            </div><!--end col-->


            <div class="col-lg-12 text-center col-md-4 mt-4 pt-2">
                <a href="http://victoireimmobilier.ci/nos-prestations"  target="blank" class="btn btn-primary">Voir plus <i data-feather="arrow-right"
                                                                                  class="fea icon-sm"></i></a>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->

    <!-- About Start -->
    <div class="container mt-100 mt-60">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-6 mt-4 mt-lg-0 pt-2 pt-lg-0">
                        <div class="card work-container work-modern overflow-hidden rounded border-0 shadow-md">
                            <div class="card-body p-0">
                                <img src="fontend/images/course/online/ab01.jpg" class="img-fluid"
                                     alt="work-image">
                                <div class="overlay-work bg-dark"></div>
                                <div class="content">
                                    <a href="javascript:void(0)" class="title text-white d-block font-weight-bold">Gestion
                                        Locative</a>
                                    <small class="text-light"></small>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-lg-6 col-6">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 mt-4 mt-lg-0 pt-2 pt-lg-0">
                                <div class="card work-container work-modern overflow-hidden rounded border-0 shadow-md">
                                    <div class="card-body p-0">
                                        <img src="fontend/images/course/online/ab02.jpg"
                                             class="img-fluid" alt="work-image">
                                        <div class="overlay-work bg-dark"></div>
                                        <div class="content">
                                            <a href="javascript:void(0)"
                                               class="title text-white d-block font-weight-bold">Victoire Immobilier</a>
                                            <small class="text-light">Agence Immobilière</small>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end col-->

                            <div class="col-lg-12 col-md-12 mt-4 pt-2">
                                <div class="card work-container work-modern overflow-hidden rounded border-0 shadow-md">
                                    <div class="card-body p-0">
                                        <img src="fontend/images/course/online/ab03.jpg"
                                             class="img-fluid" alt="work-image">
                                        <div class="overlay-work bg-dark"></div>
                                        <div class="content">
                                            <a href="javascript:void(0)"
                                               class="title text-white d-block font-weight-bold">Des Agens toujours à
                                                l'écoute</a>
                                            <small class="text-light"></small>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end col-->

            <div class="col-lg-6 col-md-6 mt-4 mt-lg-0 pt- pt-lg-0">
                <div class="ml-lg-4">
                    <div class="section-title mb-4 pb-2">
                        <h4 class="title mb-4">VICTOIRE IMMOBILIER</h4>
                        <p class="text-muted para-desc">Fondée par Mr. ESSOH ARNAUD, La Société <span
                                class="text-primary font-weight-bold">VICTOIRE IMMOBILIER</span> implantée à Abidjan
                            Cocody II plateaux Angré 8-ème tranche est spécialiste dans la construction de promotions
                            immobilières, la vente de terrains, la réhabilitation et la gestion de biens de
                            particuliers.</p>
                        <p class="text-muted para-desc">Créée en Côte d’Ivoire depuis 10 ans, après une bonne expérience
                            bien fournie, elle est dirigée par une équipe compétente, jeune, dynamique et disponible à
                            tout moment afin de répondre aux attentes de la clientèle.<br/></p>
                        <p class="text-muted para-desc mb-0">De même, elle se positionne dans le domaine de
                            l’immobilier, plus précisément dans la construction de promotions, l’aménagement et la vente
                            de terrains nus, enfin la réhabilitation de bâtiments pour la gestion locative ou la
                            vente.</p>
                    </div>

                    <ul class="list-unstyled text-muted">
                        <li class="mb-0"><span class="text-primary h4 mr-2"><i class="uim uim-check-circle"></i></span>PROFESSIONNALISME
                        </li>
                        <li class="mb-0"><span class="text-primary h4 mr-2"><i class="uim uim-check-circle"></i></span>EXPERTISE
                        </li>
                        <li class="mb-0"><span class="text-primary h4 mr-2"><i class="uim uim-check-circle"></i></span>ACCOMPAGNEMENT
                        </li>
                    </ul>

                    <div class="watch-video mt-4 pt-2">
                        <a href="#" target="_blank" class="btn btn-primary mb-2">Lire plus
                            <i data-feather="chevron-right" class="fea icon-sm"></i></a>
                        <a href="#"
                           class="video-play-icon watch text-dark mb-2 ml-2"><i
                                class="mdi mdi-play play-icon-circle text-center d-inline-block mr-2 rounded-circle title-dark text-white position-relative play play-iconbar"></i>
                            Regarder la vidéo !</a>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->

<section class="section bg-light">
    <div class="container">
        <div class="row align-items-center mb-4 pb-2">
            <div class="col-lg-6">
                <div class="section-title text-center text-lg-left">
                    <h6 class="text-primary">Actualités</h6>
                    <h4 class="title mb-4 mb-lg-0">Nos Actualités <br> Immobilières</h4>
                </div>
            </div><!--end col-->

            <div class="col-lg-6">
                <div class="section-title text-center text-lg-left">
                    <p class="text-muted mb-0 mx-auto para-desc">Retrouvez-nous partout, <span
                            class="text-primary font-weight-bold"></span> que ce soit avec votre téléphone, votre
                        tablette ou bien votre ordinateur avec une navigation pensée et enrichie pour votre appareil.
                    </p>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-lg-4 col-md-6 mt-4 pt-2">
                <div class="card blog rounded border-0 shadow">
                    <div class="position-relative">
                        <img src="fontend/images/blog/01.jpg" class="card-img-top rounded-top" alt="...">
                        <div class="overlay rounded-top bg-dark"></div>
                    </div>
                    <div class="card-body content">
                        <h5><a href="javascript:void(0)" class="card-title title text-dark"> Le Secteur de l'immobilier
                                en Côte D'Ivoire </a></h5>
                        <div class="post-meta d-flex justify-content-between mt-3">
                            <ul class="list-unstyled mb-0">
                                <li class="list-inline-item mr-2 mb-0"><a href="javascript:void(0)"
                                                                          class="text-muted like"><i
                                            class="mdi mdi-heart-outline mr-1"></i>33</a></li>
                                <li class="list-inline-item"><a href="javascript:void(0)" class="text-muted comments"><i
                                            class="mdi mdi-comment-outline mr-1"></i>08</a></li>
                            </ul>
                            <a href="#" class="text-muted readmore">Lire plus <i class="mdi mdi-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="author">
                        <small class="text-light user d-block"><i class="mdi mdi-account"></i> Calvin Carlo</small>
                        <small class="text-light date"><i class="mdi mdi-calendar-check"></i> 13 Aout, 2020</small>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-4 col-md-6 mt-4 pt-2">
                <div class="card blog rounded border-0 shadow">
                    <div class="position-relative">
                        <img src="fontend/images/blog/02.jpg" class="card-img-top rounded-top" alt="...">
                        <div class="overlay rounded-top bg-dark"></div>
                    </div>
                    <div class="card-body content">
                        <h5><a href="javascript:void(0)" class="card-title title text-dark">Rubrique infos générales sur
                                Victoire IMO 2</a></h5>
                        <div class="post-meta d-flex justify-content-between mt-3">
                            <ul class="list-unstyled mb-0">
                                <li class="list-inline-item mr-2 mb-0"><a href="javascript:void(0)"
                                                                          class="text-muted like"><i
                                            class="mdi mdi-heart-outline mr-1"></i>33</a></li>
                                <li class="list-inline-item"><a href="javascript:void(0)" class="text-muted comments"><i
                                            class="mdi mdi-comment-outline mr-1"></i>08</a></li>
                            </ul>
                            <a href="#" class="text-muted readmore">Lire plus <i class="mdi mdi-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="author">
                        <small class="text-light user d-block"><i class="mdi mdi-account"></i> Calvin Carlo</small>
                        <small class="text-light date"><i class="mdi mdi-calendar-check"></i> 13 Aout, 2020</small>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-4 col-md-6 mt-4 pt-2">
                <div class="card blog rounded border-0 shadow">
                    <div class="position-relative">
                        <img src="fontend/images/blog/03.jpg" class="card-img-top rounded-top" alt="...">
                        <div class="overlay rounded-top bg-dark"></div>
                    </div>
                    <div class="card-body content">
                        <h5><a href="javascript:void(0)" class="card-title title text-dark">Rubrique infos générales sur
                                Victoire IMO 3</a></h5>
                        <div class="post-meta d-flex justify-content-between mt-3">
                            <ul class="list-unstyled mb-0">
                                <li class="list-inline-item mr-2 mb-0"><a href="javascript:void(0)"
                                                                          class="text-muted like"><i
                                            class="mdi mdi-heart-outline mr-1"></i>33</a></li>
                                <li class="list-inline-item"><a href="javascript:void(0)" class="text-muted comments"><i
                                            class="mdi mdi-comment-outline mr-1"></i>08</a></li>
                            </ul>
                            <a href="#" class="text-muted readmore">Lire plus <i class="mdi mdi-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="author">
                        <small class="text-light user d-block"><i class="mdi mdi-account"></i> Calvin Carlo</small>
                        <small class="text-light date"><i class="mdi mdi-calendar-check"></i> 13 Aout, 2020</small>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->

<!-- Footer Start -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-12 mb-0 mb-md-4 pb-0 pb-md-2">
                <a href="#" class="logo-footer">
                    <img src="fontend/images/logo-light.png" height="50" alt="">
                </a>
                <p class="mt-4">Nos Coordonnées.</p>
                <p>Angré, 8ème Tranche Carrefour Fred & Poppée<br>
                    à 200m dans le sens de la 7ème tranche.<br>
                    Boite postale : 503 BPR 18 Abidjan LWP 503<br>
                    Tél. : <a href="tel:+(225) 22 01 63 22">+(225) 22 01 63 22</a><br>
                    Email :&nbsp;<a href="mailto:contact@immobilier-trets.com">info@victoireimmobilier.ci</a></p>
                <ul class="list-unstyled social-icon social mb-0 mt-4">
                    <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="facebook"
                                                                                                 class="fea icon-sm fea-social"></i></a>
                    </li>
                    <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i
                                data-feather="instagram" class="fea icon-sm fea-social"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="twitter"
                                                                                                 class="fea icon-sm fea-social"></i></a>
                    </li>
                    <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="linkedin"
                                                                                                 class="fea icon-sm fea-social"></i></a>
                    </li>
                </ul><!--end icon-->
            </div><!--end col-->

            <div class="col-lg-2 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <h4 class="text-light footer-head">Biens à la vente</h4>
                <ul class="list-unstyled footer-list mt-4">
                    <li><a href="#" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Achat Maison</a></li>
                    <li><a href="#" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Achat Appartement</a>
                    </li>
                    <li><a href="#" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Location Maison</a>
                    </li>
                    <li><a href="#" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Location
                            Appartement</a></li>
                    <li><a href="#" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Faite gérer</a></li>
                </ul>
            </div><!--end col-->

            <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <h4 class="text-light footer-head">Infos Utiles</h4>
                <ul class="list-unstyled footer-list mt-4">
                    <li><a href="#" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Mentions légales</a>
                    </li>
                    <li><a href="#" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Liens utiles</a></li>
                    <li><a href="#" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Liens utiles</a></li>
                    <li><a href="#" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Liens utiles</a></li>
                    <li><a href="#" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Liens utiles</a></li>
                </ul>
            </div><!--end col-->

            <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <h4 class="text-light footer-head"> Abonnez Vous</h4>
                <p class="mt-4">Recevez les annonces immobilières publiées par notre agence !.</p>
                <form>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="foot-subscribe form-group position-relative">
                                <label>Écrivez votre email <span class="text-danger">*</span></label>
                                <i data-feather="mail" class="fea icon-sm icons"></i>
                                <input type="email" name="email" id="emailsubscribe" class="form-control pl-5 rounded"
                                       placeholder="Votre email : " required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input type="submit" id="submitsubscribe" name="send" class="btn btn-soft-primary btn-block"
                                   value="Valider">
                        </div>
                    </div>
                </form>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</footer><!--end footer-->
<footer class="footer footer-bar">
    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="text-sm-left">
                    <p class="mb-0">© 2020 Victoire Immobilier – tous droits réservés.</p>
                </div>
            </div><!--end col-->

            <div class="col-sm-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <ul class="list-unstyled text-sm-right mb-0">

                    <li class="list-inline-item"><a href="javascript:void(0)"><img
                                src="fontend/images/payments/american-ex.png" class="avatar avatar-ex-sm"
                                title="American Express" alt=""></a></li>
                    <li class="list-inline-item"><a href="javascript:void(0)"><img
                                src="fontend/images/payments/discover.png" class="avatar avatar-ex-sm"
                                title="Discover" alt=""></a></li>
                    <li class="list-inline-item"><a href="javascript:void(0)"><img
                                src="fontend/images/payments/master-card.png" class="avatar avatar-ex-sm"
                                title="Master Card" alt=""></a></li>
                    <li class="list-inline-item"><a href="javascript:void(0)"><img
                                src="fontend/images/payments/paypal.png" class="avatar avatar-ex-sm"
                                title="Paypal" alt=""></a></li>
                    <li class="list-inline-item"><a href="javascript:void(0)"><img
                                src="fontend/images/payments/visa.png" class="avatar avatar-ex-sm"
                                title="Visa" alt=""></a></li>
                </ul>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</footer><!--end footer-->
<!-- Footer End -->


<!-- Back to top -->
<a href="#" class="btn btn-icon btn-soft-primary back-to-top"><i data-feather="arrow-up" class="icons"></i></a>
<!-- Back to top -->


<!-- javascript -->
<script src="/fontend/js/jquery-3.5.1.min.js"></script>
<script src="/fontend/js/bootstrap.bundle.min.js"></script>
<script src="fontend/js/jquery.easing.min.js"></script>
<script src="fontend/js/scrollspy.min.js"></script>
<!-- SLIDER -->
<script src="fontend/js/owl.carousel.min.js"></script>
<script src="fontend/js/owl.init.js"></script>
<!-- Magnific Popup -->
<script src="fontend/js/jquery.magnific-popup.min.js"></script>
<script src="fontend/js/magnific.init.js"></script>
<!-- Counter -->
<script src="fontend/js/counter.init.js"></script>
<!-- Icons -->
<script src="fontend/js/feather.min.js"></script>
<script src="https://unicons.iconscout.com/release/v2.1.9/script/monochrome/bundle.js"></script>
<!-- Main Js -->
<script src="fontend/js/app.js"></script>
</body>
</html>















