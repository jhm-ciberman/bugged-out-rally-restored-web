const screenshotViewer = document.querySelector('[data-screenshot-viewer]');
const screenshotViewerImage = screenshotViewer.querySelector('img');

document.addEventListener('click', (event) => {
    const link = event.target.closest('[data-screenshot]');

    if (!link || event.ctrlKey || event.metaKey || event.shiftKey) {
        return;
    }

    event.preventDefault();
    screenshotViewerImage.src = link.href;
    screenshotViewerImage.alt = link.querySelector('img').alt;
    screenshotViewer.showModal();
});

screenshotViewer.addEventListener('click', () => screenshotViewer.close());
