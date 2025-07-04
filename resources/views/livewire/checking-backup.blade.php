<div>
    <x-partials.sidebar currentUrl="{{ $currentUrl }}">
        @if($adaShift)
            <div class="max-w-md mx-auto bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold mb-6">Shift Kerja</h2>
                <form wire:submit="saveShift" class="flex gap-5 items-end">
                    <div class="mb-5">
                        @if(session()->has('belum-pilih-shift'))
                            <p class="text-sm italic text-red-500 font-semibold">Kamu belum memilih shift</p>
                        @endif
                        <label for="shifts" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Shift</label>
                        <select required id="shifts" wire:model.live="shiftChoice" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @if(!in_array(auth()->user()->id, [$shiftSelected->shift1_id, $shiftSelected->shift2_id]))
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


                    @if((is_null($shiftSelected->shift1_id) or is_null($shiftSelected->shift2_id)) and !in_array(auth()->user()->id, [$shiftSelected->shift1_id, $shiftSelected->shift2_id]))
                        <div class="mb-3">
                            <button type="submit" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Masuk Shift</button>
                        </div>
                    @endif
                </form>
            </div>
        @else
            <div class="max-w-md mx-auto bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold mb-6">Form Input Pemeriksaan QC</h2>
                <form>
                    <!-- Produk -->
                    <div class="mb-4">
                        <label for="produk" class="block mb-2 text-sm font-medium text-gray-900">Produk</label>
                        <select id="produk" name="produk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option selected disabled>Pilih produk</option>
                            <option>Produk A</option>
                            <option>Produk B</option>
                            <option>Produk C</option>
                        </select>
                    </div>

                    <!-- Tanggal -->
                    <div class="mb-4">
                        <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900">Tanggal</label>
                        <div class="relative">
                            <input type="date" id="tanggal" name="tanggal" value="2024-04-24" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                        <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option selected disabled>Pilih status</option>
                            <option>OK</option>
                            <option>Defect</option>
                        </select>
                    </div>

                    <!-- Catatan -->
                    <div class="mb-4">
                        <label for="catatan" class="block mb-2 text-sm font-medium text-gray-900">Catatan</label>
                        <input type="text" id="catatan" name="catatan" placeholder="Masukkan catatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>

                    <!-- Tombol Simpan -->
                    <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Simpan
                    </button>
                </form>
            </div>
        @endif


        <div class="mx-auto px-4">
            <div class="bg-slate-300 p-5 w-full rounded-lg">
                <div class="flex justify-between">
                    <div class="flex flex-col gap-y-1">
                        <h1 class="text-xl font-semibold">
                            @if(auth()->user()->role == 'supervisor')
                                QA Checking
                            @else
                                Quality Control
                            @endif
                        </h1>
                        <p>Aplikasi Quality Control Item</p>
                    </div>


                </div>

                <div class="px-5 mt-5">
                    <div class="mb-5">
                        <label for="items" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Part Name</label>
                        <select wire:change="checkItemSelected($event.target.value)" id="items" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Pilih Item</option>
                            @foreach($items as $item)
                                @if($addPartNoBefore == 1 and !is_null($itemSelected) and $itemSelected->id == $item->id)
                                    <option value="{{ $item->id }}" selected>{{ $item->part_name }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->part_name }}</option>
                                @endif
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
                            <select wire:change="checkSelected($event.target.value)" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Pilih part no</option>
                                @foreach($checkings as $check)
                                    <option value="{{ $check->id }}">{{ $check->part_no }}</option>
                                @endforeach
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
                                            <form wire:submit="addPartNo" id="partnoForm">
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
                                                    @if(session()->has('part-no-kosong'))
                                                        <p class="text-red-500 text-sm italic">{{ session()->get('part-no-kosong') }}</p>
                                                    @endif
                                                </div>
                                            </form>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                            @if(!is_null($itemSelected))
                                                <button type="submit" form="partnoForm" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                                            @else
                                                <button type="submit" form="partnoForm" class="text-white bg-green-900 hover:cursor-not-allowed focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" disabled>Save</button>
                                            @endif
                                            <button data-modal-hide="add-partno-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="my-5 border-2 border-slate-400"></div>
                </div>

                <div x-data="{ open: false , ngtype: 'none' }">
                    <div x-show="!open" class="px-5 mt-5 h-[10rem]">
                        <div class="flex gap-4 h-full">
                            <button data-modal-target="confirm-ok-modal" data-modal-toggle="confirm-ok-modal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-4xl w-full flex justify-center items-center">
                                <svg class="w-10 h-10 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
                                </svg>
                                <span>OK</span>
                            </button>
                            <button @click="open = ! open" class="bg-red-500 hover:bg-red-700 text-white font-bold text-4xl w-full flex justify-center items-center">
                                <svg class="w-10 h-10 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                                </svg>
                                <span>NG</span>
                            </button>
                        </div>
                    </div>

                    <div x-show="open" class="px-5 mt-10">
                        <button @click="open = ! open" class="underline text-lg hover:text-blue-500 mb-5"> <-back</button>
                        <div class="grid grid-cols-4 gap-5 h-full">
                            <button @click="ngtype = 'SILVER'" data-modal-target="confirm-ng-modal" data-modal-toggle="confirm-ng-modal" class="bg-red-500 hover:bg-red-700 text-white font-bold text-3xl w-full p-5">SILVER</button>
                            <button @click="ngtype = 'BURRY'" data-modal-target="confirm-ng-modal" data-modal-toggle="confirm-ng-modal" class="bg-red-500 hover:bg-red-700 text-white font-bold text-3xl w-full p-5">BURRY</button>
                            <button @click="ngtype = 'GLOSS'" data-modal-target="confirm-ng-modal" data-modal-toggle="confirm-ng-modal" class="bg-red-500 hover:bg-red-700 text-white font-bold text-3xl w-full p-5">GLOSS</button>
                            <button @click="ngtype = 'FLOW BLACK'" data-modal-target="confirm-ng-modal" data-modal-toggle="confirm-ng-modal" class="bg-red-500 hover:bg-red-700 text-white font-bold text-3xl w-full p-5">FLOW BLACK</button>
                            <button @click="ngtype = 'BENANG RUNNER'" data-modal-target="confirm-ng-modal" data-modal-toggle="confirm-ng-modal" class="bg-red-500 hover:bg-red-700 text-white font-bold text-3xl w-full p-5">BENANG RUNNER</button>
                            <button @click="ngtype = 'SINMARK'" data-modal-target="confirm-ng-modal" data-modal-toggle="confirm-ng-modal" class="bg-red-500 hover:bg-red-700 text-white font-bold text-3xl w-full p-5">SINMARK</button>
                            <button @click="ngtype = 'STARTCH'" data-modal-target="confirm-ng-modal" data-modal-toggle="confirm-ng-modal" class="bg-red-500 hover:bg-red-700 text-white font-bold text-3xl w-full p-5">STARTCH</button>
                            <button @click="ngtype = 'SHOT MOLD'" data-modal-target="confirm-ng-modal" data-modal-toggle="confirm-ng-modal" class="bg-red-500 hover:bg-red-700 text-white font-bold text-3xl w-full p-5">SHOT MOLD</button>
                        </div>

                        <!-- Confirm NG modal -->
                        <div id="confirm-ng-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            NG Confirmation
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="confirm-ng-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5 space-y-4">
                                        <div class="mb-2">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Part Name</label>
                                            <input type="text" value="{{ (!is_null($checkQaSelected)) ? $checkQaSelected->item->part_name : '' }}" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly/>
                                        </div>
                                        <div class="mb-2">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Part No</label>
                                            <input type="text" value="{{ (!is_null($checkQaSelected)) ? $checkQaSelected->part_no : '' }}" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly/>
                                        </div>
                                        <div class="mb-2">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status QA</label>
                                            <div class="px-5 py-1 bg-red-500 w-fit">
                                                <p class="text-white text-center font-semibold text-lg" x-text="'NG - ' + ngtype">NG </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="flex justify-end items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                        @if(!is_null($itemSelected) and !is_null($shiftSelected) and !is_null($checkQaSelected))
                                            <button @click="$wire.saveNGConfirmation(ngtype)"
                                                    x-data="{loading:false}"
                                                    x-on:click="loading=true"
                                                    x-html="loading ? `<svg aria-hidden='true' class='w-4 h-4 inline-flex me-2 text-gray-200 animate-spin dark:text-gray-600 fill-red-600' viewBox='0 0 100 101' fill='none' xmlns='http://www.w3.org/2000/svg'>
                                                <path d='M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z' fill='currentColor'/>
                                                <path d='M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z' fill='currentFill'/>
                                                </svg> Please Wait ...` : 'Confirm NG'"
                                                    x-bind:disabled="loading"
                                                    type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirm NG</button>
                                        @else
                                            <button type="button" class="text-white bg-red-900 hover:cursor-not-allowed focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" disabled>Confirm NG</button>
                                        @endif
                                        <button data-modal-hide="confirm-ng-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirm OK modal -->
        <div id="confirm-ok-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            OK Confirmation
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="confirm-ok-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <div class="mb-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Part Name</label>
                            <input type="text" value="{{ (!is_null($checkQaSelected)) ? $checkQaSelected->item->part_name : '' }}" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly/>
                        </div>
                        <div class="mb-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Part No</label>
                            <input type="text" value="{{ (!is_null($checkQaSelected)) ? $checkQaSelected->part_no : '' }}" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly/>
                        </div>
                        <div class="mb-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status QA</label>
                            <div class="px-5 py-1 bg-blue-500 w-fit">
                                <p class="text-white text-center font-semibold text-lg">OK</p>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex justify-end items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        @if(!is_null($itemSelected) and !is_null($shiftSelected) and !is_null($checkQaSelected))
                            <button wire:click="saveOkConfirmation"
                                    x-data="{loading:false}"
                                    x-on:click="loading=true"
                                    x-html="loading ? `<svg aria-hidden='true' class='w-4 h-4 inline-flex me-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600' viewBox='0 0 100 101' fill='none' xmlns='http://www.w3.org/2000/svg'>
                    <path d='M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z' fill='currentColor'/>
                    <path d='M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z' fill='currentFill'/>
                    </svg> Please Wait ...` : 'Confirm OK'"
                                    x-bind:disabled="loading"
                                    type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirm OK</button>
                        @else
                            <button type="button" class="text-white bg-blue-900 hover:cursor-not-allowed focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" disabled>Confirm OK</button>
                        @endif
                        <button data-modal-hide="confirm-ok-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                    </div>
                </div>
            </div>
        </div>

        @if(session()->has('success-masuk-session'))
            <script>
                successToast('{{ session()->get('success-masuk-session') }}')
            </script>
        @endif

        @if(session()->has('success-add-part-no'))
            <script>
                successToast('Part No telah tambahkan')
            </script>
        @endif

        @if(session()->has('checking-success'))
            <script>
                successToast('QA Checking berhasil dilakukan')
            </script>
        @endif

        @if(session()->has('belum-masuk-shift'))
            <script>
                errorToast('{{ session()->get('belum-masuk-shift') }}')
            </script>
        @endif

        @if(session()->has('part-no-kosong'))
            <script>
                errorToast('{{ session()->get('part-no-kosong') }}')
            </script>
        @endif

        @if(session()->has('belum-memilih-item'))
            <script>
                errorToast('{{ session()->get('belum-memilih-item') }}')
            </script>
        @endif

        <div class="h-[20rem]"></div>
    </x-partials.sidebar>
</div>
