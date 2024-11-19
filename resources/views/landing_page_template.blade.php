<!doctype html>
<html lang="en">
<head>
    {!! $landing_page->header !!}
    @foreach($landing_page->css_files as $css_file)
        <link rel="stylesheet" href="{{asset("storage/landing_pages/$css_file")}}">
    @endforeach
    @foreach($landing_page->js_files as $js_file)
        <script  src="{{asset("storage/landing_pages/$js_file")}}"></script>
    @endforeach
<style>
        {!! $landing_page->css !!}
</style>
</head>
<body>
{!! $landing_page->html !!}
</body>

</html>

