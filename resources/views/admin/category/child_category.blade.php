
    <li>
        --> {{ $category->category_name }}
    </li>
    @if ($category->icon)
        <img width="50" src="{{ asset($category->icon) }}" alt="">
    @endif


@if ($category->childrenCategories->isNotEmpty())
    <ul style="padding-left: 30px">
        @foreach ($category->childrenCategories as $childCategory)
            @include('admin.category.child_category', [
                'category' => $childCategory,
            ])
        @endforeach
    </ul>
@endif
