@foreach ($data as $key => $value)
    @if (is_array($value))
        @if (is_array($value) && array_key_exists('total carbs', $value))
            <label for="total_carbs">{{ $key }}</label><br>
            <input type="text" id="total_carbs" name="total_carbs"><br>
        @endif
        @foreach ($value as $innerKey => $innerValue)
            @if (is_array($value) && array_key_exists('dietary fiber', $value))
                <label for="dietary_fiber">{{ $key }}.{{ $innerKey }}</label><br>
                <input type="text" id="dietary_fiber" name="dietary_fiber"><br>
            @endif
            <label for="{{ $key }}">{{ $key }}.{{ $innerKey }}</label><br>
            @if (is_array($innerValue))
                @include('fields', ['data' => $innerValue, 'prefix' => $key . '.' . $innerKey . '.'])
            @else
                <input type="text" id="{{ $key }}" name="{{ $key }}" value="{{ $innerValue }}"><br>
            @endif
        @endforeach
    @else
        <label for="{{ $key }}">{{ $key }}</label><br>
        <input type="text" id="{{ $key }}" name="{{ $key }}" value="{{ $value }}"><br>
    @endif
@endforeach