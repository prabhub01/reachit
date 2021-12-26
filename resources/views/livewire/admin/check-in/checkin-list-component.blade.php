<div>
 <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createEntry">
                Create Entry
            </button>

            <div wire:ignore.self class="modal fade" id="createEntry" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Check In Entry</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true close-btn">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="store">


                                @if(Session::has('flash_success'))
                                    <div class="alert alert-custom alert-success no-border">
                                        <div class="alert-icon"><i class="icon fa fa-check"></i></div>
                                        <div class="alert-text">{!! Session::get('flash_success') !!}</div>
                                        <div class="alert-close">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                            </button>
                                        </div>
                                    </div>
                                @endif


                                @if (Session::has('flash_error'))
                                    <div class="alert alert-custom alert-danger no-border">
                                        <div class="alert-icon"><i class="icon fa fa-warning"></i></div>
                                        <div class="alert-text">{!! Session::get('flash_error') !!}</div>
                                        <div class="alert-close">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                            </button>
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group col-md-6">
                                    <label for="exampleFormControlInput1">Flyer ID</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1"
                                           placeholder="Enter Name" wire:model="flyer_id">
                                    <br>
                                    <button type="button" wire:click="fetchFlyer" class="btn btn-primary btn -xs">Fetch
                                        Flyer Details
                                    </button>

                                    @if (Session::has('flyer_error'))
                                        <span class="text-danger error">{{ session('flyer_error') }}</span>
                                    @endif
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Name</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput2"
                                               wire:model="name" placeholder="Enter Email" readonly>
                                        @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Mobile Number</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput2"
                                               wire:model="mobile_number" placeholder="Enter Mobile" readonly>
                                        @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="exampleFormControlInput2">Price</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput2"
                                               wire:model="price" placeholder="Enter Price" readonly>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="exampleFormControlInput2">Points</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput2"
                                               wire:model="points" placeholder="Enter Points" readonly>
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close
                            </button>
                            <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Save
                                changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
