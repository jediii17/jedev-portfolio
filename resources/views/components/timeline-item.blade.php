@props(['item'])

<div class="relative pl-8 md:pl-0">
    <!-- Vertical Line (Desktop only) -->
    <div class="hidden md:block absolute left-1/2 top-0 bottom-0 w-px bg-gray-500 -translate-x-1/2"></div>

    <!-- Timeline Dot (Desktop only) -->
    <div class="hidden md:block absolute left-1/2 top-0 w-3 h-3 bg-accent rounded-full -translate-x-1/2 transform translate-y-2 ring-4 ring-page"></div>

    <!-- Mobile Left Line & Dot -->
    <div class="md:hidden absolute left-0 top-0 bottom-0 w-px bg-surface"></div>
    <div class="md:hidden absolute left-0 top-2 w-2 h-2 bg-accent rounded-full -translate-x-[3.5px]"></div>

    <!-- Content -->
    <div class="md:flex justify-between items-start group">
        <!-- Date (Desktop Left / Mobile Top) -->
        <div class="md:w-[45%] md:text-right mb-2 md:mb-0 md:pr-8">
            <span class="inline-block px-3 py-1 text-xs font-mono font-medium rounded-full bg-surface text-muted group-hover:text-accent transition-colors">
                {{ $item['period'] }}
            </span>
        </div>

        <!-- Details (Desktop Right / Mobile Bottom) -->
        <div class="md:w-[45%] md:pl-8">
            <h3 class="text-xl font-bold text-main">{{ $item['role'] }}</h3>
            <h4 class="text-lg font-medium text-accent mb-2">{{ $item['company'] }}</h4>

            <p class="text-muted text-sm mb-4 leading-relaxed">
                {{ $item['description'] }}
            </p>

            @if(isset($item['tech']))
            <div class="flex flex-wrap gap-2">
                @foreach($item['tech'] as $tech)
                <span class="text-xs text-muted before:content-['#'] font-mono opacity-70">
                    {{ $tech }}
                </span>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>