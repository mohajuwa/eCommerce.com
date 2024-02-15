<div class="row">
    @include('livewire.admin.brand.modal')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Brands List

                    <a href="#" data-bs-toggle="modal" data-bs-target="#addBrandModal"
                        class="btn btn-primary btn-sm float-end">Add
                        Brands</a>
                </h4>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Action</th>


                    </tr>
                </thead>
                <tbody>
                    @forelse ($brands as $brand)
                    <tr>
                        <td>{{ $brand->id }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>
                            @if ($brand->category)
                            {{ $brand->category->name }}
                            @else
                            No Category
                            @endif
                        </td>

                        <td>{{ $brand->slug }}</td>
                        <td>{{ $brand->status == '1' ? 'hidden' : 'visible' }}</td>
                        <td>
                            <a href="#" wire:click="editBrand({{ $brand->id }})" class="btn btn-sm btn-success" href="#"
                                data-bs-toggle="modal" data-bs-target="#updateBrandModal">Edit</a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#deleteBrandModal"
                                wire:click="deleteBrand({{ $brand->id }})" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">No Brands Found </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
            <div>
                {{ $brands->links() }}
            </div>
        </div>
    </div>
</div>
@push('script')
<!-- Livewire listener example in your Livewire view or layout -->
<script>
    Livewire.on('close-modal', function() {
            $('#addBrandModal').modal('hide');
            $('#updateBrandModal').modal('hide');
            $('#deleteBrandModal').modal('hide');


        });
</script>
@endpush