@component('mail::message')
Жалоба<br>
От: {{ $name }}<br>
Почта: {{ $email }}<br>
Текст: {{ $text }}<br>
@endcomponent
