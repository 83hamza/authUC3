<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'authUC3 | University of Constantine 3')</title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<script>
function confirmDelete(button) {
    const form = button.closest('form');

    Swal.fire({
        title: 'هل أنت متأكد؟',
        text: 'لن يمكنك استرجاع المستخدم بعد الحذف!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#3b82f6',
        confirmButtonText: 'نعم احذف',
        cancelButtonText: 'إلغاء'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body class="font-sans antialiased">
    <!-- ✅ الخلفية سماوية زاهية بدل رمادي -->
    <div class="min-h-screen bg-sky-100">

        @include('layouts.navigation')

        <!-- ✅ العنوان إن وجد -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- ✅ محتوى الصفحات -->
        <main class="py-10">
            {{ $slot }}
        </main>

    </div>
</body>
</html>

