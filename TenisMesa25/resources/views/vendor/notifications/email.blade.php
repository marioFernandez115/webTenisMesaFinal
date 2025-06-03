@component('mail::message')
{{-- Encabezado personalizado --}}
# 🏓 ¡Hola desde Tenis de Mesa Rivas Vaciamadrid!

{{-- Introducción personalizada --}}
@if (!empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# Ups, ha ocurrido un error
@else
# ¡Hola!
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Botón de acción --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'success'; // verde para acción positiva
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
🔐 {{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Despedida --}}
@if (!empty($salutation))
{{ $salutation }}
@else
Saludos cordiales,<br>
**Equipo de Tenis de Mesa Rivas Vaciamadrid**
@endif

{{-- Subcopy para usuarios con problemas con el botón --}}
@isset($actionText)
@slot('subcopy')
Si tienes problemas para hacer clic en el botón **"{{ $actionText }}"**, copia y pega la siguiente URL en tu navegador:

👉 [{{ $displayableActionUrl }}]({{ $actionUrl }})
@endslot
@endisset
@endcomponent
