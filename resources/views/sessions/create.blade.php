<x-layout-section5>


    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 border bg-gray-100 border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">Login</h1>
            <form action="/login" method="POST" class="mt-10">
                @csrf

                {{-- email --}}
                <x-form.input name='email' type="email" autocomplete='username'> </x-form.input>

                {{-- password --}}
                <x-form.input name='password' type='password'  autocomplete='current-password'> </x-form.input>

                {{-- button --}}
                <x-form.field>
                    <x-form.button>
                        Submit
                    </x-form.button>
                </x-form.field>

            </form>
        </main>
    </section>
</x-layout-section5>
        