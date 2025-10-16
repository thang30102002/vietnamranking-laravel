// Fix for CSRF Token Error
// This script provides a robust way to get CSRF token

function getCSRFToken() {
    // Method 1: Try meta tag first
    let csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (csrfToken) {
        return csrfToken.getAttribute('content');
    }
    
    // Method 2: Try form input
    csrfToken = document.querySelector('input[name="_token"]');
    if (csrfToken) {
        return csrfToken.value;
    }
    
    // Method 3: Try any form with _token
    const forms = document.querySelectorAll('form');
    for (let form of forms) {
        const tokenInput = form.querySelector('input[name="_token"]');
        if (tokenInput) {
            return tokenInput.value;
        }
    }
    
    // Method 4: Try to get from Laravel's global
    if (window.Laravel && window.Laravel.csrfToken) {
        return window.Laravel.csrfToken;
    }
    
    console.error('CSRF token not found in any method');
    return null;
}

// Safe upload function with retry mechanism
async function safeUpload(file, uploadUrl, retryCount = 0) {
    const token = getCSRFToken();
    if (!token) {
        throw new Error('CSRF token not found');
    }
    
    const data = new FormData();
    data.append('upload', file);
    data.append('_token', token);
    
    try {
        const response = await fetch(uploadUrl, {
            method: 'POST',
            body: data,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });
        
        // Check if response is HTML (error page)
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('text/html')) {
            throw new Error('Server returned HTML instead of JSON. This usually means an error page or redirect.');
        }
        
        if (!response.ok) {
            if (response.status === 419 && retryCount < 2) {
                // CSRF token expired, try to refresh and retry
                console.log('CSRF token expired, refreshing...');
                await refreshCSRFToken();
                return safeUpload(file, uploadUrl, retryCount + 1);
            }
            
            // Handle 422 validation errors
            if (response.status === 422) {
                const errorData = await response.json();
                const errorMessage = errorData.error?.details?.upload?.[0] || errorData.error?.message || 'Validation failed';
                throw new Error(`Validation error: ${errorMessage}`);
            }
            
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const result = await response.json();
        
        if (result.uploaded) {
            return {
                default: result.url
            };
        } else {
            throw new Error(result.error?.message || 'Upload failed');
        }
    } catch (error) {
        console.error('Upload error:', error);
        
        // Check if it's a JSON parse error
        if (error.message.includes('Unexpected token')) {
            throw new Error('Server returned invalid response. Please refresh the page and try again.');
        } else if (error.message.includes('HTML instead of JSON')) {
            throw new Error('Server error. Please check if the upload endpoint is working correctly.');
        } else {
            throw new Error('Upload failed: ' + error.message);
        }
    }
}

// CKEditor upload adapter
function createUploadAdapter(loader) {
    return {
        upload: function() {
            return safeUpload(loader.file, '/admin/news/upload-image');
        }
    };
}

// Refresh CSRF token
async function refreshCSRFToken() {
    try {
        const response = await fetch('/admin/news/create', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        if (response.ok) {
            const html = await response.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newToken = doc.querySelector('meta[name="csrf-token"]');
            
            if (newToken) {
                // Update the meta tag
                const currentMeta = document.querySelector('meta[name="csrf-token"]');
                if (currentMeta) {
                    currentMeta.setAttribute('content', newToken.getAttribute('content'));
                }
                console.log('CSRF token refreshed');
                return newToken.getAttribute('content');
            }
        }
    } catch (error) {
        console.error('Failed to refresh CSRF token:', error);
    }
    return null;
}

// Debug function
function debugCSRF() {
    console.log('=== CSRF Token Debug ===');
    console.log('Meta token:', document.querySelector('meta[name="csrf-token"]'));
    console.log('Form tokens:', document.querySelectorAll('input[name="_token"]'));
    console.log('Laravel global:', window.Laravel);
    console.log('Found token:', getCSRFToken());
    console.log('=======================');
}

// Auto debug on load
document.addEventListener('DOMContentLoaded', function() {
    debugCSRF();
});
