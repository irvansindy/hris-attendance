<div>
    <table class="table-auto w-full">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">UID</th>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">State</th>
                <th class="px-4 py-2">Time Stamp</th>
                <th class="px-4 py-2">Type</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($attendances as $attendance)
                <tr>
                    <td class="px-4 py-2">{{ $attendance['uid'] }}</td>
                    <td class="px-4 py-2">{{ $attendance['id'] }}</td>
                    <td class="px-4 py-2">{{ $attendance['state'] }}</td>
                    <td class="px-4 py-2">{{ $attendance['timestamp'] }}</td>
                    <td class="px-4 py-2">{{ $attendance['type'] }}</td>
                </tr>
            @empty
                <td colspan="6">No Data</td>
            @endforelse
        </tbody>
    </table>
</div>