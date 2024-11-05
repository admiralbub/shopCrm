@props(['status'])
<div class="alert alert-{{$status}}" role="alert">
    
    {{$slot}}
</div>