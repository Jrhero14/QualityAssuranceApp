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

                <form wire:submit="saveShift" class="flex gap-5 items-end">
                    <div class="mb-5">
                        @if(session()->has('belum-pilih-shift'))
                            <p class="text-sm italic text-red-500 font-semibold">Kamu belum memilih shift</p>
                        @endif
                        <label for="shifts" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Shift</label>
                        <select required id="shifts" wire:model.live="shiftChoice" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @if(is_null($shiftSelected->shift1_id) and is_null($shiftSelected->shift2_id))
                                <option value="null" selected>Pilih Shift</option>
                                <option value="shift1">Shift 1</option>
                                <option value="shift2">Shift 2</option>
                            @endif

                            @if(!is_null($shiftSelected->shift1_id) and (auth()->user()->id == $shiftSelected->shift1_id))
                                    <option value="shift1" selected>Shift 1</option>
                            @endif

                            @if(!is_null($shiftSelected->shift2_id) and (auth()->user()->id == $shiftSelected->shift2_id))
                                    <option value="shift2" selected>Shift 2</option>
                            @endif
                        </select>
                    </div>

                    <div class="mb-5">
                        <label for="date" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                        <input disabled type="date" value="{{ date('Y-m-d') }}" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required/>
                    </div>


                    @if(is_null($shiftSelected->shift1_id) and is_null($shiftSelected->shift2_id))
                        <div class="mb-3">
                            <button type="submit" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Masuk Shift</button>
                        </div>
                    @endif
                </form>
            </div>

            <div class="px-5 mt-5">
                <div class="mb-5">
                    <label for="items" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Part Name</label>
                    <select id="items" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Pilih Item</option>
                        @foreach($items as $item)
                            <option value="{{ $item->part_name }}">{{ $item->part_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5 w-full">
                    <label for="partNo" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Part No</label>
                    <input type="text" id="partNo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required/>
                </div>
            </div>

            @if(is_null($ngChoice))
                <div class="px-5 mt-10 h-[10rem]">
                    <div class="flex gap-4 h-full">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-4xl w-full flex justify-center items-center">
                            <svg class="w-10 h-10 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
                            </svg>
                            <span>OK</span>
                        </button>
                        <button wire:click="ngChoiceFun" class="bg-red-500 hover:bg-red-700 text-white font-bold text-4xl w-full flex justify-center items-center">
                            <svg class="w-10 h-10 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                            </svg>
                            <span>NG</span>
                        </button>
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

    @if(session()->has('success-masuk-session'))
        <script>
            successToast('{{ session()->get('success-masuk-session') }}')
        </script>
    @endif

    <div class="h-[20rem]"></div>
</div>
