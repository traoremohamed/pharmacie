@extends('layouts.backLayout.designadmin')

@section('content')



@php($Module='Parametre')
@php($titre='Liste des slides')


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
                         <a href="#" class="btn btn-primary font-weight-bolder font-size-sm"
                           aria-haspopup="true" aria-expanded="false" data-toggle="modal"
                           data-target="#exampleModalCustomScrollable"><i class="la la-plus"></i>Ajouter un slide</a>

                        <div class="modal fade" id="exampleModalCustomScrollable" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">

                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ajouter un slide</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i aria-hidden="true" class="ki ki-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div data-scroll="true" data-height="100" align="center">

                                    @can('creation-slide')

                                    <a href="{{ route('creerslides') }}" class="btn btn-success font-weight-bolder font-size-sm" >Slide en image</a>



                                    <a href="{{ route('creerslidesv') }}" class="btn btn-warning font-weight-bolder font-size-sm" >Slide en video</a>

                                    @endcan
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Annuler</button>

                            </div>
                            </div></div></div>
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
                            <th>Titre bouton </th>
                            <th>Lien bouton </th>
                            <th>image</th>
                            <th>statut</th>
                            <th >Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($slides as $key => $slide)
                        <tr>
                            <td>{{ $slide->id_slide }}</td>
                            <td>{{ $slide->titre_slide }}</td>
                            <td>{{ $slide->description_slide }}</td>
                            <td>{{ $slide->libelle_bouton_slide }}</td>
                            <td>{{ $slide->lien_bouton_slide }}</td>
                            <td>
                                <?php if($slide->type_fichier == 'FI') {?>
                                    @if(!empty($slide->image_slide))
                                        <img src="{{ asset('/frontend/slide/'. $slide->image_slide)}}" alt="" style="width:90px;">
                                    @endif
                                <?php }else{ ?>
                                    @if(!empty($slide->image_slide))
                                    <iframe width="45%" height="180"
                                            src="{!! $slide->image_slide !!}"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                    @endif
                                <?php }  ?>
                            </td>
                            <td>
                                <?php if($slide->flag_slide == 1){ ?>
                                    <label class="label label-lg label-success label-inline">Active</label>
                                <?php }else{ ?>
                                    <label class="label label-lg label-warning label-inline">Desactive</label>
                                <?php }  ?>
                            </td>

                            <td align="center">
                                @can('modifcation-slide')

                                <a href="{{ route('modifierslides',\App\Helpers\Crypt::UrlCrypt($slide->id_slide)) }}" class="btn btn-warning btn-xs btn-clean btn-icon"
                                   title="Modifier"> <i class="la la-edit"></i> </a>

                                @endcan

                                @can('active-desative-slide')

                                <?php if($slide->flag_slide == 1){ ?>

                                    <label class="label label-lg label-warning label-inline"><a href="{{ route('desactiveslides',\App\Helpers\Crypt::UrlCrypt($slide->id_slide)) }}"> Desactiver </a></label>

                                <?php }else{ ?>

                                    <label class="label label-lg label-success label-inline"><a href="{{ route('activeslides',\App\Helpers\Crypt::UrlCrypt($slide->id_slide)) }}"> Active </a></label>

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
