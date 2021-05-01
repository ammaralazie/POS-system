@extends('layouts.dashbord.app')

@section('content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.users')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashbord.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active"><i class="fa fa-dashboard"></i> @lang('site.users')</li>

        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header with-border">

                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.users') <small>{{--$users->total() --}}</small></h3>

                <form action="{{ route('dashbord.users.index') }}" method="get">

                    <div class="row">

                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{-- request()->search --}}">
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                            <a href="{{route('dashbord.users.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                            {{--  @if (auth()->user()->hasPermission('create_users'))
                                <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                            @else
                                <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>
                            @endif
                            --}}
                        </div>

                    </div>
                </form><!-- end of form -->

            </div><!-- end of box header -->

            <div class="box-body">

                @if ($users->count() > 0)

                    <table class="table table-hover">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.first_name')</th>
                            <th>@lang('site.last_name')</th>
                            <th>@lang('site.email')</th>
                            <th>@lang('site.image')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                        @foreach ($users as $index=>$user)
                        <tr>
                        <th>{{$index+1}}</th>
                        <th>{{$user->first_name}}</th>
                        <th>{{$user->last_name}}</th>
                        <th>{{$user->email}}</th>
                        <th>none</th>
                        <th><a class="btn btn-info btn-sm" href="{{route('dashbord.users.edit',['id'=>$user->id])}}">@lang('site.edit')</a>
                        <form action="{{route('dashbord.users.destroy',['id'=>$user->id])}}" method="post"  style="display: inline">
                            {{ csrf_field() }}
                            {{method_field('delete')}}
                            <button class="btn btn-danger btn-sm">@lang('site.delete')</button>
                        </form>
                    </th>
                </tr>
                        @endforeach
                        </thead>



                    </table><!-- end of table -->

                    {{-- $users->appends(request()->query())->links() --}}

                @else

                    <h2>@lang('site.no_data_found')</h2>

                @endif

            </div><!-- end of box body -->


        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->


@endsection
