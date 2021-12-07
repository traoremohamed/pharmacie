@extends('layouts.backLayout.designadmin')

@section('content')



@php($Module='Parametre')
@php($titre='Liste des personnels')


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
                        @can('creation-personnel')
                        <a href="{{ route('creerpersonnel') }}" class="btn btn-sm btn-primary font-weight-bolder">
                            <i class="la la-plus"></i>Ajouter un personnel</a>
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
                            <th>Nom et prenom </th>
                            <th>Fonction </th>
                            <th>Mots </th>
                            <th>Date debut fonction </th>
                            <th>Date fin fonction </th>
                            <th>image</th>
                            <th>statut</th>
                            <th >Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($personnels as $key => $personnel)
                        <tr>
                            <td>{{ $personnel->id_personnel  }}</td>
                            <td>{{ $personnel->nom_personnel }} {{ $personnel->prenom_personnel }}</td>
                            <td>{{ $personnel->fonction_personnel }}</td>
                            <td>{{ $personnel->mot_personnel }}</td>
                            <td>{{ $personnel->date_debut_fonction }}</td>
                            <td>{{ $personnel->date_fin_fonction }}</td>
                            <td>
                                @if(!empty($personnel->image_personnel))

                                  <img src="{{ asset('/frontend/imagepersonnel/'. $personnel->image_personnel)}}" alt="" style="width:90px;">

                                @endif

                            </td>
                            <td>
                                <?php if($personnel->flag_personnel == 1){ ?>
                                    <label class="label label-lg label-success label-inline">Active</label>
                                <?php }else{ ?>
                                    <label class="label label-lg label-warning label-inline">Desactive</label>
                                <?php }  ?>
                            </td>

                            <td align="center">
                                @can('modifcation-personnel')

                                <a href="{{ route('modifierpersonnel',\App\Helpers\Crypt::UrlCrypt($personnel->id_personnel )) }}" class="btn btn-warning btn-xs btn-clean btn-icon"
                                   title="Modifier"> <i class="la la-edit"></i> </a>

                                @endcan

                                @can('active-desactive-personnel')

                                <?php if($personnel->flag_personnel == 1){ ?>

                                    <label class="label label-lg label-warning label-inline"><a href="{{ route('desactivepersonnel',\App\Helpers\Crypt::UrlCrypt($personnel->id_personnel )) }}"> Desactiver </a></label>

                                <?php }else{ ?>

                                    <label class="label label-lg label-success label-inline"><a href="{{ route('activepersonnel',\App\Helpers\Crypt::UrlCrypt($personnel->id_personnel )) }}"> Active </a></label>

                                <?php }  ?>


                                @endcan

                                @can('active-desactive-personnelres')

                                <?php if($personnel->flag_actif_responsable == 1){ ?>

                                    <label class="label label-lg label-secondary label-inline"><a href="{{ route('desactivepersonnelres',\App\Helpers\Crypt::UrlCrypt($personnel->id_personnel )) }}"> Desactiver personnel responsable </a></label>

                                <?php }else{ ?>

                                    <label class="label label-lg label-primary label-inline"><a href="{{ route('activepersonnelres',\App\Helpers\Crypt::UrlCrypt($personnel->id_personnel )) }}"> Active personnel responsable </a></label>

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
