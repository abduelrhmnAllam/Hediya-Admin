@if ($record?->image_background_url)
    <div
        style="
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 1rem;
            width: 100%;
        "
    >
        <!-- Left: Image + Name -->
        <div style="display: flex; align-items: center; gap: 12px;">
            <img
                src="{{ $record->image_background_url }}"
                style="
                    width:48px;
                    height:48px;
                    object-fit:cover;
                    border-radius:50%;
                    flex-shrink: 0;
                "
            />

            <div style="font-size: 18px; font-weight: 600;">
                {{ $record->name }}
            </div>
        </div>

        <!-- Right spacer (lets Filament place actions correctly) -->
        <div></div>
    </div>
@endif
