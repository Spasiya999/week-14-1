<x-app-layout>
    @section('content')
        <div class="card card-primary m-3">
            <div class="card-header">
                <h3 class="card-title">Add room</h3>
            </div>
            <form method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="RoomNO">Room No.</label>
                                <input type="text" class="form-control" id="roomNo" placeholder="Room No."
                                    name="room_no">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Room type</label>
                                <select name="status" id="status" class="custom-select">
                                    <option>Select Room type</option>
                                    @foreach ($types as $key => $type)
                                        <option value="{{ $key }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">description</label>
                        <textarea class="form-control" rows="3" name=description id=description placeholder="Enter ..."></textarea>
                    </div>
                    {{-- add images upload section --}}
                    <div class="col-6">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <div id="roomImageDrop" class="dropzone"></div>
                            <input type="hidden" name="image" id="image">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="beds">No.of Beds</label>
                                <input type="number" class="form-control" id="beds" name="beds">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="occupancy">Max occupancy</label>
                                <input type="number" class="form-control" id="occupancy" name="occupancy">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status"> Status</label>
                                <select class="custom-select">
                                    <option>Select Room type</option>
                                    @foreach ($statuses as $key => $status )
                                        <option value="{{$key}}">{{$status}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    @endsection
    @push('css')
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    @endpush
    @push('scripts')
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
        <script>
            Dropzone.autoDiscover = false;
            // The constructor of Dropzone accepts two arguments:
            //
            // 1. The selector for the HTML element that you want to add
            //    Dropzone to, the second
            // 2. An (optional) object with the configuration
            let myDropzone = new Dropzone("#roomImageDrop", {
                url: "{{ route('room.image.upload') }}",
                maxFilesize: 3, // MB
                // acceptedFiles: ".jpeg,.jpg,.png,.gif"
                acceptedFiles: "image/*",
                paramName: "image",
                init: function() {
                    this.on('sending', function(file, xhr, formData) {
                        formData.append('_token', '{{ csrf_token() }}');
                    });
                    this.on("success", function(file, response) {
                        console.log(response);
                        if(response.status){
                            $('#image').val(response.image);
                        }
                    });
                }
            });
        </script>
    @endpush
</x-app-layout>
