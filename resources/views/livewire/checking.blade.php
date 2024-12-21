<div>
    <x-partials.navbar currentUrl="{{ $currentUrl }}"></x-partials.navbar>

    <div class="max-w-screen-xl mx-auto px-4 pt-36">
        <div class="bg-slate-300 p-5 w-full rounded-lg">
            <div class="flex justify-between">
                <div class="flex flex-col gap-y-1">
                    <h1 class="text-xl font-semibold">
                        QA Checking
                    </h1>
                    <p>Aplikasi Quality Assurance Product</p>
                </div>

                <div class="mb-5">
                    <label for="date" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                    <input type="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required/>
                </div>
            </div>

            <div class="px-5 mt-5">
                <div class="mb-5">
                    <label for="partName" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Part Name</label>
                    <input type="text" id="partName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required/>
                </div>
                <div class="mb-5 w-full">
                    <label for="partNo" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Part No</label>
                    <input type="text" id="partNo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required/>
                </div>
            </div>

            @if(is_null($ngChoice))
                <div class="px-5 mt-10 h-[10rem]">
                    <div class="flex gap-4 h-full">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-4xl w-full">OK</button>
                        <button wire:click="ngChoiceFun" class="bg-red-500 hover:bg-red-700 text-white font-bold text-4xl w-full">NG</button>
                    </div>
                </div>
            @elseif($ngChoice)
                <div class="px-5 mt-10">
                    <button wire:click="backButton" class="underline text-lg hover:text-blue-500 mb-5"> <-back</button>
                    <div class="grid grid-cols-4 gap-5 h-full">
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold text-3xl w-full p-5">SILVER</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold text-3xl w-full p-5">BURRY</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold text-3xl w-full p-5">GLOSS</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold text-3xl w-full p-5">FLOW BLACK</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold text-3xl w-full p-5">BENANG RUNNER</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold text-3xl w-full p-5">SINMARK</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold text-3xl w-full p-5">STARTCH</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold text-3xl w-full p-5">SHOT MOLD</button>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
