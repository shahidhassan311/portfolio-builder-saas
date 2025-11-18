<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Theme') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.themes.update', $theme->id) }}"  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $theme->name) }}"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Slug</label>
                        <input
                            type="text"
                            name="slug"
                            value="{{ old('slug', $theme->slug) }}"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        >
                        <p class="mt-1 text-sm text-gray-500">e.g., classic, hero, super-portfolio</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Preview Image Path (optional)
                        </label>
                        {{-- manual path / URL (optional) --}}
                        <input
                            type="text"
                            name="preview_image"
                            value="{{ old('preview_image', $theme->preview_image) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            placeholder="storage/themes/super-portfolio.png or https://..."
                        >

                        <p class="mt-2 text-sm text-gray-500">
                            You can paste a path/URL above, or upload an image below.
                            If you upload a file, it will override the path.
                        </p>

                        {{-- file upload --}}
                        <div class="mt-3">
                            <label class="block text-sm font-medium text-gray-700">Upload Preview Image</label>
                            <input
                                type="file"
                                name="preview_image_file"
                                accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-700"
                            >
                        </div>

                        @if($theme->preview_image)
                            <p class="mt-2 text-sm text-gray-500">Current Preview:</p>
                            <img
                                src="{{ Str::startsWith($theme->preview_image, ['http://', 'https://'])
                    ? $theme->preview_image
                    : asset('storage/' . $theme->preview_image) }}"
                                alt="Theme preview"
                                class="mt-1 h-24 rounded border object-cover"
                            >
                        @endif
                    </div>

                    <div>
                        <label class="flex items-center">
                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                class="rounded border-gray-300"
                                {{ old('is_active', $theme->is_active) ? 'checked' : '' }}
                            >
                            <span class="ml-2 text-sm text-gray-700">Active</span>
                        </label>
                    </div>

                    <div>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                            Update Theme
                        </button>
                        <a href="{{ route('admin.themes.index') }}" class="ml-4 text-gray-600 hover:text-gray-800">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
