@extends('admin.parent')
@section('space-work')
    <div class="font-[sans-serif] overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="whitespace-nowrap">
                <tr>
                    <th class="p-4 text-left text-sm font-semibold text-black">
                        Name
                    </th>
                    <th class="p-4 text-left text-sm font-semibold text-black">
                        Date
                    </th>
                    <th class="p-4 text-left text-sm font-semibold text-black">
                        Check-In
                    </th>
                    <th class="p-4 text-left text-sm font-semibold text-black">
                        Check-Out
                    </th>
                    <th class="p-4 text-left text-sm font-semibold text-black">
                        Total Time
                    </th>
                    <th class="p-4 text-left text-sm font-semibold text-black">
                        Status
                    </th>
                    <th class="p-4 text-left text-sm font-semibold text-black">
                        Action
                    </th>
                </tr>
            </thead>

            <tbody class="whitespace-nowrap">
                @if ($myattendences->isNotEmpty())
                    @foreach ($myattendences as $myattendence)
                        <tr class="odd:bg-blue-50">
                            <td class="text-sm">
                                <div class="flex items-center cursor-pointer w-max">
                                    <div class="ml-4">
                                        <p class="text-sm text-black">{{ $myattendence->name }}</p>
                                        <p class="text-xs text-gray-500 mt-0.5">{{ $myattendence->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 text-sm text-black">
                                {{ $myattendence->formatted_date }}
                            </td>
                            <td class="p-4 text-sm text-black">
                                {{ $myattendence->formatted_checkin }}
                            </td>
                            <td class="p-4 text-sm text-black">
                                {{ $myattendence->formatted_checkout }}
                            </td>
                            <td class="p-4 text-sm text-black">
                                {{ $myattendence->total_time }}
                            </td>
                            <td class="p-4 text-sm text-black">
                                <button
                                    class="mr-4 text-sm py-2 px-2 {{ $myattendence->status == 'Present' ? 'bg-[#3b82f6]' : 'bg-red-600' }} text-white rounded"
                                    title="Edit">
                                    {{ $myattendence->status }}
                                </button>
                            </td>
                            <td class="p-4">
                                <button class="mr-4 text-sm py-2 px-3 bg-green-600 text-white rounded" title="Edit">
                                    Request Correction
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection
