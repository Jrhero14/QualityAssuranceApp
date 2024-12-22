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
                    <select wire:change="checkItemSelected($event.target.value)" id="items" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Pilih Item</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}">{{ $item->part_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5 w-full">
                    <label for="partNo" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Part No <button data-popover-target="popover-description" data-popover-placement="bottom-start" type="button"><svg class="w-4 h-4 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg><span class="sr-only">Show information</span></button></label>
                    <div data-popover id="popover-description" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                        <div class="p-3 space-y-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Note:</h3>
                            <p>Apabila data part no tidak ada harap menambahkan data dengan klik tombok '+' disamping. Part no wajib dipilih sebelum melakukan pengecekan.</p>
                        </div>
                        <div data-popper-arrow></div>
                    </div>

                    <div class="flex items-center gap-2">
                        <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Pilih part no</option>
                            <option value="Part no 1">Part no 1</option>
                            <option value="Part no 2">Part no 2</option>
                            <option value="Part no 3">Part no 3</option>
                            <option value="Part no 4">Part no 4</option>
                        </select>

                        <button data-modal-target="add-partno-modal" data-modal-toggle="add-partno-modal" class="bg-green-500 p-2 rounded-lg hover:bg-green-600">
                            <svg class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                            </svg>
                        </button>

                        <!-- Main modal -->
                        <div id="add-partno-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            Add Part No
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="add-partno-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5 space-y-4">
                                        <form id="partnoForm">
                                            <div class="mb-3">
                                                <label for="partnoname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Part Name</label>
                                                @if(is_null($itemSelected))
                                                    <input type="text" id="partnoname" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly/>
                                                    <p class="text-red-500 text-sm italic">Kamu belum memilih part item</p>
                                                @else
                                                    <input type="text" id="partnoname" value="{{ $itemSelected->part_name }}" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly/>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label for="partnoAdd" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Part No</label>
                                                <input type="text" wire:model="addPartNoInput" id="partnoAdd" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required/>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                        <button type="submit" form="partnoForm" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                                        <button data-modal-hide="add-partno-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="my-5 border-2 border-slate-400"></div>
            </div

            @if(is_null($ngChoice))
                <div class="px-5 mt-5 h-[10rem]">
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
