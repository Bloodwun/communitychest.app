@extends('user.layouts.master')

@section('title') Promotional PDF @endsection

@section('content')

@component('user.components.breadcrumb')
@slot('li_1') Promotional PDFs @endslot
@slot('title') Promotional PDFs @endslot
@endcomponent
<style>
    .table-responsive {
    max-height: 80vh; /* Adjust the max-height as needed */
    overflow-y: auto; /* Make the table body scrollable */
}

.table {
    width: 100%;
    table-layout: fixed; /* Ensures that the table cells maintain their widths */
}

.table th, .table td {
    text-align: center; /* Optional: Center the text inside table cells */
    vertical-align: middle; /* Optional: Vertically center content in cells */
}

</style>
<div class="container">
    @if(Auth::user()->role_id == App\Models\Role::BUSINESS_ROLE)
    <a href="{{ route('promotional.create') }}" class="btn btn-primary">Add New Promotional PDF</a>
    @endif
    <div class="table-responsive mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Logo</th>
                    <th>Banner</th>
                    
                    <!-- Add columns for images 1 to 10 -->
                    @foreach(range(1, 10) as $i)
                        <th>Image {{ $i }}</th>
                    @endforeach
                    
                    <th>Coupon Code</th>
                    <th>Start Date</th>
                    <th>Expiration Date</th>
                    @if(Auth::user()->role_id == App\Models\Role::BUSINESS_ROLE)
                    <th>Actions</th>
    @endif
                   
                </tr>
            </thead>
            <tbody>
                @foreach($promotionalPdfs as $pdf)
                <tr>
                    <td>{{ $pdf->id }}</td>
                    
                    <!-- Display the logo image -->
                    <td>
                        @if($pdf->logo) 
                            <img src="{{ asset($pdf->logo) }}" alt="Logo" width="50">
                       
                        @endif
                    </td>
                    
                    <!-- Display the banner image -->
                    <td>
                        @if($pdf->banner) 
                            <img src="{{ asset($pdf->banner) }}" alt="Banner" width="100">
                       
                        @endif
                    </td>
                    
                    <!-- Display other images (img1, img2, ..., img10) -->
                    @foreach(range(1, 10) as $i)
                        <td>
                            @if($pdf->{'img' . $i})
                                <img src="{{ asset($pdf->{'img' . $i}) }}" alt="Image {{ $i }}" width="50">
                          
                            @endif
                        </td>
                    @endforeach
                    
                    <!-- Display other data -->
                    <td>{{ $pdf->coupon_code }}</td>
                    <td>{{ $pdf->start_date }}</td>
                    <td>{{ $pdf->expiration_date }}</td>
                    @if(Auth::user()->role_id == App\Models\Role::BUSINESS_ROLE)
                    <td>

                        <!-- Edit Button -->
                        <a href="{{ route('promotional.edit', $pdf->id) }}" class="btn btn-warning">Edit</a>
                        
                        <!-- Delete Button -->
                        <form action="{{ route('promotional.destroy', $pdf->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
    @endif
                   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



@endsection
@section('script')
<!-- apexcharts -->
<script src="{{asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- dashboard init -->
<script src="{{asset('/assets/js/pages/dashboard.init.js') }}"></script>
@endsection