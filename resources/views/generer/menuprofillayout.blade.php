@extends('layouts.backLayout.designadmin')

@section('content')



     @php($Module='Parametre')
           @php($titre='Attribution du profil:')
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
                             {{ $message }}
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

                                   <h4 class="card-label">{{ $nomprof }}</h4>
                               </div>
             <form action="{{ route('menuprofillayout',$role->id) }}" method="POST" enctype="multipart/form-data" >
             @csrf
                               <div class="card-toolbar">

                            <!--begin::Button-->
                                @can('role-create')

<button type="submit" class="btn btn-sm btn-primary font-weight-bolder"> <i class="la la-plus"></i>Attribuer
</button>

                           @endcan
                            <!--end::Button-->
                               </div>
                           </div>


											<div class="card-body">
												<!--begin::Accordion-->
												<div class="accordion accordion-toggle-arrow" id="accordionExample4">
												<?php $i=0; foreach ($tablsm as $key => $tablvue) { $i++;?>
													<div class="card">
														<div class="card-header" id="headingOne4">
															<div class="card-title" data-toggle="collapse" data-target="#collapseOne4<?php echo $key; ?>">
															<i class="flaticon2-layers-1"></i>{{ $tablvue[0]->menu }}</div>
														</div>
														<div id="collapseOne4<?php echo $key; ?>" class="collapse" data-parent="#accordionExample4">
														 <?php foreach ( $tablvue as $key => $vue) { ?>
															<div class="card-body">
															 <div class="checkbox-list">
                                                             															<label class="checkbox">
                                                             															<input type="checkbox"  value="<?php echo $vue->id_sousmenu;?>" <?php if(in_array ($vue->id_sousmenu, $roleSousmenus)) {echo 'checked';}?> name="route[<?php echo $vue->id_sousmenu;?>]" id="route<?php echo $vue->id_sousmenu;?>" />
                                                             															<span></span><?php echo    $vue->libelle; ?></label>

                                                             															</div>
															</div>
														 <?php  } ?>
														</div>
													</div>
													  <?php  } ?>
												</div>
												<!--end::Accordion-->

											</div>
										</div>

 </form>
                       <!--end::Card-->
                   </div>
                   <!--end::Container-->
               </div>
               <!--end::Entry-->

           </div>

@endsection
