@php
    $toastMessages = collect();

    if (session('success')) {
        $toastMessages->push(['type' => 'success', 'text' => session('success')]);
    }

    if (session('error')) {
        $toastMessages->push(['type' => 'error', 'text' => session('error')]);
    }

    if (session('status')) {
        $toastMessages->push(['type' => 'info', 'text' => session('status')]);
    }

    if (isset($errors) && $errors->any()) {
        foreach ($errors->all() as $error) {
            $toastMessages->push(['type' => 'error', 'text' => $error]);
        }
    }
@endphp

@if ($toastMessages->isNotEmpty())
    <script type="application/json" id="server-toast-messages">@json($toastMessages->values())</script>
@endif
