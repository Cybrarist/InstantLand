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
@if ($message = Session::get('success'))
<div style="background: #10b981; width: 100%; position: absolute; top: 0; z-index: 1000; height: 50px;
        color: white; font-size: 16px; display: flex; justify-content: center;align-items: center;" >
        {{$message}}
</div>
@endif

{!! $landing_page->html !!}

<script>

    var errors= @if($errors) {!! $errors !!}  @else  {} @endif

    var error_keys= Object.keys(errors)

    //get the form elements
    var form_elements= document.getElementsByTagName("form")

    for(let i = 0;i < form_elements.length; i++)
    {
        // add  csrf token and make the submission url to the same page
        var csrfToken="{{csrf_token()}}"
        var csrfInput = document.createElement("input");
        csrfInput.setAttribute("type", "hidden");
        csrfInput.setAttribute("name", "_token");
        csrfInput.setAttribute("value", csrfToken);

        form_elements[i].appendChild(csrfInput);

        form_elements[i].method="post"

        form_elements[i].action="{{route('landing_pages.form', $landing_page->link)}}"

        error_keys.forEach((elem)=>{
                form_elements[i].querySelector(`[name=${elem}]`).insertAdjacentHTML('afterend', `<span class='custom_landing_page_error'>${errors[elem][0]}</span>`)
        })

    }
</script>
</body>

</html>

