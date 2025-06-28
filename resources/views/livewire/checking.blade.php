<div>
    <x-partials.sidebar currentUrl="{{ $currentUrl }}">
        <div class="w-full mx-auto flex flex-col justify-center items-center">
            @if(!$adaShift)
                <div class="w-full bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold mb-6">Shift Kerja</h2>
                    <h4 class="text-sm mb-6">Anda harus melakukan absensi shift untuk memulai pengecekan Quality
                        Control</h4>
                    <form wire:submit="saveShift" class="flex gap-5 items-end">
                        <div class="mb-5">
                            @if(session()->has('belum-pilih-shift'))
                                <p class="text-sm italic text-red-500 font-semibold">Kamu belum memilih shift</p>
                            @endif
                            <label for="shifts"
                                   class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Shift</label>
                            <select required id="shifts" wire:model.live="shiftChoice"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
                            <label for="date"
                                   class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                            <input disabled type="date" value="{{ date('Y-m-d') }}" id="date"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required/>
                        </div>


                        @if((is_null($shiftSelected->shift1_id) or is_null($shiftSelected->shift2_id)) and !in_array(auth()->user()->id, [$shiftSelected->shift1_id, $shiftSelected->shift2_id]))
                            <div class="mb-3">
                                <button type="submit"
                                        class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                    Masuk Shift
                                </button>
                            </div>
                        @endif
                    </form>
                </div>
            @else
                <div class="w-[40rem] bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold mb-6">Form Input Pemeriksaan QC</h2>
                    <div>
                        <!-- Part Name -->
                        <div class="mt-5">
                            <div class="mb-5">
                                <label for="items" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Part
                                    Name</label>
                                <select wire:change="checkItemSelected($event.target.value)" id="items"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
                                <label for="partNo" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Part
                                    No
                                    <button data-popover-target="popover-description" data-popover-placement="bottom-start"
                                            type="button">
                                        <svg class="w-4 h-4 text-gray-400 hover:text-gray-500" aria-hidden="true"
                                             fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Show information</span></button>
                                </label>
                                <div data-popover id="popover-description" role="tooltip"
                                     class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                                    <div class="p-3 space-y-2">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Note:</h3>
                                        <p>Apabila data part no tidak ada harap menambahkan data dengan klik tombok '+'
                                            disamping. Part no wajib dipilih sebelum melakukan pengecekan.</p>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>

                                <div class="flex items-center gap-2">
                                    <select wire:change="checkSelected($event.target.value)" id="countries"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected>Pilih part no</option>
                                        @foreach($checkings as $check)
                                            <option value="{{ $check->id }}">{{ $check->part_no }}</option>
                                        @endforeach
                                    </select>

                                    <button data-modal-target="add-partno-modal" data-modal-toggle="add-partno-modal"
                                            class="bg-green-500 p-2 rounded-lg hover:bg-green-600">
                                        <svg class="w-6 h-6 text-white " aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                             viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2" d="M5 12h14m-7 7V5"/>
                                        </svg>
                                    </button>

                                    <!-- Main modal -->
                                    <div id="add-partno-modal" tabindex="-1" aria-hidden="true"
                                         class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div
                                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                        Add Part No
                                                    </h3>
                                                    <button type="button"
                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                            data-modal-hide="add-partno-modal">
                                                        <svg class="w-3 h-3" aria-hidden="true"
                                                             xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                  stroke-linejoin="round" stroke-width="2"
                                                                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 md:p-5 space-y-4">
                                                    <form wire:submit="addPartNo" id="partnoForm">
                                                        <div class="mb-3">
                                                            <label for="partnoname"
                                                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Part
                                                                Name</label>
                                                            @if(is_null($itemSelected))
                                                                <input type="text" id="partnoname"
                                                                       class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                       readonly/>
                                                                <p class="text-red-500 text-sm italic">Kamu belum memilih
                                                                    part item</p>
                                                            @else
                                                                <input type="text" id="partnoname"
                                                                       value="{{ $itemSelected->part_name }}"
                                                                       class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                       readonly/>
                                                            @endif
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="partnoAdd"
                                                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Part
                                                                No</label>
                                                            <input type="text" wire:model="addPartNoInput" id="partnoAdd"
                                                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                   required/>
                                                            @if(session()->has('part-no-kosong'))
                                                                <p class="text-red-500 text-sm italic">{{ session()->get('part-no-kosong') }}</p>
                                                            @endif
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- Modal footer -->
                                                <div
                                                    class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                    @if(!is_null($itemSelected))
                                                        <button type="submit" form="partnoForm"
                                                                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                            Save
                                                        </button>
                                                    @else
                                                        <button type="submit" form="partnoForm"
                                                                class="text-white bg-green-900 hover:cursor-not-allowed focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                                disabled>Save
                                                        </button>
                                                    @endif
                                                    <button data-modal-hide="add-partno-modal" type="button"
                                                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                        Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tanggal -->
                        <div class="mb-4">
                            <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900">Tanggal</label>
                            <div class="relative">
                                <input type="date" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                        </div>

                        <!-- Status -->
                        <div x-data="{ status: '', ngtype: 'none' }">
                            <!-- Status -->
                            <div class="mb-4">
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                                <select id="status" name="status" x-model="status"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="" disabled selected>Pilih status</option>
                                    <option value="OK">OK</option>
                                    <option value="Defect">Defect</option>
                                </select>
                            </div>

                            <!-- NG Type (Muncul jika status == Defect) -->
                            <div class="mb-4" x-show="status === 'Defect'" x-transition>
                                <label for="ng_type" class="block mb-2 text-sm font-medium text-gray-900">Jenis NG</label>
                                <select id="ng_type" name="ng_type"
                                        class="bg-red-50 border border-red-300 text-red-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">
                                    <option value="" disabled selected>Pilih jenis NG</option>
                                    <option @click="ngtype = 'SILVER'" value="SILVER">SILVER</option>
                                    <option @click="ngtype = 'BURRY'" value="BURRY">BURRY</option>
                                    <option @click="ngtype = 'GLOSS'" value="GLOSS">GLOSS</option>
                                    <option @click="ngtype = 'FLOW BLACK'" value="FLOW BLACK">FLOW BLACK</option>
                                    <option @click="ngtype = 'BENANG RUNNER'" value="BENANG RUNNER">BENANG RUNNER</option>
                                    <option @click="ngtype = 'SINMARK'" value="SINMARK">SINMARK</option>
                                    <option @click="ngtype = 'STARTCH'" value="STARTCH">STARTCH</option>
                                    <option @click="ngtype = 'SHOT MOLD'" value="SHOT MOLD">SHOT MOLD</option>
                                </select>
                            </div>

                            <!-- Modal Konfirmasi -->
                            <div id="konfirmasi-modal" tabindex="-1" aria-hidden="true"
                                 class="hidden fixed top-0 left-0 right-0 z-50 flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                OK Confirmation
                                            </h3>
                                            <!-- Tombol close (X) -->
                                            <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-hide="konfirmasi-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                     fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                          stroke-linejoin="round" stroke-width="2"
                                                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5 space-y-4">
                                            <div class="mb-2">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Part
                                                    Name</label>
                                                <input type="text"
                                                       value="{{ (!is_null($checkQaSelected)) ? $checkQaSelected->item->part_name : '' }}"
                                                       class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                       readonly/>
                                            </div>
                                            <div class="mb-2">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Part
                                                    No</label>
                                                <input type="text"
                                                       value="{{ (!is_null($checkQaSelected)) ? $checkQaSelected->part_no : '' }}"
                                                       class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                       readonly/>
                                            </div>
                                            <div x-show="status === 'OK'" class="mb-2">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status
                                                    QA</label>
                                                <div class="px-5 py-1 bg-blue-500 w-fit">
                                                    <p class="text-white text-center font-semibold text-lg">OK</p>
                                                </div>
                                            </div>
                                            <div x-show="status === 'Defect'" class="mb-2">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status
                                                    QA</label>
                                                <div class="px-5 py-1 bg-red-500 w-fit">
                                                    <p class="text-white text-center font-semibold text-lg"
                                                       x-text="'NG - ' + ngtype">NG </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal footer -->
                                        <div
                                            class="flex justify-end items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                            @if(!is_null($itemSelected) and !is_null($shiftSelected) and !is_null($checkQaSelected))
                                                <button x-show="status === 'OK'" wire:click="saveOkConfirmation"
                                                        x-data="{loading:false}"
                                                        x-on:click="loading=true"
                                                        x-html="loading ? `<svg aria-hidden='true' class='w-4 h-4 inline-flex me-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600' viewBox='0 0 100 101' fill='none' xmlns='http://www.w3.org/2000/svg'>
                    <path d='M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z' fill='currentColor'/>
                    <path d='M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z' fill='currentFill'/>
                    </svg> Please Wait ...` : 'Confirm OK'"
                                                        x-bind:disabled="loading"
                                                        type="button"
                                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    Confirm OK
                                                </button>
                                                <button x-show="status === 'Defect'" @click="$wire.saveNGConfirmation(ngtype)"
                                                        x-data="{loading:false}"
                                                        x-on:click="loading=true"
                                                        x-html="loading ? `<svg aria-hidden='true' class='w-4 h-4 inline-flex me-2 text-gray-200 animate-spin dark:text-gray-600 fill-red-600' viewBox='0 0 100 101' fill='none' xmlns='http://www.w3.org/2000/svg'>
                                                <path d='M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z' fill='currentColor'/>
                                                <path d='M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z' fill='currentFill'/>
                                                </svg> Please Wait ...` : 'Confirm NG'"
                                                        x-bind:disabled="loading"
                                                        type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirm NG</button>
                                            @else
                                                <button type="button"
                                                        class="text-white bg-blue-900 hover:cursor-not-allowed focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                        disabled>Confirm OK
                                                </button>
                                            @endif
                                            <!-- Tombol Decline -->
                                            <button data-modal-hide="konfirmasi-modal" type="button"
                                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                Decline
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Simpan -> Trigger Modal -->
                        <button type="button"
                                data-modal-target="konfirmasi-modal"
                                data-modal-toggle="konfirmasi-modal"
                                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Simpan
                        </button>
                    </div>
                </div>
            @endif
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
                successToast('QC berhasil dilakukan')
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
    </x-partials.sidebar>
</div>
