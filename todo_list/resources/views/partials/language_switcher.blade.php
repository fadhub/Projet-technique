<div class="language-switcher flex items-center bg-white rounded-lg border border-gray-200 p-1 shadow-sm">
    <a href="{{ route('language.switch', 'en') }}" 
       class="px-3 py-1 text-sm font-medium rounded-md transition-colors {{ app()->getLocale() === 'en' ? 'bg-blue-600 text-white' : 'text-gray-600 hover:bg-gray-100' }}"
       title="English">
        EN
    </a>
    <span class="mx-1 text-gray-300">|</span>
    <a href="{{ route('language.switch', 'fr') }}" 
       class="px-3 py-1 text-sm font-medium rounded-md transition-colors {{ app()->getLocale() === 'fr' ? 'bg-blue-600 text-white' : 'text-gray-600 hover:bg-gray-100' }}"
       title="Français">
        FR
    </a>
</div>