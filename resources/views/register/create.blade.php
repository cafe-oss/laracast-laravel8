<x-layout-section5>


    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 border bg-gray-100 border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">Register!</h1>
            <form action="/register" method="POST" class="mt-10">
                @csrf
                {{-- name --}}
                <div class="mb-6">
                    
                    <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                        Name
                    </label>
                    <input class="border border-gray-400 p-2 w-full" type="text" name="name" id="name" required value="{{ old('name')}}">

                    @error('name')
                        <p class="text-red-500 tex-xs mt-1"> {{ $message }} </p>
                    @enderror
                </div>

                {{-- username --}}
                <div class="mb-6">
                    
                    <label for="username" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                        Username
                    </label>
                    <input class="border border-gray-400 p-2 w-full" type="text" name="username" id="username" required value="{{ old('username')}}">

                    @error('username')
                        <p class="text-red-500 tex-xs mt-1"> {{ $message }} </p>
                    @enderror   
                </div>

                {{-- email --}}
                <div class="mb-6">
                    
                    <label for="email" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                        Email
                    </label>
                    <input class="border border-gray-400 p-2 w-full" type="text" name="email" id="email" required value="{{ old('email')}}">
                    @error('email')
                        <p class="text-red-500 tex-xs mt-1"> {{ $message }} </p>
                    @enderror
                </div>

                {{-- password --}}
                <div class="mb-6">
                    
                    <label for="password" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                        Password
                    </label>
                    <input class="border border-gray-400 p-2 w-full" type="password" name="password" id="password" required >
                    @error('password')
                        <p class="text-red-500 tex-xs mt-1"> {{ $message }} </p>
                    @enderror
                </div>

                {{-- button --}}
                <div class="mb-6">
                    
                    <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-bue-500"> Submit </button>
                </div>

            </form>
        </main>
    </section>
</x-layout-section5>
        