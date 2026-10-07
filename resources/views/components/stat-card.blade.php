@props(['value', 'label', 'icon' => '', 'suffix' => ''])

<div class="stat-card">
    @if ($icon === 'bus')
        <svg class="stat-card__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M5 17V6.5C5 5.1 6.1 4 7.5 4h9C17.9 4 19 5.1 19 6.5V17M5 13h14M7 17v3m10-3v3M7 8h10v4H7zM7.5 15.5h.01m9-.01h.01" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" /></svg>
    @elseif ($icon === 'travellers')
        <svg class="stat-card__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M16 20v-1.5a3.5 3.5 0 0 0-3.5-3.5h-5A3.5 3.5 0 0 0 4 18.5V20m6-8a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm5.5-6.6a3.5 3.5 0 0 1 0 6.8m.5 2.9h1.5a3.5 3.5 0 0 1 3.5 3.5V20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" /></svg>
    @elseif ($icon === 'achievement')
        <svg class="stat-card__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M8 4h8v4a4 4 0 0 1-8 0V4Zm0 2H5v2a4 4 0 0 0 4 4m7-6h3v2a4 4 0 0 1-4 4m-3 2v4m-4 2h8m-7-6h6v4H9z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" /></svg>
    @elseif ($icon === 'satisfaction')
        <svg class="stat-card__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2-5.6-3-5.6 3 1.1-6.2L3 9.6l6.2-.9L12 3Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" /></svg>
    @endif
    <strong class="stat-card__value">{{ $value }}@if ($suffix !== '')<span>{{ $suffix }}</span>@endif</strong>
    <span>{{ $label }}</span>
</div>
