@extends('admin.dash')
@section('content')
<div class="container-fluid" id="admin-brand-container">
	<h4 class="text-center">Add new Page</h4><br><br>
	<form role="form" method="POST" action="{{ route('admin.static.store') }}">
		{{ csrf_field() }}
		<div class="col-sm-6 col-md-4 col-md-offset-1" id="Product-Input-Field">
			<div class="form-group{{ $errors->has('page_title') ? ' has-error' : '' }}">
				<label>Page Title</label>
				<input type="text" class="form-control" name="page_title" value="{{ old('page_title') }}" placeholder="Add New Product">
				@if($errors->has('page_title'))
				<span class="help-block">{{ $errors->first('page_title') }}</span>
				@endif
			</div>
		</div>
		<div class="col-sm-12 col-md-10 col-md-offset-1">
			<div class="form-group{{ $errors->has('page_description') ? ' has-error' : '' }}">
				<label for="page_description">Page page_Description</label>
				<textarea id="page-description" name="page_description">
				{{ old('page_description') }}
				</textarea>
				@if($errors->has('page_description'))
				<span class="help-block">{{ $errors->first('page_description') }}</span>
				@endif
			</div>
		</div>
        <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Create Page</button>
            </div>
	</form>
</div>
@endsection
@section('footer')
        <!-- Include Froala Editor JS files. -->
    <script type="text/javascript" src="{{ asset('src/public/js/libs/froala_editor.min.js') }}"></script>

    <!-- Include Plugins. -->
    <script type="text/javascript" src="{{ asset('src/public/js/plugins/align.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/public/js/plugins/char_counter.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/public/js/plugins/font_family.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/public/js/plugins/font_size.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/public/js/plugins/line_breaker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/public/js/plugins/lists.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/public/js/plugins/paragraph_format.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/public/js/plugins/paragraph_style.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/public/js/plugins/quote.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/public/js/plugins/image.min.js') }}"></script>


    <script>
        $(function() {
            $('#page-description').froalaEditor({
            	imageUploadURL: '{{ route('admin.static.upload') }}',
                imageUploadParams: {
                    _token: '{{csrf_token()}}'
                },
            	imageUploadMethod: 'POST',
            	imageAllowedTypes: ['jpeg', 'jpg', 'png'],
                charCounterMax: 2500,
                height: 500,
                codeBeautifier: true,
                placeholderText: 'Insert Page Content here...',
                toolbarButtons:["fullscreen","bold","italic","underline","strikeThrough","subscript","superscript","fontFamily","fontSize","color","emoticons","inlineStyle","paragraphStyle","paragraphFormat","align","formatOL","formatUL","outdent","indent","quote","insertHR","insertLink","insertImage","insertVideo","insertFile","insertTable","undo","redo","clearFormatting","selectAll","html"],
            })
        });
    </script>

@endsection