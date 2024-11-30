<ul style="padding-left: 30px" >
    <li>--> {{ $childCategory->category_name }}</li>
    @if ( $childCategory->icon)
        <img width="50" src="{{asset( $childCategory->icon )}}" alt="">
    @endif
</ul>

@if ($childCategory->categories)
    <ul style="padding-left: 30px">
        @foreach ($childCategory->categories as $childCategory)
            @include('admin.category.child_category', ['childCategory' => $childCategory])
        @endforeach
    </ul>
@endif