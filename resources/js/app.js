// ============ ALPINE.JS ============
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// ============ JQUERY & SUMMERNOTE ============
import './bootstrap';
import $ from 'jquery';
import 'summernote/dist/summernote-lite.min.css';
import 'summernote/dist/summernote-lite.min.js';

window.$ = $;
window.jQuery = $;

// Inisialisasi Summernote setelah DOM siap
$(document).ready(function() {
    // Cek apakah element #content ada di halaman
    if ($('#content').length > 0) {
        $('#content').summernote({
            placeholder: 'Tulis konten di sini...',
            tabsize: 2,
            height: 500,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            styleTags: ['p', 'h1', 'h2', 'h3', 'h4', 'blockquote'],
        });
        console.log('✅ Summernote berhasil diinisialisasi');
    } else {
        console.log('Element #content tidak ditemukan di halaman ini');
    }
});