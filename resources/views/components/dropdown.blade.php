@props(['trigger'])

{{-- we need to display the hidden anchor tags and it will only show if it is click  --}}
<div x-data="{ show : false }" @click.outside= " show = false ">
    {{-- trigger --}}
   <div @click = " show = ! show">
        {{$trigger}}
   </div>
    
    {{-- links --}}
    <div x-show="show" class="py-2 absolute bg-gray-100 mt-2 rounded-xl w-32 overflow-auto max-h-52">

       {{$slot}}
        
    </div>
</div>
