<div class="mb-3">
    <label for="sortBy" class="form-label">{{__('Sort by')}}</label>
    <select name="sort" id="sortBy" class="form-select" aria-label="sort by">
        @foreach($sortable as $sortItem)
            <option value="{{ $sortItem }}.asc"
                {{ (old('sort') === $sortItem.".asc") ? "selected" : "" }}>
                {{$sortItem}} inc
            </option>
            <option value="{{ $sortItem }}.desc"
                {{ (old('sort') === $sortItem.".desc") ? "selected" : ""}}>
                {{$sortItem}} desc
            </option>
        @endforeach
    </select>
</div>
