@extends('layouts.admin')

@section('title', 'Product Management | Tala')

@section('admin_content')
<div data-aos="fade-up" class="space-y-8 pb-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.dashboard') }}"
                class="h-12 w-12 bg-white border border-gray-100 rounded-2xl flex items-center justify-center text-gray-400 hover:text-blue-600 transition-all shadow-sm">
                <i class="material-icons-outlined">arrow_back</i>
            </a>
            <div class="h-14 w-14 bg-green-600 rounded-2xl flex items-center justify-center shadow-lg shadow-green-200">
                <i class="material-icons-outlined text-white text-3xl">inventory_2</i>
            </div>
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Product Inventory</h1>
                <p class="text-gray-500 font-medium">Manage stock, prices, and catalog visibility.</p>
            </div>
        </div>

        <button data-modal-target="addProductModal" data-modal-toggle="addProductModal"
            class="bg-gray-900 text-white px-8 py-3.5 rounded-2xl font-bold hover:bg-green-600 transition-all shadow-xl shadow-gray-200 flex items-center gap-2">
            <i class="material-icons-outlined text-sm">add_box</i>
            New Product
        </button>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
        <div class="p-8 overflow-x-auto">
            <table id="datatable" class="w-full text-sm text-left border-separate border-spacing-y-3">
                <thead class="text-gray-400 uppercase text-[11px] font-black tracking-[0.1em]">
                    <tr>
                        <th class="px-6 py-2">Product Info</th>
                        <th class="px-6 py-2">Category & Supplier</th>
                        <th class="px-6 py-2 text-center">Price</th>
                        <th class="px-6 py-2 text-center">Stock</th>
                        <th class="px-6 py-2 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr class="hover:bg-green-50/30 transition-all group bg-white">
                        <td class="px-6 py-5 rounded-l-2xl border-y border-l border-gray-50">
                            <div class="flex items-center gap-4">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/100' }}"
                                    class="h-14 w-14 rounded-xl object-cover shadow-sm">
                                <div>
                                    <p class="font-black text-gray-900 text-base leading-none mb-1">{{ $product->name }}
                                    </p>
                                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest italic">ID:
                                        #PRD-{{ $product->id }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5 border-y border-gray-50">
                            <span class="block font-bold text-gray-700">{{ $product->category->name }}</span>
                            <span class="text-xs text-blue-500 font-medium">{{ $product->supplier->store_name }}</span>
                        </td>
                        <td class="px-6 py-5 border-y border-gray-50 text-center font-black text-gray-900 text-base">
                            ₱{{ number_format($product->price, 2) }}
                        </td>
                        <td class="px-6 py-5 border-y border-gray-50 text-center">
                            <span
                                class="px-4 py-1.5 rounded-lg font-black text-[10px] {{ $product->stock <= 5 ? 'bg-red-100 text-red-600' : 'bg-gray-100 text-gray-600' }}">
                                {{ $product->stock }} IN STOCK
                            </span>
                        </td>
                        <td class="px-6 py-5 rounded-r-2xl border-y border-r border-gray-50 text-right">
                            <div class="flex justify-end gap-2">
                                <button type="button" data-modal-target="editProductModal"
                                    data-modal-toggle="editProductModal"
                                    onclick="openEditProductModal('{{ $product->id }}', '{{ $product->name }}', '{{ $product->supplier_id }}', '{{ $product->category_id }}', '{{ $product->price }}', '{{ $product->stock }}', '{{ $product->description }}')"
                                    class="h-10 w-10 bg-gray-50 text-gray-400 hover:bg-blue-600 hover:text-white rounded-xl transition-all">
                                    <i class="material-icons-outlined text-sm">edit</i>
                                </button>

                                <button type="button" onclick="confirmDeleteProduct({{ $product->id }})"
                                    class="h-10 w-10 bg-gray-50 text-red-400 hover:bg-red-600 hover:text-white rounded-xl transition-all">
                                    <i class="material-icons-outlined text-sm">delete_outline</i>
                                </button>

                                <form id="delete-prd-{{ $product->id }}"
                                    action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                    class="hidden">
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

<div id="addProductModal" tabindex="-1" aria-hidden="true"
    class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full overflow-y-auto">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-[2.5rem] p-10 shadow-2xl">
            <h3 class="text-2xl font-black text-gray-900 mb-8">Add New Product</h3>
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
                class="grid grid-cols-2 gap-6">
                @csrf
                <div class="col-span-2">
                    <label class="block text-xs font-black uppercase text-gray-400 mb-2">Product Name</label>
                    <input type="text" name="name" required
                        class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 outline-none focus:ring-2 focus:ring-green-500 transition-all font-bold">
                </div>
                <div>
                    <label class="block text-xs font-black uppercase text-gray-400 mb-2">Supplier</label>
                    <select name="supplier_id" required
                        class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 outline-none focus:ring-2 focus:ring-green-500 transition-all font-bold">
                        @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->store_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black uppercase text-gray-400 mb-2">Category</label>
                    <select name="category_id" required
                        class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 outline-none focus:ring-2 focus:ring-green-500 transition-all font-bold">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black uppercase text-gray-400 mb-2">Price (PHP)</label>
                    <input type="number" step="0.01" name="price" required
                        class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 outline-none focus:ring-2 focus:ring-green-500 transition-all font-bold">
                </div>
                <div>
                    <label class="block text-xs font-black uppercase text-gray-400 mb-2">Initial Stock</label>
                    <input type="number" name="stock" required
                        class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 outline-none focus:ring-2 focus:ring-green-500 transition-all font-bold">
                </div>
                <div class="col-span-2">
                    <label class="block text-xs font-black uppercase text-gray-400 mb-2">Product Image</label>
                    <input type="file" name="image"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-black file:bg-green-50 file:text-green-700 hover:file:bg-green-100 cursor-pointer">
                </div>
                <div class="col-span-2 flex gap-4 pt-4">
                    <button type="button" data-modal-hide="addProductModal"
                        class="flex-1 py-4 rounded-2xl font-bold text-gray-400 bg-gray-100">Cancel</button>
                    <button type="submit"
                        class="flex-1 py-4 rounded-2xl font-bold text-white bg-green-600 shadow-xl shadow-green-100">Publish
                        Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="editProductModal" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full overflow-y-auto">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-[2.5rem] p-10 shadow-2xl">
            <h3 class="text-2xl font-black text-gray-900 mb-8 uppercase tracking-tighter">Update Product</h3>
            <form id="editProductForm" method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-6">
                @csrf @method('PUT')

                <div class="col-span-2">
                    <label class="block text-xs font-black uppercase text-gray-400 mb-2">Product Name</label>
                    <input type="text" id="edit_prd_name" name="name" required class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 outline-none focus:ring-2 focus:ring-blue-500 transition-all font-bold">
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-gray-400 mb-2">Supplier</label>
                    <select id="edit_prd_supplier" name="supplier_id" required class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 outline-none focus:ring-2 focus:ring-blue-500 transition-all font-bold">
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->store_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-gray-400 mb-2">Category</label>
                    <select id="edit_prd_category" name="category_id" required class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 outline-none focus:ring-2 focus:ring-blue-500 transition-all font-bold">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-gray-400 mb-2">Price (PHP)</label>
                    <input type="number" step="0.01" id="edit_prd_price" name="price" required class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 outline-none focus:ring-2 focus:ring-blue-500 transition-all font-bold">
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-gray-400 mb-2">Current Stock</label>
                    <input type="number" id="edit_prd_stock" name="stock" required class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 outline-none focus:ring-2 focus:ring-blue-500 transition-all font-bold">
                </div>

                <div class="col-span-2">
                    <label class="block text-xs font-black uppercase text-gray-400 mb-2">Change Image (Optional)</label>
                    <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-black file:bg-blue-50 file:text-blue-700">
                </div>

                <div class="col-span-2 flex gap-4 pt-4">
                    <button type="button" data-modal-hide="editProductModal" class="flex-1 py-4 rounded-2xl font-bold text-gray-400 bg-gray-100">Cancel</button>
                    <button type="submit" class="flex-1 py-4 rounded-2xl font-bold text-white bg-blue-600 shadow-xl shadow-blue-100">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openEditProductModal(id, name, supplier, category, price, stock, description) {
    const form = document.getElementById('editProductForm');
    form.action = `/admin/products/${id}`;

    document.getElementById('edit_prd_name').value = name;
    document.getElementById('edit_prd_supplier').value = supplier;
    document.getElementById('edit_prd_category').value = category;
    document.getElementById('edit_prd_price').value = price;
    document.getElementById('edit_prd_stock').value = stock;
}

function confirmDeleteProduct(id) {
    Swal.fire({
        title: 'Delete Product?',
        text: "This item will be permanently removed from the catalog.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        confirmButtonText: 'Yes, delete it',
        customClass: { popup: 'rounded-[2rem]' }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-prd-' + id).submit();
        }
    })
}
</script>
@endsection
