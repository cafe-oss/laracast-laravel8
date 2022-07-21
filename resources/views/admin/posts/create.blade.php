<x-layout-section5>

    <x-setting heading="Publish New Post">
   
            <form action="/admin/posts" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- title --}}
                <x-form.input name='title' required />

                {{-- slug --}}
                <x-form.input name='slug' required />

                {{-- thumbnail --}}
                <x-form.input name='thumbnail' type='file' required/>
       
                {{-- excerpt --}}
                <x-form.textarea name='excerpt' required>{{old('excerpt')}}</x-form.textarea>

                {{-- body --}}
                <x-form.textarea name='body' required>{{old('body')}}</x-form.textarea>

                {{-- category --}}
                <div class="mb-6">
                    <x-form.label name='category'></x-form.label>
                    
                    <select name="category_id" id="category_id">
                        {{-- @php
                            $categories = \App\Models\Category::all();
                        @endphp --}}
                            
                        @foreach (\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ucwords($category->name)}}</option>
                        @endforeach

                    </select>

                    <x-form.error name='category'></x-form.error>
                </div>

                <x-form.button>
                    Publish
                </x-form.button>

            </form>
        
    </x-setting> 
</x-layout-section5>