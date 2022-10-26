<div class="position-fixed p-3" style="z-index: 20000; right: 0; bottom: 0; width: 310px">
    <div class="toast fade bg-secondary show"
         role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header text-white bg-dark border-info">
            <svg class="rounded mr-2" height="15" width="15" focusable="false">
                <rect width="100%" height="100%" fill="#FF0000" />
            </svg>
            <strong class="mr-auto">{{ session('errorTitle') }}</strong>
            <small class="text-muted">Только что</small>
        </div>

        <div class="toast-body text-white bg-secondary">
            <h6>{{ session('errorText') }}</h6>
        </div>

    </div>
</div>
