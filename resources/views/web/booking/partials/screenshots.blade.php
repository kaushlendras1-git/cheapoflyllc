<div class="tab-pane fade" id="screenshots" role="tabpanel" aria-labelledby="screenshots-tab">
    <div class="card p-4 show-booking-card">
        <div class="mb-0">
            <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Screenshots</h5>
            <input type="file" id="screenshots-upload" name="screenshots[]" multiple>
        </div>

        @if(isset($screenshot_images) && $screenshot_images->count())
            <div class="" style="margin-top:20px">
                @if( auth()->user()->role != 1)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped crm-table">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>Image Preview</th>
                                <th>Agent Name</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($screenshot_images as $key => $img)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <a href="{{ asset($img->file_path) }}" target="_blank">
                                        <img width="100" src="{{ asset($img->file_path) }}" class="img-thumbnail" style="max-height: 100px;" alt="Screenshot Image">
                                    </a>
                                </td>
                                <td>{{ $img->get_agent?->name }}</td>
                                <td>{{ $img->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                 @endif 
            </div>
         @endif     
    </div>
</div>