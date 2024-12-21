<div>
    <x-partials.navbar currentUrl="{{ $currentUrl }}"></x-partials.navbar>

    <div class="max-w-screen-xl mx-auto pt-28">
        <nav class="flex mb-5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        Laporan QA
                    </a>
                </li>
            </ol>
        </nav>

        <div class="text-center my-5">
            <h1 class="text-2xl font-bold">LAPORAN HARIAN QUALITY INJECTION</h1>
        </div>

        <form class="max-w-sm">
            <div class="mb-5">
                <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hari/tanggal</label>
                <div class="flex gap-1">
                    <input type="date" id="tanggal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tampilkan</button>
                </div>
            </div>
        </form>


        <div class="relative overflow-x-auto sm:rounded-lg">
            <div class="mb-5 flex gap-3 w-full">
                <div class="w-full">
                    <h1 class="font-semibold text-sm">SHIFT 1:</h1>
                    <input type="text" id="tanggal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                </div>
                <div class="w-full">
                    <h1 class="font-semibold text-sm">SHIFT 2:</h1>
                    <input type="text" id="tanggal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                </div>
            </div>


            <table class="w-full text-sm text-left rtl:text-right text-black ">
                <thead class="text-xs text-black uppercase bg-slate-300 border-b border-slate-400 dark:text-white">
                <tr>
                    <th scope="col"  colspan=2 class="px-3 py-3 bg-slate-300"></th>
                    <th scope="col"  colspan=4 class="px-3 py-3 bg-slate-200 text-center">
                        QUALITY
                    </th>
                    <th scope="col"  colspan=8 class="px-3 py-3 bg-slate-300 text-center">
                        REMARK NG
                    </th>
                </tr>
                <tr>
                    <th scope="col" class="px-3 py-3 bg-slate-300">
                        Part No
                    </th>
                    <th scope="col" class="px-3 py-3 bg-slate-300">
                        Part Name
                    </th>

                    <th scope="col" class="px-3 py-3 bg-slate-200">
                        TOTAL
                    </th>
                    <th scope="col" class="px-3 py-3 bg-slate-200">
                        OK
                    </th>
                    <th scope="col" class="px-3 py-3 bg-slate-200">
                        NG
                    </th>
                    <th scope="col" class="px-3 py-3 bg-slate-200">
                        % NG
                    </th>

                    <th scope="col" class="px-3 py-3">
                        SLVR
                    </th>
                    <th scope="col" class="px-3 py-3">
                        BRY
                    </th>
                    <th scope="col" class="px-3 py-3">
                        GLS
                    </th>
                    <th scope="col" class="px-3 py-3">
                        FWBK
                    </th>
                    <th scope="col" class="px-3 py-3">
                        BNG RNR
                    </th>
                    <th scope="col" class="px-3 py-3">
                        SNMRK
                    </th>
                    <th scope="col" class="px-3 py-3">
                        STRATCH
                    </th>
                    <th scope="col" class="px-3 py-3">
                        SHOT MOLD
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="bg-slate-300 border-b border-slate-400">
                    <th scope="row" class="px-3 py-2 font-medium bg-slate-300 text-black whitespace-nowrap ">
                        67623-BZ150
                    </th>
                    <td class="px-3 py-2">
                        BOARD, FR DOOR TRIM, UPR RH
                    </td>
                    <td class="px-3 py-2 bg-slate-200">
                        300
                    </td>
                    <td class="px-3 py-2 bg-slate-200">
                        295
                    </td>
                    <td class="px-3 py-2 bg-slate-200">
                        20
                    </td>
                    <td class="px-3 py-2 bg-slate-200">
                        6,1 %
                    </td>
                    <td class="px-3 py-2">
                        5
                    </td>
                    <td class="px-3 py-2">
                        0
                    </td>
                    <td class="px-3 py-2">
                        3
                    </td>
                    <td class="px-3 py-2">
                        0
                    </td>
                    <td class="px-3 py-2">
                        5
                    </td>
                    <td class="px-3 py-2">
                        0
                    </td>
                    <td class="px-3 py-2">
                        6
                    </td>
                    <td class="px-3 py-2">
                        1
                    </td>
                </tr>

                </tbody>
            </table>
        </div>

        <div class="mt-10 bg-slate-300 w-fit">


            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-lg text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-3 py-3">
                            OK
                        </th>
                        <th scope="col" class="px-3 py-3">
                            NG
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-3 py-2 text-gray-900 whitespace-nowrap dark:text-white">
                            (295/330) x 100%
                        </td>
                        <td class="px-3 py-2 text-gray-900 whitespace-nowrap dark:text-white">
                            (20/330) x 100%
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th class="text-lg px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            89,4%
                        </th>
                        <td class="text-lg px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            6,1%
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="h-[10rem]"></div>

    </div>
</div>
