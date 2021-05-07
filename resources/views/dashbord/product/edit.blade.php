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
            <form action="{{ route('dashbord.products.update',['id'=>$product->id]) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{method_field('put')}}
                <div class="form-group">
                    <label for="">@lang('site.name')</label>
                    <select class="form-control" name='category_id'>
                        <option value="" selected>....</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"  {{ $category->id ? 'selected':''}}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                @php
                    $languages = ['ar', 'en'];
                    // $discriptions = ['ar', 'en'];
                    $prices = ['parchase_price', 'sale_price', 'stok'];
                @endphp
                @foreach ($languages as $language)
                    <div class="form-group">
                        @if ($language == 'ar')
                            <label for="">@lang('site.namee.ar')</label>
                            <input type="text" name="name_{{ $language }}" id="" class="form-control"
                            value="{{ $product->name_ar }}">
                        @else
                            <label for="">@lang('site.namee.en')</label>
                            <input type="text" name="name_{{ $language }}" id="" class="form-control"
                            value="{{ $product->name_en }}">
                        @endif


                    </div>

                    <div class="form-group">
                        @if ($language == 'ar')
                            <label for="">@lang('site.discription.ar')</label>
                            <textarea type="text" name="discription_{{ $language }}"
                            style="height: 80px;overflow:hidden;resize:vertical" id="" class="form-control ckeditor">
                                    {{$product->discription_ar }}
                                </textarea>
                        @else
                            <label for="">@lang('site.discription.en')</label>
                            <textarea type="text" name="discription_{{ $language }}"
                            style="height: 80px;overflow:hidden;resize:vertical" id="" class="form-control ckeditor">
                                    {{$product->discription_en }}
                                </textarea>
                        @endif
                @endforeach
                <div class="form-group">
                    <label for="">@lang('site.image')</label>
                    <input type="file" name="image" id="" class="form-control">
                </div>
                <div class="form-group">
                    <img src="{{$product->image}}" alt="" class="form-control" style="width: 20%;height:20%">
                </div>
                @foreach ($prices as $price)
                    <div class="form-group">
                        @if ($price == 'sale_price')
                            <label for="">@lang('site.price.sale_price')</label>
                        @elseif ($price =='stok')
                            <label for="">@lang('site.price.stok')</label>
                        @else
                            <label for="">@lang('site.price.parchase_price')</label>
                        @endif
                        <input type="number" name="{{ $price }}" id="" class="form-control"
                            value="{{ $product->$price }}">
                    </div>
                @endforeach




                <div class="form-group">
                    <button class="btn btn-primary">
                        <i class="fa fa-plus">&ThinSpace;@lang('site.edit')</i>
                    </button>
                </div>
            </form>
        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
