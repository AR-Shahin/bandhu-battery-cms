
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield("title", "Shop") | Shop</title>
    
    <meta name="description" content="{{ $website->meta }}">
    <meta name="keywords" content="{{ $website->tags }}">

    <meta property="og:title" content="{{ $website->title }}">
    <meta property="og:description" content="{{ $website->meta }}">
    <meta property="og:image" content="{{ asset($website->logo ) }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ $website->title }}">

    <link rel="stylesheet" href="{{ asset("admin/plugins/select2/css/select2.min.css") }}">
    <link rel="stylesheet" href="{{ asset("frontend/assets/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("frontend") }}/assets/css/all.min.css">
    <link rel="stylesheet" href="{{ asset("frontend") }}/assets/css/style.css" />

    @stack("css")
</head>

<body>
  <!-- ======================header started====================== -->
  @include("front.inc.header")
  <!-- ======================Main started====================== -->
 <main>
    @yield("master_content")
 </main>

  <!-- =====================>>>>>Footer Started>>>>>======================== -->
  @include("front.inc.footer")
</body>


<script src="{{ asset("frontend") }}/assets/js/jquery-3.2.1.min.js"></script>
<script src="{{ asset("admin/plugins/select2/js/select2.full.min.js") }}"></script>
<script src="{{ asset("frontend") }}/assets/js/popper.min.js"></script>
<script src="{{ asset("frontend") }}/assets/js/bootstrap.min.js"></script>
<script src="{{ asset("frontend") }}/assets/js/script.js"></script>

<script>
    $('.select2').select2(
        { theme: 'bootstrap4'}
    )
</script>
@stack("js")
</html>
