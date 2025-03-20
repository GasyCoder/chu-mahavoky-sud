<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Total Users -->
        <div class="bg-white rounded-lg shadow p-6 flex items-center space-x-4">
            <div class="p-3 rounded-full bg-turquoise">
                <i class="fas fa-users text-2xl text-white"></i>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-dark">Total personnels</h3>
                <p class="text-3xl font-bold text-purple">{{ $totalUsers }}</p>
            </div>
        </div>

        <!-- Total Services -->
        <div class="bg-white rounded-lg shadow p-6 flex items-center space-x-4">
            <div class="p-3 rounded-full bg-turquoise">
                <i class="fas fa-concierge-bell text-2xl text-white"></i>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-dark">Total Services</h3>
                <p class="text-3xl font-bold text-purple">{{ $totalServices }}</p>
            </div>
        </div>

        <!-- Placeholder Card -->
        <div class="bg-white rounded-lg shadow p-6 flex items-center space-x-4">
            <div class="p-3 rounded-full bg-turquoise">
                <i class="fas fa-chart-line text-2xl text-white"></i>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-dark">Activity</h3>
                <p class="text-3xl font-bold text-purple">N/A</p>
            </div>
        </div>
    </div>

    <!-- Recent Users Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-dark mb-4">Liste des personnels</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gray-light">
                            <th class="px-4 py-2 text-left text-sm font-medium text-dark">Name</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-dark">Email</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-dark">Role</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-dark">Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentUsers as $user)
                            <tr class="border-t border-gray">
                                <td class="px-4 py-2 text-sm text-dark">{{ $user->name }}</td>
                                <td class="px-4 py-2 text-sm text-dark">{{ $user->email }}</td>
                                <td class="px-4 py-2 text-sm text-dark">{{ $user->role }}</td>
                                <td class="px-4 py-2 text-sm text-dark">{{ $user->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
