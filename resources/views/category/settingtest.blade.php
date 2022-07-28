@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Категории</div>

                    <div class="card-body">

                        {{--Отображаем список категорий--}}
                        <div class="user-menu-sort-categories">
                            <!--foreach-->
                            <div class="user-menu-sort-category" data-id="id категории">
                                <p class="user-menu-sort-category__border"> Название категории </p>
                                <!--Вложенность-->
                                <div class="user-menu-sort-categories">
                                    <!--foreach-->
                                    <div class="user-menu-sort-category" data-id="id категории">
                                        <p class="user-menu-sort-category__border"> Название категории </p>
                                        ...
                                    </div>
                                    <!--endforeach-->
                                </div>
                                <!--END Вложенность-->
                            </div>
                            <!--endforeach-->
                        </div>

                        {{--END Отображаем список категорий--}}

                        <hr>
                        <form action="{{ route('category.setting.save') }}" method="POST">
                            @csrf
                            <input type="hidden" id="sort" name="sort" value="">
                            <button type="submit" class="btn btn-outline-success">Сохранить</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" defer></script>
    <script>
        function generation_sort_menu() {
            let id = [];
            $('.user-menu-sort-category').each(function (i,s) {
                if($(s).data('id')) {
                    id.push($(s).data('id'));
                }
            });
            $('#sort').val(id.join(','));
        }
        $( function() {
            $( ".user-menu-sort-categories" ).sortable();
            $( ".user-menu-sort-categories" ).disableSelection();
            $( ".user-menu-sort-categories" ).droppable({
                accept: ".user-menu-sort-category",
                over: function( event, ui )//если фигура над клеткой- выделяем её границей
                {
                    $(this).addClass('hover');
                    $(this).removeClass('dang');
                    $(ui.draggable).addClass('hover');
                },
                out: function( event, ui )//если фигура ушла- снимаем границу
                {
                    $(this).removeClass('hover');
                    $(this).addClass('dang');
                },
                drop:function( event, ui )//если бросили фигуру в клетку
                {
                    $(ui.draggable).removeClass('hover');
                    $(this).removeClass('hover');//убираем выделение
                    setTimeout(function () {
                        generation_sort_menu();
                    }, 500);
                }
            });
        });
    </script>
@endsection
