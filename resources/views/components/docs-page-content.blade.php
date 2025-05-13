@vite('resources/css/app.css')
<div class="flex flex-col space-y-4">
    <div class="flex items-center bg-yellow-500/50 py-6 px-8 rounded-lg space-x-2">
        <x-heroicon-o-exclamation-triangle class="w-8" />
        <p>Atenção: esta documentação </p>
    </div>
    <h1 class="font-bold text-2xl"># {{config('app.name')}}</h1>
    <p>Bem vindo ao Solver app. Uma versão simplificada e mais intuitiva do famoso Solver presente no Excel, LibreOffice e Google Sheets.</p>
    <span class="border-b border-white/30 "></span>
    <h2 class="text-2xl">## Como Usar?</h2>
    <p>Você verá que a aplicação fala por si só. Você apenas precisa seguir estes passos simples:</p>
    <ol>
        <li>1. Criar um novo exercício</li>
        <li>2. Atribuir o Título<span class="text-red-500">*</span> e uma Descrição</li>
        <li>3. Preencher os Itens de acordo com o enunciado do seu exercício.</li>
        <li>4. Escolher o que deseja fazer.</li>
    </ol>
    <span class="border-b border-white/30 "></span>
    <h2>## Exercício</h2>
    <p>Um exercício é um conjunto formado pelo título e descrição, limite e total de uma atividade e uma coleção de itens que serão usados para resolver o problema.</p>
    <p>Você sempre poderá salvar Exercícios para terminar mais tarde. Bem como realizar os cálculos sem salvar os dados, ou salvar os dados e realizar o cálculo.</p>
    <span class="border-b border-white/30 "></span>
    <h2>## Item</h2>
    <p>Um item é a representação da linha de dados no excel. Formado por Nome, Valor, Quantidade, Mínimo e Máximo.</p>
</div>
