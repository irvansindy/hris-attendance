<div>
    <table class="table-auto w-full">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">UID</th>
                <th class="px-4 py-2">User ID</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Role</th>
                <th class="px-4 py-2">Password</th>
                <th class="px-4 py-2">Card No</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td class="px-4 py-2">{{ $user['uid'] }}</td>
                    <td class="px-4 py-2">{{ $user['userid'] }}</td>
                    <td class="px-4 py-2">{{ $user['name'] }}</td>
                    <td class="px-4 py-2">{{ $user['role'] }}</td>
                    <td class="px-4 py-2">{{ $user['password'] }}</td>
                    <td class="px-4 py-2">{{ $user['cardno'] }}</td>
                </tr>
            @empty
                <td colspan="6">No Data</td>
            @endforelse
        </tbody>
    </table>
</div>