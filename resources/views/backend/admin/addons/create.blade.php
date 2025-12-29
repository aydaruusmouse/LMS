<form action="#">
    <div class="row gx-20">
        <span class="py-40 text-center">{{__('If yuo have a plugin in a .zip format, you may install or update it by uploading it here.')}}</span>
        <div class="col-lg-12">
            <div class="mb-4">
                <label for="thumbnailFile" class="form-label">{{__('choose_file')}}</label>
                <label for="thumbnailFile" class="file-upload-text">
                    <p>{{__('no_file_chosen')}}</p>
                    <span class="file-btn">{{__('choose_file')}}</span>
                </label>
                <input class="d-none" type="file" id="thumbnailFile">
            </div>
        </div>
        <!-- End Choose File -->

        <div class="col-12">
            <div class="">
                <label for="purchaseCode" class="form-label">{{__('purchase_code')}}</label>
                <input type="text" class="form-control rounded-2" id="purchaseCode">
            </div>
        </div>
        <!-- End Purchase Code -->

    </div>
    <div class="d-flex justify-content-end align-items-center mt-30">
        <button type="button" class="btn sg-btn-primary">{{__('install_now')}}</button>
        <!-- <button type="button" class="btn sg-btn-outline-primary">Next</button> -->
    </div>
</form>
