<!DOCTYPE html>
<html>
<head>
    <title>Test Page Content</title>
</head>
<body>
    <h1>Page Content Test</h1>
    <ul>
        @php
            $sections = ['about-intro', 'about-hub', 'about-character', 'vision-content', 'mission-content'];
            foreach ($sections as $section) {
                $content = \App\Models\PageContent::getContent('college-about', $section, 'NOT FOUND');
                $preview = substr(strip_tags($content), 0, 100);
                echo "<li><strong>" . $section . ":</strong> " . htmlspecialchars($preview) . "...</li>";
            }
        @endphp
    </ul>
</body>
</html>
