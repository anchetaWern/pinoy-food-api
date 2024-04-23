@foreach ($row->children as $child_row)
<div class="row">
    <div class="col offset-md-1">
        <div class="mt-1 ml-5">
            <label for="{{ strtolower($child_row->name) }}" class="form-label">{{ $child_row->name }}</label>
            <input type="text" class="form-control" id="{{ strtolower($child_row->name) }}" name="{{ isset($parent) ? $parent->name : '' }}{{ isset($parent) ? '[' . $row->name . ']' : $row->name }}[{{ strtolower($child_row->name) }}]">
            
            <div class="mb-1">
                @if ($child_row->hasChildren())
                    @include('partials.nutrient-rows', ['row' => $child_row, 'parent' => $row])
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach