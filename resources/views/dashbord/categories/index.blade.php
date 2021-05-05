@extends('layouts.dashbord.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.users')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashbord.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li class="active"><i class="fa fa-dashboard"></i> @lang('site.users')</li>

            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.categories')
                        <small>{{ $categories->total() }}</small>
                    </h3>

                    <form action="{{ route('dashbord.categories.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                    value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                    @lang('site.search')</button>

                                @if (auth()->user()->hasPermission('create_categories'))
                                    <a href="{{ route('dashbord.categories.create') }}" class="btn btn-primary"><i
                                            class="fa fa-plus"></i> @lang('site.add')</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>
                                        @lang('site.add')</a>
                                @endif

                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($categories->count() > 0)

                        <table class="table table-hover">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('site.name')</th>

                                </tr>
                                @foreach ($categories as $index => $category)
                                    <tr>
                                        <th>{{ $index + 1 }}</th>
                                        <th>{{ $category->name }}</th>
                                        @if (Auth()->user()->hasPermission('delete_categories'))
                                            <th><a class="btn btn-info btn-sm"
                                                    href="{{ route('dashbord.categories.edit', ['id' => $category->id]) }}">@lang('site.edit')</a>
                                            @else
                                            <th><a class="btn btn-info btn-sm disabled" href="#">@lang('site.edit')</a>
                                        @endif

                                        @if (Auth()->user()->hasPermission('delete_categories'))
                                            <form
                                                action="{{ route('dashbord.categories.destroy', ['id' => $category->id]) }}"
                                                method="post" style="display: inline">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button class="btn btn-primary btn-sm delete"
                                                    style="background: rgb(199, 67, 67)">@lang('site.delete')</button>
                                            </form>
                                        @else
                                            <button class="btn btn-danger btn-sm disabled"
                                                style="background: rgb(199, 67, 67)">@lang('site.delete')</button>
                                        @endif
                                        </th>
                                    </tr>
                                @endforeach
                            </thead>



                        </table><!-- end of table -->

                        {{ $categories->appends(request()->query())->links() }}

                    @else

                        <h2>@lang('site.no_data_found')</h2>

                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
