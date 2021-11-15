<nav class="items-center justify-between hidden text-xs text-gray-400 md:flex">
  <ul class="flex pb-3 space-x-10 font-semibold uppercase ">
    <li><a wire:click.prevent="setStatus('All')"
        href={{ route('idea.index', ['status' =>  'All']) }}
        class="pb-3 border-b-4 hover:border-blue {{ $status === 'All' ? 'border-blue text-gray-900' : '' }}">
        All Ideas ({{ $statusCount['all_statuses'] }})</a></li>
    <li><a wire:click.prevent="setStatus('Considering')"
        href={{ route('idea.index', ['status' =>  'Considering']) }}
        class="pb-3 transition duration-150 ease-in border-b-4 hover:border-blue {{ $status === 'Considering' ? 'border-blue text-gray-900' : '' }}">Considering
        ({{ $statusCount['considering'] }})</a></li>
    <li><a wire:click.prevent="setStatus('In Progress')"
        href={{ route('idea.index', ['status' =>  'In Progress']) }}
        class="pb-3 transition duration-150 ease-in border-b-4 hover:border-blue {{ $status === 'In Progress' ? 'border-blue text-gray-900' : '' }}">
        In Progress ({{ $statusCount['in_progress'] }})</a></li>
  </ul>

  <ul class="flex pb-3 space-x-10 font-semibold uppercase">
    <li><a wire:click.prevent="setStatus('Implemented')"
        href={{ route('idea.index', ['status' =>  'Implemented']) }}
        class="pb-3 transition duration-150 ease-in border-b-4 hover:border-blue {{ $status === 'Implemented' ? 'border-blue text-gray-900' : '' }}">
        Implemented ({{ $statusCount['implemented'] }})</a></li>
    <li><a wire:click.prevent="setStatus('Closed')"
        href={{ route('idea.index', ['status' =>  'Closed']) }}
        class="pb-3 transition duration-150 ease-in border-b-4 hover:border-blue {{ $status === 'Closed' ? 'border-blue text-gray-900' : '' }}">Closed
        ({{ $statusCount['closed'] }})</a></li>
  </ul>
</nav>