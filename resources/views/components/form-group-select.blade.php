<x-form-group fieldName="{{$fieldName}}" fieldDescription="{{$fieldDescription}}" :errors="$errors">
    <select name="{{$fieldName}}" id="{{$fieldId}}" class="form-control selectpicker show-tick" @if ($searchOn) data-live-search="true" data-live-normalize="true" data-live-search-style="contains" data-live-search-placeholder="{{$placeholder}}" @endif>
        @foreach ($collection as $item)
        <option value="{{$item[$keyField]}}">{{$item[$valueField]}}</option>
        @endforeach
    </select>
</x-form-group>