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

// Safe upload function
function safeUpload(file, uploadUrl) {
    return new Promise((resolve, reject) => {
        const token = getCSRFToken();
        if (!token) {
            reject('CSRF token not found');
            return;
        }
        
        const data = new FormData();
        data.append('upload', file);
        data.append('_token', token);
        
        fetch(uploadUrl, {
            method: 'POST',
            body: data
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(result => {
            if (result.uploaded) {
                resolve({
                    default: result.url
                });
            } else {
                reject(result.error?.message || 'Upload failed');
            }
        })
        .catch(error => {
            console.error('Upload error:', error);
            reject('Upload failed: ' + error.message);
        });
    });
}

// CKEditor upload adapter
function createUploadAdapter(loader) {
    return {
        upload: function() {
            return safeUpload(loader.file, '/admin/news/upload-image');
        }
    };
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
