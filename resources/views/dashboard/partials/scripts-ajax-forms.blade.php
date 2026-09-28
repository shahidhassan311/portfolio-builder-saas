<script>
document.addEventListener('DOMContentLoaded', () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    const flashWrapper = document.getElementById('flash-message');
    const flashInner = document.getElementById('flash-message-inner');

    function showFlash(message, type = 'success') {
        if (!flashWrapper || !flashInner) return;
        flashInner.textContent = message;
        flashWrapper.className = 'portal-flash ' + (type === 'success' ? 'success' : 'error');
        flashWrapper.classList.remove('hidden');
    }

    document.querySelectorAll('form.ajax-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const submitButton = form.querySelector('button[type="submit"]');
            const originalText = submitButton ? submitButton.textContent : null;
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.textContent = 'Saving...';
            }

            fetch(form.getAttribute('action'), {
                method: (form.getAttribute('method') || 'POST').toUpperCase(),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {})
                },
                body: new FormData(form)
            }).then(async response => {
                let data = null;
                try { data = await response.json(); } catch (e) {}

                if (response.ok) {
                    showFlash((data && data.message) || form.getAttribute('data-success-message') || 'Saved!', 'success');
                    if (form.getAttribute('data-reload') === 'true' || (data && data.reload)) {
                        setTimeout(() => window.location.reload(), 700);
                    }
                } else {
                    let errorMsg = data?.message || 'Something went wrong.';
                    if (data?.errors) {
                        const field = Object.keys(data.errors)[0];
                        if (field && data.errors[field][0]) errorMsg = data.errors[field][0];
                    }
                    showFlash(errorMsg, 'error');
                }
            }).catch(() => showFlash('Network error. Please try again.', 'error'))
            .finally(() => {
                if (submitButton) {
                    submitButton.disabled = false;
                    submitButton.textContent = originalText;
                }
            });
        });
    });
});
</script>
