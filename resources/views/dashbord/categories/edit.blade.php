@extends('layouts.dashbord.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.users')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashbord.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a href="{{ route('dashbord.users.index') }}"><i class="fa fa-dashboard"></i> @lang('site.users')</a>
                </li>
                <li class=""><i class="fa fa-dashboard"></i> @lang('site.edit')</li>
            </ol>
        </section>


        <section class="content">

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div>
            </div><!-- / box primary -->
            @include('partials._errors')
            <form action="{{ route('dashbord.categories.update', ['id' => $category->id]) }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="">@lang('site.name')</label>
                    <input type="text" name="name" id="" class="form-control" value="{{ $category->name }}">
                </div>



               {{-- <div class="form-group">
                    <label>@lang('site.permissions')</label>
                    <div class="nav-tabs-custom">

                        @php
                            $models = ['users', 'categories', 'products', 'clients', 'orders'];
                            $maps = ['create', 'read', 'update', 'delete'];
                        @endphp

                        <ul class="nav nav-tabs">
                            @foreach ($models as $index => $model)
                                <li class="{{ $index == 0 ? 'active' : '' }}"><a href="#{{ $model }}"
                                        data-toggle="tab">@lang('site.' . $model)</a></li>
                            @endforeach
                        </ul>

                        <div class="tab-content">

                            @foreach ($models as $index => $model)

                                <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{ $model }}">

                                    @foreach ($maps as $map)
                                        <label><input type="checkbox" name="permissions[]"
                                                {{ $user->hasPermission($map . '_' . $model) ? 'checked' : '' }}
                                                value="{{ $map . '_' . $model }}"> @lang('site.' . $map)</label>
                                    @endforeach

                                </div>

                            @endforeach

                        </div><!-- end of tab content -->

                    </div><!-- end of nav tabs -->

                </div>
                --}}
                <div class="form-group">
                    <button class="btn btn-primary">
                        <i class="fa fa-edit">&ThinSpace;@lang('site.edit')</i>
                    </button>
                </div>
            </form>
        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
