<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center justify-between">
            {{-- Clock --}}
            <div class="flex flex-col">
                <p>الساعة</p>
                <h1 class="text-base">123</h1>
            </div>

            {{-- WhatsApp Button --}}
            <a href="https://wa.me/2189XXXXXXXXX"
               target="_blank"
               class="flex items-center gap-2 px-4 py-2 text-white bg-green-600 rounded-lg shadow hover:bg-green-700 transition">
                <x-heroicon-o-chat-bubble-left-ellipsis class="w-5 h-5"/>
                تواصل مع المطور
            </a>
        </div>

        {{-- Script for Clock --}}
        <script>
            function updateClock() {
                const now = new Date();
                const options = {hour: '2-digit', minute: '2-digit', second: '2-digit'};
                document.getElementById('clock').textContent = now.toLocaleTimeString('ar-LY', options);
            }

            setInterval(updateClock, 1000);
            updateClock();
        </script>
    </x-filament::section>
</x-filament-widgets::widget>
