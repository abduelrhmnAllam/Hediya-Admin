@if ($record?->image_background_url)
    <img
        src="{{ asset('storage/' . $record->image_background) }}"
        style="
            width:64px;
            height:64px;
            object-fit:cover;
            border-radius:50%;
        "
    />
@endif
