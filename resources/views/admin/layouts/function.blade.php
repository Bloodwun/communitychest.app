<script>
function callAPI(endpoint, method = 'GET', data = null) {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    return new Promise((resolve, reject) => {
        $.ajax({
            url: endpoint,
            type: method,
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include CSRF token as a header
            },
            data: data,
            success: function(response) {
                resolve(response);
            },
            error: function(xhr, status, error) {
                reject(error);
            }
        });
    });
}
</script>
