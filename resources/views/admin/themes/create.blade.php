<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Theme') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.themes.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Slug</label>
                        <input type="text" name="slug" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <p class="mt-1 text-sm text-gray-500">e.g., classic, hero</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Preview Image Path (optional)</label>
                        <input
                            type="text"
                            name="preview_image"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            placeholder="storage/themes/super-portfolio.png or https://..."
                        >
                        <p class="mt-1 text-sm text-gray-500">
                            You can paste a path/URL above, or upload an image below. If you upload, it will be used instead.
                        </p>

                        <div class="mt-3">
                            <label class="block text-sm font-medium text-gray-700">Upload Preview Image</label>
                            <input
                                type="file"
                                name="preview_image_file"
                                accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-700"
                            >
                        </div>
                    </div>

                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" checked class="rounded border-gray-300">
                            <span class="ml-2 text-sm text-gray-700">Active</span>
                        </label>
                    </div>
                    <div>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Create Theme</button>
                        <a href="{{ route('admin.themes.index') }}" class="ml-4 text-gray-600 hover:text-gray-800">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

