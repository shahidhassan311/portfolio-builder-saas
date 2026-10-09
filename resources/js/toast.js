import '../css/toast.css';

const TOAST_DURATION_MS = 5500;

function ensureRoot() {
    let root = document.getElementById('toast-root');

    if (!root) {
        root = document.createElement('div');
        root.id = 'toast-root';
        root.className = 'toast-root';
        root.setAttribute('aria-live', 'polite');
        root.setAttribute('aria-atomic', 'true');
        document.body.appendChild(root);
    }

    return root;
}

function normalizeType(type) {
    if (type === 'success' || type === 'error' || type === 'info') {
        return type;
    }

    return 'info';
}

function pushToast(type, text) {
    const message = String(text ?? '').trim();

    if (message === '') {
        return;
    }

    const root = ensureRoot();
    const toast = document.createElement('div');
    toast.className = `toast toast--${normalizeType(type)}`;
    toast.innerHTML = `
        <span class="toast-text"></span>
        <button type="button" class="toast-close" aria-label="Dismiss">&times;</button>
    `;
    toast.querySelector('.toast-text').textContent = message;

    const dismiss = () => {
        toast.classList.remove('toast--visible');
        toast.classList.add('toast--leaving');
        window.setTimeout(() => toast.remove(), 220);
    };

    toast.querySelector('.toast-close').addEventListener('click', dismiss);
    root.appendChild(toast);
    requestAnimationFrame(() => toast.classList.add('toast--visible'));
    window.setTimeout(dismiss, TOAST_DURATION_MS);
}

export const ResumizoToast = {
    success(message) {
        pushToast('success', message);
    },
    error(message) {
        pushToast('error', message);
    },
    info(message) {
        pushToast('info', message);
    },
    pushMany(items) {
        if (!Array.isArray(items)) {
            return;
        }

        items.forEach((item) => {
            pushToast(item?.type ?? 'info', item?.text ?? '');
        });
    },
};

window.ResumizoToast = ResumizoToast;

window.showPortalFlash = function showPortalFlash(type, message) {
    if (type === 'success') {
        ResumizoToast.success(message);
        return;
    }

    if (type === 'error') {
        ResumizoToast.error(message);
        return;
    }

    ResumizoToast.info(message);
};

function hydrateServerToasts() {
    const payload = document.getElementById('server-toast-messages');

    if (!payload?.textContent) {
        return;
    }

    try {
        ResumizoToast.pushMany(JSON.parse(payload.textContent));
    } catch {
        // ignore malformed payload
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', hydrateServerToasts);
} else {
    hydrateServerToasts();
}
