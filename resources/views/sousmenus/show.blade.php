@extends('layouts.backLayout.designadmin')


@section('content')

<div class="page-wrapper">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Sous Menu</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('sousmenus.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Sous Menu:</strong>
                {{ $sousmenus->sousmenu }}
            </div>
            <div class="form-group">
                <strong>Libelle :</strong>
                {{ $sousmenus->libelle }}
            </div>
        </div>
        
    </div>

</div>
@endsection