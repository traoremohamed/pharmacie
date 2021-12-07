@extends('layouts.backLayout.designadmin')

@section('content')



@php($Module='Parametre')
@php($titre='Liste des produits')


<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{$titre}}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a   class="text-muted">{{$Module}}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a   class="text-muted">{{$titre}}</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->

        </div>
    </div>

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">

            <!--begin::Entry-->
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif

            @if ($message = Session::get('errors'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
            @endif

            <!--end::Notice-->
            <!--begin::Card-->
            <div class="card card-custom" style="width: 100%">
                <div class="card-header">
                    <div class="card-title">
      											<span class="card-icon">
      												<i class="flaticon2-favourite text-primary"></i>
      											</span>
                        <h3 class="card-label">{{$titre}}</h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                            <button type="button" class="btn btn-sm btn-light-primary font-weight-bolder dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i>Exporter
                            </button>
                            <!--begin::Dropdown Menu-->
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <ul class="nav flex-column nav-hover">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon la la-print"></i>
                                            <span class="nav-text">Imprimer</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon la la-file-text-o"></i>
                                            <span class="nav-text">CSV</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon la la-file-pdf-o"></i>
                                            <span class="nav-text">PDF</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!--end::Dropdown Menu-->
                        </div>
                        <!--end::Dropdown-->
                        <!--begin::Button-->
                        @can('creer-produit')
                        <a href="{{ route('creerproductservice') }}" class="btn btn-sm btn-primary font-weight-bolder">
                            <i class="la la-plus"></i>Ajouter un produit</a>
                        @endcan
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable"
                           style="margin-top: 13px !important">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>titre </th>
                            <th>description </th>
                            <th>image</th>
                            <th>image</th>
                            <th>statut</th>
                            <th >Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($produits as $key => $produit)
                        <tr>
                            <td>{{ $produit->id_produit }}</td>
                            <td>{{ $produit->titre_produit }}</td>
                            <td>{{ $produit->description_produit }}</td>
                            <td>
                                @if(!empty($produit->icon_produit))
                                <img src="{{ asset('/frontend/produit/icon/'. $produit->icon_produit)}}" alt="" style="width:90px;">
                                @endif
                            </td>
                            <td>
                                @if(!empty($produit->image_produit))
                                <img src="{{ asset('/frontend/produit/image/'. $produit->image_produit)}}" alt="" style="width:90px;">
                                @endif
                            </td>
                            <td>
                                <?php if($produit->flag_produit == 1){ ?>
                                    <label class="label label-lg label-success label-inline">Active</label>
                                <?php }else{ ?>
                                    <label class="label label-lg label-warning label-inline">Desactive</label>
                                <?php }  ?>
                            </td>

                            <td align="center">
                                @can('modifcation-produit')

                                <a href="{{ route('modifierproductservice',\App\Helpers\Crypt::UrlCrypt($produit->id_produit)) }}" class="btn btn-warning btn-xs btn-clean btn-icon"
                                   title="Modifier"> <i class="la la-edit"></i> </a>

                                @endcan

                                @can('active-desative-produit')

                                <?php if($produit->flag_produit == 1){ ?>

                                    <label class="label label-lg label-warning label-inline"><a href="{{ route('desactiveproductservice',\App\Helpers\Crypt::UrlCrypt($produit->id_produit)) }}" style="color: #FFFFFF"> Desactiver </a></label>

                                <?php }else{ ?>

                                    <label class="label label-lg label-success label-inline"><a href="{{ route('activeproductservice',\App\Helpers\Crypt::UrlCrypt($produit->id_produit)) }}" style="color: #FFFFFF"> Active </a></label>

                                <?php }  ?>

                                @endcan

                                @can('produit-phare-active-desactive')

                                <?php if($produit->flag_produit_phare == 1){ ?>

                                    <label class="label label-lg label-secondary label-inline"><a href="{{ route('desactiveproduitphare',\App\Helpers\Crypt::UrlCrypt($produit->id_produit)) }}" style="color: #FFFFFF"> Desactiver produit pahre </a></label>

                                <?php }else{ ?>

                                    <label class="label label-lg label-primary label-inline"><a href="{{ route('activeproduitphare',\App\Helpers\Crypt::UrlCrypt($produit->id_produit)) }}" style="color: #FFFFFF"> Active produit phare </a></label>

                                <?php }  ?>

                                @endcan
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->

</div>

@endsection
