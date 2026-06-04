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

    const resumeDropzone = document.getElementById('resume-dropzone');
    const resumeFileInput = document.getElementById('resume-file');
    const importUrl = @json(route('dashboard.resume.import'));

    function uploadResume(file) {
        if (!file) return;
        const ext = file.name.split('.').pop()?.toLowerCase();
        const allowed = ['application/pdf', 'text/plain'];
        if (!allowed.includes(file.type) && ext !== 'pdf' && ext !== 'txt') {
            showFlash('Please upload a PDF or TXT file.', 'error');
            return;
        }
        if (file.size > 5 * 1024 * 1024) {
            showFlash('File must be 5MB or smaller.', 'error');
            return;
        }

        resumeDropzone?.classList.add('is-dragover');
        const formData = new FormData();
        formData.append('resume', file);

        fetch(importUrl, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {})
            },
            body: formData
        }).then(async response => {
            let data = null;
            try { data = await response.json(); } catch (e) {}
            if (response.ok && data?.status === 'success') {
                showFlash(data.message || 'Resume imported! Refreshing…', 'success');
                if (data.reload) setTimeout(() => window.location.reload(), 1200);
            } else {
                showFlash(data?.message || 'Could not import resume.', 'error');
            }
        }).catch(() => showFlash('Network error. Please try again.', 'error'))
        .finally(() => {
            resumeDropzone?.classList.remove('is-dragover');
            if (resumeFileInput) resumeFileInput.value = '';
        });
    }

    if (resumeDropzone && resumeFileInput) {
        resumeDropzone.addEventListener('click', () => resumeFileInput.click());
        resumeDropzone.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); resumeFileInput.click(); }
        });
        resumeFileInput.addEventListener('change', () => {
            if (resumeFileInput.files?.[0]) uploadResume(resumeFileInput.files[0]);
        });
        ['dragenter', 'dragover'].forEach(evt => {
            resumeDropzone.addEventListener(evt, (e) => {
                e.preventDefault();
                resumeDropzone.classList.add('is-dragover');
            });
        });
        ['dragleave', 'drop'].forEach(evt => {
            resumeDropzone.addEventListener(evt, (e) => {
                e.preventDefault();
                resumeDropzone.classList.remove('is-dragover');
            });
        });
        resumeDropzone.addEventListener('drop', (e) => {
            const file = e.dataTransfer?.files?.[0];
            if (file) uploadResume(file);
        });
    }
});
</script>
