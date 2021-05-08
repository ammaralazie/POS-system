@extends('layouts.dashbord.app')

@section('content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.users')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashbord.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashbord.users.index') }}"><i class="fa fa-dashboard"></i> @lang('site.users')</a></li>
            <li class=""><i class="fa fa-dashboard"></i> @lang('site.add')</li>
        </ol>
    </section>


    <section class="content">

        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">@lang('site.add')</h3>
            </div>
        </div><!-- / box primary -->
        @include('partials._errors')
        <form action="{{route('dashbord.clients.store')}}" method="post">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="">@lang('site.name')</label>
                <input type="text" name="name" id="" class="form-control" value="{{old('name')}}" >
            </div>
            <div class="form-group">
                <label for="">@lang('site.phone')</label>
                <input type="text" name="phone[]" id="" class="form-control"  >
            </div>
            <div class="form-group">
                <label for="">@lang('site.phone')</label>
                <input type="text" name="phone[]" id="" class="form-control"  >
            </div>
            <div class="form-group">
                <label for="">@lang('site.address')</label>
                <input type="text" name="address" id="" class="form-control" value="{{old('address')}}" >
            </div>



            <div class="form-group">
                <button class="btn btn-primary">
                    <i class="fa fa-plus">&ThinSpace;@lang('site.add')</i>
                </button>
            </div>
        </form>
    </section><!-- end of content -->

</div><!-- end of content wrapper -->


@endsection
