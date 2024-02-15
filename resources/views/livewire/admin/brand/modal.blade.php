<!-- Brand Add Modal -->
<div>
    <div wire:ignore.self class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Brands</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="storeBrand()">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Select Category</label>
                            <select wire:model.defer="category_id"  class=" form-control">
                                <option value="">---Select Category---</option>
                                @foreach ($categories as $cateItem )
                                <option value="{{$cateItem->id}}">{{$cateItem->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="brandName">Brand Name</label>
                            <input type="text" class="form-control" wire:model.defer="name" id="brandName">
                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="brandSlug">Brand Slug</label>
                            <input type="text" class="form-control" wire:model.defer="slug" id="brandSlug">
                            @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status">Status</label>
                            <input type="checkbox" wire:model.defer="status" id="status">
                            Checked=Hidden, Un-Checked= Visible
                            @error('status')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Brand Update Modal -->
<div>
    <div wire:ignore.self class="modal fade" id="updateBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Brands</h1>
                    <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div wire:loading class="p-2">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>Loading...
                </div>

                <div wire:loading.remove>

                    <form wire:submit.prevent="updateBrand">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Select Category</label>
                                <select wire:model.defer="category_id"  class=" form-control">
                                    <option value="">---Select Category---</option>
                                    @foreach ($categories as $cateItem )
                                    <option value="{{$cateItem->id}}">{{$cateItem->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="brandName">Brand Name</label>
                                <input type="text" class="form-control" wire:model.defer="name">
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="brandSlug">Brand Slug</label>
                                <input type="text" class="form-control" wire:model.defer="slug">
                                @error('slug')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Status</label><br />
                                <input type="checkbox" wire:model.defer="status"
                                    style="width: 20px; height:20px">Checked=Hidden, Un-Checked= Visible
                                @error('status')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click="closeModal" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Brand Delete Modal -->
<div>
    <div wire:ignore.self class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Brands</h1>
                    <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div wire:loading class="p-2">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>Loading...
                </div>

                <div wire:loading.remove>

                    <form wire:submit.prevent="destroyBrand">
                        <h4>Are you sure , you want to delete this data?</h4>
                        <div class="modal-footer">
                            <button type="button" wire:click="closeModal" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning">Yes, Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>