@foreach(File::allFiles(resource_path('views/components')) as  $single)
    {!! $single->getContents() !!}
@endforeach