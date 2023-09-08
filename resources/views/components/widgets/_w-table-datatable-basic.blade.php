@props([
    'id' => 'zero-config',
    'class' => '',
    'style' => 'width:100%'
])

<table id="{{ $id }}" class="table dt-table-hover {{ $class }}" style="{{ $style }}">
    <thead>
        {{ $thead }}
    </thead>
    <tbody>
        {{ $slot }}
    </tbody>
</table>