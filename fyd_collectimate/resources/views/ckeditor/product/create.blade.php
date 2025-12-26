<section class="bg-sub-section border-top border-secondary">
    <div class="container">
        <div>
            <form action="{{ route('products.create') }}" method="POST">
                @csrf <!-- Laravel CSRF protection -->

                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter product name" required
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label for="product_desc" class="form-label">Product Description</label>
                    <textarea name="product_desc" id="product_desc" cols="30" rows="10" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label for="teaser" class="form-label">Teaser</label>
                    <textarea name="teaser" id="teaser" cols="30" rows="3" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label for="compatible" class="form-label">Compatible with:</label>
                    <input type="text" name="compatible" id="compatible" placeholder="Enter the compatible with"
                        required class="form-control">
                </div>

                <div class="mb-3">
                    <label for="feature1" class="form-label">Feature 1</label>
                    <textarea name="feature1" id="feature1" cols="30" rows="3" class="form-control"></textarea>

                    <label for="feature2" class="form-label">Feature 2</label>
                    <textarea name="feature2" id="feature2" cols="30" rows="3" class="form-control"></textarea>

                    <label for="feature3" class="form-label">Feature 3</label>
                    <textarea name="feature3" id="feature3" cols="30" rows="3" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label">Note:</label>
                    <textarea name="notes" id="notes" cols="30" rows="10" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save Product Details</button>
            </form>
        </div>
    </div>
</section>

<!-- Include CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>

<script nonce="{{ $cspNonce }}">
    // CKEditor configuration for each textarea field
    ClassicEditor.create(document.querySelector('#product_desc'), {
            toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo'],
            // Make CKEditor content follow Bootstrap styling
            ckfinder: {
                uploadUrl: '/path/to/upload' // Configure your image upload URL here
            },
            // Inject Bootstrap classes to CKEditor content area
            extraPlugins: ['font', 'fontSize', 'highlight'],
            fontColor: '#000',
            fontSize: '14px',
            fontFamily: 'Arial, sans-serif',
            // Make CKEditor content box respect Bootstrap form control styles
            bodyClass: 'form-control',
        })
        .catch(error => {
            console.error("Error initializing CKEditor for product_desc:", error);
        });

    ClassicEditor.create(document.querySelector('#teaser'), {
            toolbar: ['bold', 'italic', 'link', 'undo', 'redo'],
            bodyClass: 'form-control', // Apply Bootstrap's form-control style to content area
        })
        .catch(error => {
            console.error("Error initializing CKEditor for teaser:", error);
        });

    ClassicEditor.create(document.querySelector('#feature1'), {
            toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo'],
            bodyClass: 'form-control', // Apply Bootstrap's form-control style to content area
        })
        .catch(error => {
            console.error("Error initializing CKEditor for feature1:", error);
        });

    ClassicEditor.create(document.querySelector('#feature2'), {
            toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo'],
            bodyClass: 'form-control', // Apply Bootstrap's form-control style to content area
        })
        .catch(error => {
            console.error("Error initializing CKEditor for feature2:", error);
        });

    ClassicEditor.create(document.querySelector('#feature3'), {
            toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo'],
            bodyClass: 'form-control', // Apply Bootstrap's form-control style to content area
        })
        .catch(error => {
            console.error("Error initializing CKEditor for feature3:", error);
        });

    ClassicEditor.create(document.querySelector('#notes'), {
            toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo'],
            bodyClass: 'form-control', // Apply Bootstrap's form-control style to content area
        })
        .catch(error => {
            console.error("Error initializing CKEditor for notes:", error);
        });
</script>
