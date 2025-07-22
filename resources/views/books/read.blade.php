<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membaca: {{ $book->title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-bg-color: #2c2c2c;
            --text-color: #f0f0f0;
            --control-bg-color: rgba(0, 0, 0, 0.6);
            --control-hover-bg-color: rgba(0, 0, 0, 0.8);
            --shadow-color: rgba(0, 0, 0, 0.5);
        }

        html,
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            /* Mencegah scroll di body */
            background-color: var(--primary-bg-color);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: var(--text-color);
            display: flex;
            flex-direction: column;
        }

        .reader-header {
            background-color: var(--control-bg-color);
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px var(--shadow-color);
            z-index: 10;
            flex-shrink: 0;
            /* Pastikan header tidak menyusut */
        }

        .reader-header h1 {
            margin: 0;
            font-size: 1.5em;
            color: var(--text-color);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            /* Beri ruang untuk tombol close */
            padding-right: 50px;
        }

        .reader-header .close-button {
            background: none;
            border: none;
            color: var(--text-color);
            font-size: 1.8em;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.2s ease;
            position: absolute;
            right: 20px;
            top: 10px;
        }

        .reader-header .close-button:hover {
            background-color: var(--control-hover-bg-color);
        }

        /* Kontainer untuk iframe PDF.js viewer */
        .pdf-viewer-container {
            flex-grow: 1;
            /* Ambil sisa ruang vertikal */
            width: 100%;
            height: 100%;
        }

        #pdf-viewer-frame {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* --- Responsivitas --- */
        @media (max-width: 768px) {
            .reader-header h1 {
                font-size: 1.2em;
            }

            .reader-header .close-button {
                font-size: 1.7em;
                right: 15px;
                top: 8px;
            }
        }
    </style>
</head>

<body>

    <div class="reader-header">
        <h1>Membaca: {{ $book->title }}</h1>
        <a class="close-button" href="{{ url('/books/' . $book->slug) }}" title="Kembali">×</a>
    </div>

    <div class="pdf-viewer-container">
        <iframe id="pdf-viewer-frame" title="PDF Viewer untuk {{ $book->title }}"></iframe>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // URL ke viewer.html dari PDF.js yang sudah diletakkan di public/pdfjs
            const viewerUrl = "{{ asset('pdfjs/web/viewer.html') }}";

            // URL ke file PDF Anda
            const pdfFileUrl = "{{ asset('storage/' . $book->pdf_path) }}";

            // PDF.js viewer menerima URL file melalui parameter 'file'
            // Kita perlu melakukan encodeURIComponent untuk memastikan URL valid
            const iframeSrc = `${viewerUrl}?file=${encodeURIComponent(pdfFileUrl)}`;

            // Set sumber iframe
            const iframe = document.getElementById('pdf-viewer-frame');
            iframe.src = iframeSrc;
        });
    </script>

</body>

</html>