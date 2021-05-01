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
        <form action="{{route('dashbord.users.store')}}" method="post">
            {{ csrf_field() }}
            {{method_field('post')}}
            <div class="form-group">
                <label for="">@lang('site.first_name')</label>
                <input type="text" name="first_name" id="" class="form-control" value="{{old('first_name')}}" >
            </div>
            <div class="form-group">
                <label for="">@lang('site.last_name')</label>
                <input type="text" name="last_name" id="" class="form-control" value="{{old('last_name')}}" >
            </div>
            <div class="form-group">
                <label for="">@lang('site.email')</label>
                <input type="email" name="email" id="" class="form-control" value="{{old('email')}}" >
            </div>
            <div class="form-group">
                <label for="">@lang('site.password')</label>
                <input type="password" name="password" id="" class="form-control" >
            </div>
            <div class="form-group">
                <label for="">@lang('site.password_confirmation')</label>
                <input type="password" name="password_confirmation" id="" class="form-control" >
            </div>
            <div class="form-group">
                <label>@lang('site.permissions')</label>
                <div class="nav-tabs-custom">

                    @php
                        $models = ['users', 'categories', 'products', 'clients', 'orders'];
                        $maps = ['create', 'read', 'update', 'delete'];
                    @endphp

                    <ul class="nav nav-tabs">
                        @foreach ($models as $index=>$model)
                            <li class="{{ $index == 0 ? 'active' : '' }}"><a href="#{{ $model }}" data-toggle="tab">@lang('site.' . $model)</a></li>
                        @endforeach
                    </ul>

                    <div class="tab-content">

                        @foreach ($models as $index=>$model)

                            <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{ $model }}">

                                @foreach ($maps as $map)
                                    <label><input type="checkbox" name="permissions[]" value="{{ $map . '_' . $model }}"> @lang('site.' . $map)</label>
                                @endforeach

                            </div>

                        @endforeach

                    </div><!-- end of tab content -->

                </div><!-- end of nav tabs -->

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
