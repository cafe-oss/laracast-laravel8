<x-layout-section5>

    <x-setting heading="Edit Post: {{$post->title}}">

            <form action="/admin/posts/{{$post->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                
                {{-- title --}}
                <x-form.input name='title' required :value="old('title', $post->title)"> 
                {{-- :value="$post->title"> --}}

                </x-form.input>

                {{-- slug --}}
                <x-form.input name='slug' required :value="old('slug', $post->slug)">

                </x-form.input>

                <div class="flex mt-6">
                    <div class="flex-1">
                        {{-- thumbnail --}}
                        <x-form.input name='thumbnail' type='file' :value="old('thumbnail', $post->thumbnail)">

                        </x-form.input> 
                    </div>
                    <img src="{{ asset('storage/'. $post->thumbnail)}}" alt="" class="rounded-xl ml-6" width="100">
                </div>
               
                {{-- excerpt --}}
                <x-form.textarea name='excerpt' required>{{old('excerpt', $post->excerpt)}}</x-form.textarea>

                {{-- body --}}
                <x-form.textarea name='body' required> {{old('body', $post->body)}} </x-form.textarea>

                {{-- category --}}
                <div class="mb-6">
                    <x-form.label name='category'></x-form.label>
                    
                    <select name="category_id" id="category_id">
                        {{-- @php
                            $categories = \App\Models\Category::all();
                        @endphp --}}

                        @foreach (\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $post->category->id) == $category->id ? 'selected' : '' }}>{{ucwords($category->name)}}</option>
                        @endforeach

                    </select>

                    <x-form.error name='category'></x-form.error>
                </div>

                <x-form.button>
                    Update
                </x-form.button>

            </form>
        
    </x-setting> 
</x-layout-section5>