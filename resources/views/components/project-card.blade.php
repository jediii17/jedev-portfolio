@props(['project'])

<div class="group relative p-6 rounded-2xl bg-surface hover:bg-page border border-transparent hover:border-surface shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
    <div class="flex flex-col h-full justify-between space-y-4">
        <div>
            <div class="flex justify-between items-start">
                <h3 class="text-xl font-bold text-main group-hover:text-accent transition-colors">
                    {{ $project['title'] }}
                </h3>
                @if($project['year'])
                <span class="text-xs font-mono text-muted border border-(--text-secondary)/20 px-2 py-1 rounded">
                    {{ $project['year'] }}
                </span>
                @endif
            </div>

            <p class="mt-3 text-muted leading-relaxed">
                {{ $project['description'] }}
            </p>

            @if(isset($project['contribution']))
            <div class="mt-4 pt-4 border-t border-muted/10">
                <h4 class="text-sm font-semibold text-main mb-2">My Contribution:</h4>
                <ul class="list-disc list-inside text-sm text-muted space-y-1">
                    @foreach($project['contribution'] as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <div class="pt-4">
            <div class="flex flex-wrap gap-2 mb-4">
                @foreach($project['tech'] as $tech)
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-page text-muted border border-muted/10">
                    {{ $tech }}
                </span>
                @endforeach
            </div>
        </div>
    </div>
</div>