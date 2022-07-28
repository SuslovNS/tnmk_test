@props(['category'])


<div>
    <!--Вложенность-->
    {{$category->title}}
    <div style="margin-left: 20px;" class="user-menu-sort-categories">
        @foreach($category->children as $child)
            <!--foreach-->
                <div class="user-menu-sort-category" data-id="{{$child->id}}">
                    <p class="user-menu-sort-category__border"> <x-category-settings :category="$child" /> </p>
                </div>
                <!--endforeach-->
            @endforeach
    </div>
<!--END Вложенность-->
</div>
