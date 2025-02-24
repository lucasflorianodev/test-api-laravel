<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Transações</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-3xl mx-auto bg-white p-6 shadow-lg rounded-lg">
        <h2 class="text-xl font-semibold mb-4">Lista de Transações</h2>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 text-left">Descrição</th>
                    <th class="py-2 px-4 text-left">Valor</th>
                    <th class="py-2 px-4 text-left">Opções</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                <tr class="border-b" x-data="{ open: false }">
                    <td class="py-2 px-4 cursor-pointer hover:bg-gray-100" @click="fetchTransaction({{ $transaction->id }})">
                        {{ $transaction->description }}
                    </td>
                    <td class="py-2 px-4">R$ {{ number_format($transaction->amount, 2, ',', '.') }}</td>
                    <td class="py-2 px-4 relative">
                        <button @click="$refs.menu{{ $transaction->id }}.classList.toggle('hidden')" class="text-gray-600 hover:text-gray-800">
                            ⋮
                        </button>
                        <div x-ref="menu{{ $transaction->id }}" class="absolute right-0 mt-2 w-32 bg-white border rounded shadow hidden">
                            <button @click="fetchTransaction({{ $transaction->id }})" class="block px-4 py-2 text-sm hover:bg-gray-100 w-full">Ver</button>
                            <a href="{{ route('transactions.edit', $transaction->id) }}" class="block px-4 py-2 text-sm hover:bg-gray-100 w-full">Editar</a>
                            <button @click="deleteTransaction({{ $transaction->id }})" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-100 w-full">Excluir</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal de Visualização -->
    <div x-data="{ open: false, transaction: {} }" x-show="open" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
            <h3 class="text-lg font-semibold mb-4">Detalhes da Transação</h3>
            <p><strong>Descrição:</strong> <span x-text="transaction.description"></span></p>
            <p><strong>Valor:</strong> R$ <span x-text="transaction.amount"></span></p>
            <button @click="open = false" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Fechar</button>
        </div>
    </div>

    <script>
        function fetchTransaction(id) {
            fetch(`/transactions/${id}`)
                .then(response => response.json())
                .then(data => {
                    Alpine.store('modal').transaction = data;
                    Alpine.store('modal').open = true;
                });
        }

        function deleteTransaction(id) {
            if (confirm('Tem certeza que deseja excluir esta transação?')) {
                fetch(`/transactions/${id}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                })
                .then(response => response.json())
                .then(() => {
                    alert('Transação excluída com sucesso!');
                    location.reload();
                });
            }
        }
    </script>

</body>
</html>
