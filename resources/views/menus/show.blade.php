@extends('layouts.backLayout.designadmin')


@section('content')

<div class="page-wrapper">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Menu</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('menus.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Menu:</strong>
                {{ $menu->menu }}
            </div>
        </div>
        
    </div>

</div>
@endsection