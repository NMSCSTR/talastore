@extends('layouts.admin')

@section('title', 'User Management | Tala Store')

@section('admin_content')
<div data-aos="fade-up" class="space-y-8 pb-10">

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-4">
            <div class="h-14 w-14 bg-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-200">
                <i class="material-icons-outlined text-white text-3xl">people_alt</i>
            </div>
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">User Management</h1>
                <p class="text-gray-500 font-medium">Manage permissions and view all registered accounts.</p>
            </div>
        </div>

        <button data-modal-target="addUserModal" data-modal-toggle="addUserModal"
            class="bg-gray-900 text-white px-8 py-3.5 rounded-2xl font-bold hover:bg-blue-600 transition-all shadow-xl shadow-gray-200 flex items-center gap-2">
            <i class="material-icons-outlined text-sm">person_add</i>
            Add New User
        </button>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
        <div
            class="p-8 border-b border-gray-50 bg-gray-50/30 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="relative w-full md:w-96">
                <i class="material-icons-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">search</i>
                <input type="text" placeholder="Search by name or email..."
                    class="w-full pl-12 pr-4 py-3 bg-white border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all outline-none text-sm font-medium">
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs font-black text-gray-400 uppercase tracking-widest mr-2">Filter By:</span>
                <select
                    class="bg-white border border-gray-200 rounded-xl px-4 py-2 text-xs font-bold text-gray-700 outline-none">
                    <option>All Roles</option>
                    <option>Admin</option>
                    <option>Supplier</option>
                    <option>Customer</option>
                </select>
            </div>
        </div>

        <div class="p-8 overflow-x-auto">
            <table id="datatable" class="w-full text-sm text-left border-separate border-spacing-y-3">
                <thead class="text-gray-400 uppercase text-[11px] font-black tracking-[0.1em]">
                    <tr>
                        <th class="px-6 py-2">Account Profile</th>
                        <th class="px-6 py-2">Basic Info</th>
                        <th class="px-6 py-2 text-center">Assigned Role</th>
                        <th class="px-6 py-2">Joined Date</th>
                        <th class="px-6 py-2 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y-0">
                    @foreach($users as $user)
                    <tr class="hover:bg-blue-50/30 transition-all group bg-white">
                        <td class="px-6 py-5 rounded-l-2xl border-y border-l border-gray-50">
                            <div class="flex items-center gap-4">
                                <div
                                    class="h-12 w-12 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white font-black text-lg shadow-md shadow-blue-100">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-black text-gray-900 text-base leading-none mb-1">{{ $user->name }}
                                    </p>
                                    <p class="text-xs text-gray-400 font-medium">UID: #{{ str_pad($user->id, 5, '0',
                                        STR_PAD_LEFT) }}</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-5 border-y border-gray-50">
                            <div class="flex flex-col gap-1">
                                <div class="flex items-center gap-2 text-gray-600 font-bold">
                                    <i class="material-icons-outlined text-xs">email</i>
                                    {{ $user->email }}
                                </div>

                                <div class="flex items-center gap-2 text-gray-400 text-xs font-medium">
                                    <i class="material-icons-outlined text-xs text-blue-400">phone</i>
                                    {{ $user->phone ?? 'No Contact' }}
                                </div>

                                <div
                                    class="flex items-center gap-2 text-gray-400 text-[10px] font-medium truncate max-w-[150px]">
                                    <i class="material-icons-outlined text-[10px]">location_on</i>
                                    {{ $user->address ?? 'No Address Provided' }}
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-5 border-y border-gray-50 text-center">
                            @php
                            $roleClasses = [
                            'admin' => 'bg-red-500 text-white shadow-red-100',
                            'supplier' => 'bg-purple-500 text-white shadow-purple-100',
                            'customer' => 'bg-blue-500 text-white shadow-blue-100'
                            ];
                            @endphp
                            <span
                                class="inline-flex items-center px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg {{ $roleClasses[$user->role] ?? 'bg-gray-500 text-white' }}">
                                {{ $user->role }}
                            </span>
                        </td>

                        <td class="px-6 py-5 border-y border-gray-50 text-gray-500 font-bold text-xs uppercase">
                            {{ $user->created_at->format('M d, Y') }}
                        </td>

                        <td class="px-6 py-5 rounded-r-2xl border-y border-r border-gray-50 text-right">
                            <div class="flex justify-end gap-2">
                                <button type="button"
                                    onclick="openEditModal('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}', '{{ $user->phone }}', '{{ $user->address }}')"
                                    data-modal-target="editUserModal" data-modal-toggle="editUserModal"
                                    class="h-10 w-10 bg-gray-50 text-gray-400 hover:bg-blue-600 hover:text-white rounded-xl transition-all duration-300">
                                    <i class="material-icons-outlined text-sm">edit</i>
                                </button>
                                <button onclick="deleteUser({{ $user->id }})"
                                    class="h-10 w-10 bg-gray-50 text-red-400 hover:bg-red-600 hover:text-white rounded-xl transition-all duration-300">
                                    <i class="material-icons-outlined text-sm">delete_outline</i>
                                </button>
                                <form id="delete-form-{{ $user->id }}"
                                    action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="hidden">
                                    @csrf @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="addUserModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-[2rem] shadow-2xl border border-gray-100 p-8">
            <h3 class="text-2xl font-black text-gray-900 mb-6">Add New User</h3>

            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-black uppercase text-gray-400 mb-1">Full Name</label>
                    <input type="text" name="name" required placeholder="John Doe"
                        class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none transition-all font-medium">
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-gray-400 mb-1">Email Address</label>
                    <input type="email" name="email" required placeholder="john@tala.com"
                        class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none transition-all font-medium">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-black uppercase text-gray-400 mb-1">Role</label>
                        <select name="role" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none transition-all font-bold">
                            <option value="customer">Customer</option>
                            <option value="supplier">Supplier</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase text-gray-400 mb-1">Phone Number</label>
                        <input type="text" name="phone" placeholder="09123456789"
                            class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none transition-all font-medium">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-gray-400 mb-1">Password</label>
                    <input type="password" name="password" required placeholder="••••••••"
                        class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none transition-all font-medium">
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-gray-400 mb-1">Complete Address</label>
                    <textarea name="address" rows="2" placeholder="Street, Barangay, City..."
                        class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none transition-all font-medium"></textarea>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" data-modal-hide="addUserModal"
                        class="flex-1 px-6 py-3 rounded-xl font-bold text-gray-500 bg-gray-100 hover:bg-gray-200 transition-all">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex-1 px-6 py-3 rounded-xl font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all">
                        Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="editUserModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-[2rem] shadow-2xl border border-gray-100 p-8">
            <h3 class="text-2xl font-black text-gray-900 mb-6 uppercase tracking-tighter">Update Account</h3>

            <form id="editUserForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-black uppercase text-gray-400 mb-1">Full Name</label>
                    <input type="text" id="edit_name" name="name" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none transition-all font-bold">
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-gray-400 mb-1">Email Address</label>
                    <input type="email" id="edit_email" name="email" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none transition-all font-bold">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-black uppercase text-gray-400 mb-1">Phone Number</label>
                        <input type="text" id="edit_phone" name="phone" placeholder="09123456789"
                            class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none transition-all font-bold">
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase text-gray-400 mb-1">Role</label>
                        <select id="edit_role" name="role"
                            class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none transition-all font-bold">
                            <option value="customer">Customer</option>
                            <option value="supplier">Supplier</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-xs font-black uppercase text-gray-400 mb-1">Complete Address</label>
                    <textarea id="edit_address" name="address" rows="2" placeholder="Street, Barangay, City..."
                        class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none transition-all font-bold"></textarea>
                </div>

                <div class="bg-blue-50 p-4 rounded-xl border border-blue-100">
                    <p class="text-[10px] text-blue-600 font-black uppercase leading-tight italic">
                        Note: Leave password blank to keep the current one.
                    </p>
                    <input type="password" name="password" placeholder="New Password"
                        class="mt-2 w-full px-4 py-3 rounded-xl border border-gray-100 bg-white focus:ring-2 focus:ring-blue-500 outline-none transition-all text-sm">
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" data-modal-hide="editUserModal"
                        class="flex-1 px-6 py-3 rounded-xl font-bold text-gray-500 bg-gray-100 hover:bg-gray-200 transition-all">Cancel</button>
                    <button type="submit"
                        class="flex-1 px-6 py-3 rounded-xl font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all">Save
                        Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function deleteUser(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This user and all their associated data will be permanently removed.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, delete user',
            cancelButtonText: 'Cancel',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-[2rem]',
                confirmButton: 'rounded-xl px-6 py-3 font-bold',
                cancelButton: 'rounded-xl px-6 py-3 font-bold'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }

    function openEditModal(id, name, email, role, phone, address) {
        const form = document.getElementById('editUserForm');
        form.action = `/admin/users/${id}`;

        document.getElementById('edit_name').value = name;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_role').value = role;
        document.getElementById('edit_phone').value = phone;
        document.getElementById('edit_address').value = address;
    }
</script>
@endsection
