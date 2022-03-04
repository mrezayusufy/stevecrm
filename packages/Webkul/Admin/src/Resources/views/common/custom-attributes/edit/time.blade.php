<time>
    <input
        type="time"
        name="{{ $attribute->code }}"
        class="control"
        value="{{ old($attribute->code) ?: $value }}"
        v-validate="'{{$validations}}'"
        data-vv-as="&quot;{{ $attribute->name }}&quot;"
    />
</time>