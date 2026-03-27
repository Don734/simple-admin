import Quill from 'quill';
import "quill/dist/quill.snow.css";

document.addEventListener('DOMContentLoaded', () => {
    const textareaElements = document.querySelectorAll('textarea.editor');

    textareaElements.forEach((textareaElement) => {
        initQuillEditor(textareaElement);
    });
});

function initQuillEditor(textareaElement) {
    if (textareaElement.dataset.quillInitialized === 'true') {
        return;
    }

    let quillElement = document.querySelector(`[data-quill-target="${textareaElement.id}"]`);

    if (!quillElement) {
        quillElement = document.createElement('div');
        quillElement.className = 'quill-editor mb-2';
        quillElement.style.minHeight = textareaElement.style.height || '150px';
        textareaElement.insertAdjacentElement('beforebegin', quillElement);
    }

    textareaElement.classList.add('d-none');

    const quill = new Quill(quillElement, {
        theme: 'snow',
        modules: {
            toolbar: [
                ['bold', 'italic'],
                ['link', 'blockquote', 'code-block', 'image'],
                [{ list: 'ordered' }, { list: 'bullet' }]
            ]
        },
    });

    const initialValue = textareaElement.value.trim();

    if (initialValue) {
        quill.clipboard.dangerouslyPasteHTML(initialValue);
    }

    const syncEditorValue = () => {
        const html = quill.root.innerHTML;
        textareaElement.value = html === '<p><br></p>' ? '' : html;
    };

    quill.on('text-change', () => {
        syncEditorValue();
    });

    const form = textareaElement.closest('form');

    if (form) {
        form.addEventListener('submit', syncEditorValue);
    }

    textareaElement.dataset.quillInitialized = 'true';
}