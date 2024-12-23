@props([
    'currentUrl' => ''
])

@php
function getActiveNav($currentUrl, $url){
    if ($currentUrl == $url){
        return "block py-2 px-3 text-blue-700 bg-blue-700 rounded md:bg-transparent md:p-0";
    }else{
        return "block py-2 px-3 hover:text-blue-700 bg-blue-700 rounded md:bg-transparent md:p-0";
    }
}
@endphp

<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
    <div class="max-w-screen-xl flex items-center justify-between mx-auto px-4 py-2">
        <a href="https://flowbite.com/" class="flex gap-3">
            <img width="10%" src="{{ asset('assets/img/logo.png') }}" alt="" srcset="">
            <div class="flex flex-col">
                <span class="text-lg font-semibold">PT Sankeikid Manutec Indonesia</span>
                <span class="text-sm font-semibold">Data Quality Control</span>
            </div>
        </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <a href="/logout" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Logout</a>
            <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-full md:order-1 pe-8" id="navbar-sticky">
            <ul class="flex flex-col items-center justify-center p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                @if(auth()->user()->role == 'operator')
                    <li>
                        <a href="/" wire:navigate class="{{ getActiveNav($currentUrl, '/dashboard') }}" aria-current="page">Dashboard</a>
                    </li>
                    <li>
                        <a href="/checking" wire:navigate class="{{ getActiveNav($currentUrl, '/checking') }}" >Checking</a>
                    </li>
                @else
                    <li>
                        <a href="/laporan-qa" wire:navigate class="{{ getActiveNav($currentUrl, '/laporan-qa') }}">Laporan</a>
                    </li>

                    <li>
                        <a href="/items-database" wire:navigate class="{{ getActiveNav($currentUrl, '/items-database') }}">Items Database</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <div class="bg-slate-300 py-1">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-end mx-auto px-4">
            <p class="text-sm font-semibold">Hello {{ auth()->user()->name }}, ({{ auth()->user()->role }})</p>
        </div>
    </div>
</nav>
