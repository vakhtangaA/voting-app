<nav class="items-center justify-between hidden text-xs text-gray-400 md:flex">
  <ul class="flex pb-3 space-x-10 font-semibold uppercase ">
    <li><a wire:click.prevent="setStatus('All')" href="#"
        class="pb-3 border-b-4 hover:border-blue {{ $status === 'All' ? 'border-blue text-gray-900' : '' }}">All
        Ideas (87)</a></li>
    <li><a wire:click.prevent="setStatus('Considering')" href="#"
        class="pb-3 transition duration-150 ease-in border-b-4 hover:border-blue {{ $status === 'Considering' ? 'border-blue text-gray-900' : '' }}">Considering
        (6)</a></li>
    <li><a wire:click.prevent="setStatus('In Progress')" href="#"
        class="pb-3 transition duration-150 ease-in border-b-4 hover:border-blue {{ $status === 'In Progress' ? 'border-blue text-gray-900' : '' }}">In
        Progress (1)</a></li>
  </ul>

  <ul class="flex pb-3 space-x-10 font-semibold uppercase">
    <li><a wire:click.prevent="setStatus('Implemented')" href="#"
        class="pb-3 transition duration-150 ease-in border-b-4 hover:border-blue {{ $status === 'Implemented' ? 'border-blue text-gray-900' : '' }}">Implemented
        (10)</a></li>
    <li><a wire:click.prevent="setStatus('Closed')" href="#"
        class="pb-3 transition duration-150 ease-in border-b-4 hover:border-blue {{ $status === 'Closed' ? 'border-blue text-gray-900' : '' }}">Closed
        (55)</a></li>
  </ul>
</nav>