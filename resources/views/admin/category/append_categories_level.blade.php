<option value="0">Select parent Category</option>
@if (!empty($getCategories))
    @foreach ($getCategories as $parentcategory)
        <option value="{{ $parentcategory['id'] }}"> {{ $parentcategory['name'] }}</option>
        @if (!empty($parentcategory['sub_categories']))
            @foreach ($parentcategory['sub_categories'] as $subcategory)
                <option value="{{ $subcategory['id'] }}">
                    &nbsp;&nbsp;&nbsp;&raquo;&nbsp;{{ $subcategory['name'] }}</option>
            @endforeach
        @endif
    @endforeach
@endif
