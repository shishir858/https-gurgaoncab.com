<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sitemap</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background: #f5f7fb; color: #1f2937; }
        .container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px; }
        .card { width: 100%; max-width: 980px; background: #fff; border: 1px solid #e5e7eb; border-radius: 10px; box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06); }
        .card-body { padding: 28px; }
        h2 { margin: 0 0 10px; text-align: center; }
        p { margin: 0 0 20px; text-align: center; color: #6b7280; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #e5e7eb; padding: 10px; text-align: center; }
        th { background: #f9fafb; }
        a { color:rgb(88, 67, 1); text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2>Sitemap Links</h2>
                <p>You can directly access the pages and blog sitemap by clicking on the links provided below.</p>
                <table>
                    <thead>
                        <tr>
                            <th>Sitemap Type</th>
                            <th>Open Link</th>
                            <th>Last Modified</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Pages Sitemap</td>
                            <td>
                                <a href="{{ url('/sitemap-pages.xml') }}" target="_blank" rel="noopener noreferrer">
                                    {{ url('/sitemap-pages.xml') }}
                                </a>
                            </td>
                            <td>{{ $pagesLastMod ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Blog Sitemap</td>
                            <td>
                                <a href="{{ url('/sitemap-blog.xml') }}" target="_blank" rel="noopener noreferrer">
                                    {{ url('/sitemap-blog.xml') }}
                                </a>
                            </td>
                            <td>{{ $blogLastMod ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>