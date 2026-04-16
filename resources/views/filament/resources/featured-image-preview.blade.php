<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle featured image preview
    const featuredImageInput = document.querySelector('input[id*="featured_image"]');
    
    if (featuredImageInput) {
        featuredImageInput.addEventListener('change', function(e) {
            const file = this.files[0];
            if (!file || !file.type.startsWith('image/')) return;

            let preview = this.parentElement.querySelector('.featured-image-preview');
            if (!preview) {
                preview = document.createElement('div');
                preview.className = 'featured-image-preview mt-4 rounded-lg overflow-hidden border border-gray-300';
                this.parentElement.appendChild(preview);
            }

            const reader = new FileReader();
            reader.onload = function(event) {
                preview.innerHTML = `<img src="${event.target.result}" alt="Preview" class="w-full max-h-96 object-cover">`;
            };
            reader.readAsDataURL(file);
        });
    }

    // Watch for dynamically added file inputs
    const observer = new MutationObserver(function(mutations) {
        const inputs = document.querySelectorAll('input[id*="featured_image"]:not([data-preview-listener])');
        inputs.forEach(input => {
            input.setAttribute('data-preview-listener', 'true');
            input.addEventListener('change', function(e) {
                const file = this.files[0];
                if (!file || !file.type.startsWith('image/')) return;

                let preview = this.parentElement.querySelector('.featured-image-preview');
                if (!preview) {
                    preview = document.createElement('div');
                    preview.className = 'featured-image-preview mt-4 rounded-lg overflow-hidden border border-gray-300';
                    this.parentElement.appendChild(preview);
                }

                const reader = new FileReader();
                reader.onload = function(event) {
                    preview.innerHTML = `<img src="${event.target.result}" alt="Preview" class="w-full max-h-96 object-cover">`;
                };
                reader.readAsDataURL(file);
            });
        });
    });

    observer.observe(document.body, { childList: true, subtree: true });
});
</script>
