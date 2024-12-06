<!-- Modal for unsubscribe confirmation -->
<div class="modal fade" id="addInboxModal" tabindex="-1" aria-labelledby="addInboxModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInboxModalLabel">Add inbox</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="inbox_name" class="form-label">inbox</label>
                    <input type="email" class="form-control" id="inbox_name" placeholder="Enter email" required >
                </div>
                <p class="text-muted">Note: This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submit">Submit</button>
            </div>
        </div>
    </div>
</div>
