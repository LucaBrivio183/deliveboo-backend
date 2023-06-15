@if (session('message'))
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('message') }}
            </div>
        </div>
    </div>
@endif