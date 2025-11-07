@extends('admin.dashboard')

@section('contents')
    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto px-5 lg:py-16">
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 rounded text-red-700">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Voucher</h2>
            <form action="{{ route('voucher.update', ['id' => $voucher->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-1">
                        <label for="code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Voucher
                            Code</label>
                        <input type="text" name="code" id="code" value="{{ $voucher->code }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="SALE2025" required>
                        
                    </div>

                    <div class="sm:col-span-1">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Voucher
                            Name</label>
                        <input type="text" name="name" id="name" value="{{ $voucher->name }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Giảm giá đặc biệt" required>
                        
                    </div>

                    <div class="sm:col-span-1">
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Discount
                            Type</label>
                        <select name="type" id="type"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="percent" {{ $voucher->type == 'percent' ? 'selected' : '' }}>Percent (%)</option>
                            <option value="fixed" {{ $voucher->type == 'fixed' ? 'selected' : '' }}>Fixed (Amount)</option>
                        </select>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="value" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Discount
                            Value</label>
                        <input type="number" name="value" id="value" value="{{ $voucher->value }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="10" required>
                       
                    </div>

                    <div class="sm:col-span-1">
                        <label for="max_discount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Max
                            Discount (optional)</label>
                        <input type="number" name="max_discount" id="max_discount" value="{{ $voucher->max_discount }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="50000">
                       
                    </div>

                    <div class="sm:col-span-1">
                        <label for="min_order_value"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Min Order Value</label>
                        <input type="number" name="min_order_value" id="min_order_value"
                            value="{{ $voucher->min_order_value }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="200000" required>
                       
                    </div>

                    <div class="sm:col-span-1">
                        <label for="usage_limit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Usage Limit
                        </label>
                        <input type="number" name="usage_limit" id="usage_limit" value="{{ $voucher->usage_limit }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="VD: 100" required>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start
                            Date</label>
                        <input type="date" name="start_date" id="start_date"
                            value="{{ \Carbon\Carbon::parse($voucher->start_date)->format('Y-m-d') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            required>
                      
                    </div>

                    <div class="sm:col-span-1">
                        <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End
                            Date</label>
                        <input type="date" name="end_date" id="end_date"
                            value="{{ \Carbon\Carbon::parse($voucher->end_date)->format('Y-m-d') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            required>
                        
                    </div>



                    <div class="sm:col-span-1">
                        <label for="status"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select name="status" id="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="1" {{ $voucher->status ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ !$voucher->status ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>

                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-6 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900">
                    Update Voucher
                </button>

            </form>
        </div>
    </section>
@endsection
