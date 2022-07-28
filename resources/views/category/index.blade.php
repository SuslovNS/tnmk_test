@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Категории</div>
                    <div class="row">

                        <div class="col-md-12">

                            <form method="get" action="{{ route('category.search') }}">
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <input type="text" class="form-control" id="s" name="s" placeholder="Поиск по ГОСТу">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button type="submit" class="btn btn-primary btn-block">Поиск</button>
                                    </div>
                                </div>

                            </form>

                        </div><!-- ./col-md-12-->

                    </div>

                    <div class="card-body">
                        <div class="container">

                            {{--Отображаем список категорий в произвольной форме со вложенностью--}}
                        @foreach($categories as $category)
                                <tr>
                                    <x-category-item :category="$category" />
                                </tr>
                            @endforeach
                            {{--END Отображаем список категорий в произвольной форме со вложенностью--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
