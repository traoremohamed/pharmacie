<?php

use App\Helpers\Crypt;

?>

@extends('layouts.backLayout.designadmin')
@section('content')

<!--debut initiale dashborad-->
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Bienvenue </h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="/dashboard" class="text-muted">Tableau de bord</a>
                        </li>
                        <!--<li class="breadcrumb-item">
                                    <a href="" class="text-muted">Fluid Content</a>
                                </li>-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <?php if ($naroles == "CLIENT") { ?>
                <div class="d-flex align-items-center">
                    <!--begin::Actions-->
                    <a href="{{ route('preference.create') }}" class="btn-sm btn btn-primary"> <i
                            class="la la-plus"></i>Ajouter une préference</a>
                    <!--end::Actions-->

                </div>
            <?php }?>
        </div>
    </div>
    <!--end::Subheader-->
    <div class="container-fluid">

        @if ($message = Session::get('success'))
        <div class="alert alert-custom alert-success fade show">
            {{ $message }}
        </div>
        @endif

    </div>
    <?php if ($nacodes == "COM") { ?>

        @include('dashboard.menu.commerciale')

    <?php } elseif ($nacodes == "ADMIN") { ?>

        @include('dashboard.menu.admin')

    <?php } elseif ($nacodes == "CLIENT") { ?>

        @include('dashboard.menu.client')

    <?php } elseif ($nacodes == "DRMAKET") { ?>

        @include('dashboard.menu.directcometmarke') 
 

    <?php } else { ?>
        @include('dashboard.menu.autre')

    <?php } ?>

</div>

@endsection
