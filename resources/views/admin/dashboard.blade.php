<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
</head>
<body style="font-family: sans-serif; max-width: 960px; margin: 0 auto; padding: 2rem;">
    <h1>Admin Dashboard</h1>
    <p>Single-codebase content administration.</p>
    <ul>
        <li>Products: {{ $products }}</li>
        <li>Blogs: {{ $blogs }}</li>
        <li>Pages: {{ $pages }}</li>
    </ul>
</body>
</html>
