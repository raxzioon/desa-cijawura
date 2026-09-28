<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 dark:text-gray-300 leading-tight">
            {{ __('Manajemen Role & Hak Akses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                    <div class="bg-green-100 dark:bg-green-200 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        <strong class="font-bold">Berhasil!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                    @endif

                    <div class="mb-6">
                        <p class="text-gray-600 dark:text-gray-400">
                            Kelola hak akses untuk setiap role pengguna. Admin memiliki akses penuh ke semua fitur.
                        </p>
                    </div>

                    @foreach($roles as $roleKey => $roleName)
                    <div class="mb-8">
                        <div class="border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                {{ $roleName }}
                                @if($roleKey === 'admin')
                                <span class="ml-2 px-2 py-1 text-xs bg-red-100 text-red-800 rounded">Full Access</span>
                                @endif
                            </h3>
                        </div>

                        <form action="{{ route('admin.roles.update') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="role" value="{{ $roleKey }}">

                            @if($roleKey !== 'admin')
                            @foreach($permissions as $module => $modulePermissions)
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <h4 class="font-medium text-gray-700 dark:text-gray-300 mb-3">{{ $module }}</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                    @foreach($modulePermissions as $permission)
                                    <label class="flex items-center">
                                        <input type="checkbox"
                                            name="permissions[]"
                                            value="{{ $permission->id }}"
                                            {{ in_array($permission->name, $rolePermissions[$roleKey]) ? 'checked' : '' }}
                                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $permission->display_name }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Update Hak Akses
                                </button>
                            </div>
                            @else
                            <div class="bg-green-50 dark:bg-green-900 p-4 rounded-lg">
                                <p class="text-green-800 dark:text-green-200">
                                    <strong>Administrator</strong> memiliki akses penuh ke semua fitur sistem dan tidak dapat diubah.
                                </p>
                            </div>
                            @endif
                        </form>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>