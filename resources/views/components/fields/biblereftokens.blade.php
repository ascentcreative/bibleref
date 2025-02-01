@extends('forms::components.wrappers.' . $wrapper)

@section('label'){{$label}}@overwrite
@section('name'){{$name}}@overwrite

@php 
    $uniq = uniqid();
@endphp

@section('element')

    <INPUT type="text" name="{{ $name }}_input" id="brt_{{ $uniq }}" class="item-entry form-control" 
        placeholder="Type a Bible Reference and hit Enter..."
    />

@overwrite

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#brt_{{ $uniq }}').biblereftokens({
                value: {!! $value !!},
                fieldName: '{{ $name }}'
            });
        });
    </script>
@endpush