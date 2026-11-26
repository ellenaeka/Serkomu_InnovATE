@props([
    'size' => 'md',
    'subtitle' => 'Telkom University',
    'align' => 'start',
    'iconPosition' => 'left',
    'href' => null,
])

@php
    $size = in_array($size, ['sm', 'md', 'lg'], true) ? $size : 'md';
    $tag = $href ? 'a' : 'div';
    $classes = 'sk-logo sk-logo--' . $size
        . ($align === 'center' ? ' sk-logo--center' : '')
        . ($iconPosition === 'right' ? ' sk-logo--icon-right' : '');
@endphp

@once
    <style>
        .sk-logo {
            --brand-color: #4264b5;
            --brand-sub: #5f6b85;
            display: inline-flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 2px;
            text-decoration: none;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1;
        }
        .sk-logo--center { align-items: center; text-align: center; }
        .sk-logo__mark {
            display: inline-flex;
            align-items: center;
            gap: .32em;
            color: var(--brand-color);
        }
        .sk-logo--icon-right .sk-logo__mark { flex-direction: row-reverse; }
        .sk-logo__icon { font-size: 1.05em; line-height: 1; }
        .sk-logo__word {
            font-weight: 800;
            letter-spacing: -.02em;
            color: var(--brand-color);
        }
        .sk-logo__sub {
            color: var(--brand-sub);
            font-weight: 400;
            letter-spacing: 0;
        }

        .sk-logo--sm .sk-logo__mark { font-size: 20px; }
        .sk-logo--sm .sk-logo__sub  { font-size: 11px; margin-top: 3px; }
        .sk-logo--md .sk-logo__mark { font-size: 24px; }
        .sk-logo--md .sk-logo__sub  { font-size: 12px; margin-top: 4px; }
        .sk-logo--lg .sk-logo__mark { font-size: 36px; }
        .sk-logo--lg .sk-logo__sub  { font-size: 12px; margin-top: 6px; letter-spacing: .14em; text-transform: uppercase; }

        @media (max-width: 600px) {
            .sk-logo--md .sk-logo__mark { font-size: 21px; }
            .sk-logo--lg .sk-logo__mark { font-size: 32px; }
        }

        a.sk-logo { border-radius: 10px; }
        a.sk-logo:focus-visible { outline: 3px solid rgba(66, 100, 181, .45); outline-offset: 4px; }
    </style>
@endonce

<{{ $tag }} @if($href) href="{{ $href }}" aria-label="SerKoMu — kembali ke beranda" @endif {{ $attributes->merge(['class' => $classes]) }}>
    <span class="sk-logo__mark">
        <i class="bi bi-heart-pulse-fill sk-logo__icon" aria-hidden="true"></i>
        <span class="sk-logo__word">serkomu.</span>
    </span>
    @if(filled($subtitle))
        <span class="sk-logo__sub">{{ $subtitle }}</span>
    @endif
</{{ $tag }}>