{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{ url('/sitemap-pages.xml') }}</loc>
        <lastmod>{{ $pagesLastMod }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ url('/sitemap-blog.xml') }}</loc>
        <lastmod>{{ $blogLastMod }}</lastmod>
    </sitemap>
</sitemapindex>
