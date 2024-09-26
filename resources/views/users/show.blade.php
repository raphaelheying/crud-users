<x-app-layout>
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        <h1 class="inline-block text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Usuário #{{ $user->id }}</h1>
        <div class="my-6 p-6 bg-white relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="py-4">
                <b>Nome:</b> {{ $user->name }}
            </div>
            <div class="py-4">
                <b>E-mail:</b> {{ $user->email }}
            </div>
            <div class="py-4">
                <b>Papel:</b> {{ str($user->role->value)->ucfirst() }}
            </div>
            <div class="py-4">
                <b>Criado em:</b> {{ $user->created_at->format('d/m/Y H:i') }}
            </div>
            <div class="py-4">
                <b>Última atualização:</b> {{ $user->updated_at->format('d/m/Y H:i') }}
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <a href="{{ route('users.index') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">Voltar</a>
            <a href="{{ route('users.edit', $user->id) }}" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">Editar</a>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Excluir</button>
            </form>
        </div>
    </div>
</x-app-layout>
