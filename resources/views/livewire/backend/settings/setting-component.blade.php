<div>
    @include('backend.includes.breadcrumb', ['page_title' => $page_title])

    @if(Session::has('message'))
        <script>
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
            icon: 'success',
            title: '{{ Session::get("message") }}'
            })
        </script>
    @endif

    <div class="card border-top border-0 border-4 border-info">
        <div class="card-body">
            <div class="border p-4 rounded">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bxs-cog me-1 font-22 text-info"></i>
                    </div>
                    <h5 class="mb-0 text-info">Settings</h5>
                </div>
                <hr>
                <form wire:submit.prevent="updateSetting">
                    <div class="row mb-3">
                        <label for="email" class="col-sm-3 col-form-label">Site Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" wire:model="email" id="email" placeholder="Enter site email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Phone No</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="inputPhoneNo2" wire:model="phone" placeholder="Phone No">
                            @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputAddress4" class="col-sm-3 col-form-label">Address</label>
                        <div class="col-sm-9">
                            <textarea class="form-control @error('address') is-invalid @enderror" wire:model="address" id="inputAddress4" rows="3" placeholder="Address"></textarea>
                            @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="footer_text" class="col-sm-3 col-form-label">Footer text</label>
                        <div class="col-sm-9">
                            <textarea class="form-control @error('footerText') is-invalid @enderror" wire:model="footerText" id="footer_text" rows="3"
                                placeholder="Footer text" ></textarea>
                            @error('footerText')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="facebook" class="col-sm-3 col-form-label">Facebook</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('facebook') is-invalid @enderror" wire:model="facebook" id="facebook" placeholder="Facebook link">
                            @error('facebook')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="twitter" class="col-sm-3 col-form-label">Twitter</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('twitter') is-invalid @enderror" wire:model="twitter" id="twitter" placeholder="Twitter link">
                            @error('twitter')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="instagram" class="col-sm-3 col-form-label">Instagram</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('instagram') is-invalid @enderror" wire:model="instagram" id="instagram" placeholder="Instagram link">
                            @error('instagram')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="pinterest" class="col-sm-3 col-form-label">Pinterest</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('pinterest') is-invalid @enderror" wire:model="pinterest" id="pinterest" placeholder="Pinterest link">
                            @error('pinterest')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-success px-5">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
