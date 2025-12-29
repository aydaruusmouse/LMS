<div class="modal" id="clone_menu">
    <li class="dd-item dd3-item menu-item" data-id="2">
        <input type="hidden" name="menu_lenght[]" id="menu_lenght" value="1">
        <div class="dd-handle dd3-handle"></div>
        <div class="dd3-content sortable-section mb-4">
            <ul class="sortable-menu-icon">
                <li class="menuMove">
                </li>
                <li>
                    <a href="#" onclick="$(this).closest('.dd-item').remove()" class="delete-icon"><i
                            class="las la-trash-alt"></i></a>
                </li>
            </ul>

            <div class="row gx-20 align-items-center">
                <div class="col-lg-3">
                    <input type="text" name="label[]" class="form-control rounded-2"
                        placeholder="Label" required>
                </div>
                <div class="col-lg-9">
                    <div class="d-flex align-items-center gap-4">
                        <input type="text" name="url[]" class="form-control rounded-2"
                            placeholder="Link" required>
                            <div class="custom-checkbox" id="mega-menu-area">
                                <label class="d-flex align-items-center">
                                    <input type="checkbox" class="mega_menu" value="">
                                    <span class="">Mega Menu</span>
                                    <input type="hidden" name="mega_menu_position[]" value="">
                                </label>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
</div>