@if (session('success'))
    <div id="alert-success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 14.849a1 1 0 01-1.414 0L10 11.914l-2.934 2.935a1 1 0 01-1.414-1.415l2.935-2.934-2.935-2.934a1 1 0 011.415-1.415L10 9.086l2.934-2.935a1 1 0 011.415 1.415l-2.935 2.934 2.935 2.934a1 1 0 010 1.415z"/>
            </svg>
        </span>
    </div>
@endif

@if (session('error'))
    <div id="alert-error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 14.849a1 1 0 01-1.414 0L10 11.914l-2.934 2.935a1 1 0 01-1.414-1.415l2.935-2.934-2.935-2.934a1 1 0 011.415-1.415L10 9.086l2.934-2.935a1 1 0 011.415 1.415l-2.935 2.934 2.935 2.934a1 1 0 010 1.415z"/>
            </svg>
        </span>
    </div>
@endif

<script>
    // Automatically hide success message after 5 seconds
    setTimeout(() => {
        const successAlert = document.getElementById('alert-success');
        if (successAlert) {
            successAlert.style.transition = 'opacity 0.5s ease-out';
            successAlert.style.opacity = 0;
            setTimeout(() => successAlert.remove(), 500); // Remove it after fade out
        }
    }, 5000); // 5000ms = 5 seconds

    // Automatically hide error message after 5 seconds
    setTimeout(() => {
        const errorAlert = document.getElementById('alert-error');
        if (errorAlert) {
            errorAlert.style.transition = 'opacity 0.5s ease-out';
            errorAlert.style.opacity = 0;
            setTimeout(() => errorAlert.remove(), 500); // Remove it after fade out
        }
    }, 5000);
</script>
