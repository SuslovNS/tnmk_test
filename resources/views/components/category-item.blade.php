@props(['category'])

<div>
    <td> {{$category->title}}</td>
    @foreach($category->children as $child)
        <div style="margin-left: 20px;">

            <x-category-item :category="$child" />

        </div>
    @endforeach
</div>
