document.addEventListener("DOMContentLoaded", function () {
    const lazyImages = document.querySelectorAll('img[data-src]');

    lazyImages.forEach(image => {
        const img = new Image();
        img.src = image.getAttribute('data-src');

        img.onload = function () {
            image.src = img.src; // Assign data-src when it loads successfully
        };

        img.onerror = function () {
            image.src = '../assets/images/img-loading.png'; // Fallback if image doesn't exist
        };
    });
});