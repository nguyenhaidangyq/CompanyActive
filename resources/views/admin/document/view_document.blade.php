@extends("admin_layout")
@section("admin_main")
    <div class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <iframe src="https://docs.google.com/viewer?url={{asset("upload/documents/".$document->document_name)}}&embedded=true"></iframe>
                </div>
            </div>
        </div>
    </div>

@endsection
