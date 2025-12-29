<div class="col-12 header">
    <div class="course-shorter justify-content-between course-shorter-v2 color-secondary m-b-40 m-b-sm-30">
        <ul class="grid-list">
            <li id="grid-view-tab" class="d-none d-md-inline-block style_type {{ $style == 'grid' ? 'active' : '' }}" data-style="grid"><a
                    href="javascript:void(0)"><i class="fas fa-th"></i></a></li>
            <li id="list-view-tab" class="d-none d-md-inline-block style_type {{ $style == 'list' ? 'active' : '' }}" data-style="list"><a
                    href="javascript:void(0)"><i class="fas fa-th-list"></i></a></li>
            <li class="sort-text d-none d-md-inline-block">{{__('showing') }} {{ $total_results }} {{__('of')  }} {{ $total_courses }} {{__('results') }}</li>
            <li class="toggle-icon d-inline-block d-md-none">
                <a href="#">
                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.6562 10.7147L12.6562 14.5313C12.6562 14.7903 12.8661 15 13.125 15C13.3839 15 13.5937 14.7903 13.5937 14.5313L13.5937 10.7147C14.4001 10.5051 15 9.77752 15 8.90625C15 8.03498 14.4001 7.30742 13.5937 7.09783L13.5937 0.46875C13.5937 0.209656 13.3839 1.41287e-07 13.125 1.63918e-07C12.8661 1.86548e-07 12.6562 0.209656 12.6562 0.46875L12.6562 7.09783C11.8499 7.30742 11.25 8.03498 11.25 8.90625C11.25 9.77752 11.8499 10.5051 12.6562 10.7147ZM13.125 7.96875C13.642 7.96875 14.0625 8.38943 14.0625 8.90625C14.0625 9.42307 13.642 9.84375 13.125 9.84375C12.608 9.84375 12.1875 9.42307 12.1875 8.90625C12.1875 8.38944 12.608 7.96875 13.125 7.96875Z"
                            fill="white"/>
                        <path
                            d="M7.03125 7.43342L7.03125 14.5313C7.03125 14.7903 7.24113 15 7.5 15C7.75887 15 7.96875 14.7903 7.96875 14.5313L7.96875 7.43342C8.77513 7.22383 9.375 6.49627 9.375 5.625C9.375 4.75373 8.77513 4.02617 7.96875 3.81658L7.96875 0.46875C7.96875 0.209656 7.75886 1.41287e-07 7.5 1.63918e-07C7.24113 1.86548e-07 7.03125 0.209656 7.03125 0.46875L7.03125 3.81658C6.22487 4.02617 5.625 4.75373 5.625 5.625C5.625 6.49627 6.22487 7.22383 7.03125 7.43342ZM7.5 4.6875C8.01704 4.6875 8.4375 5.10818 8.4375 5.625C8.4375 6.14182 8.01704 6.5625 7.5 6.5625C6.98296 6.5625 6.5625 6.14182 6.5625 5.625C6.5625 5.10819 6.98296 4.6875 7.5 4.6875Z"
                            fill="white"/>
                        <path
                            d="M-5.32733e-07 8.90625C-4.56564e-07 9.77752 0.59987 10.5051 1.40625 10.7147L1.40625 14.5313C1.40625 14.7903 1.61613 15 1.875 15C2.13387 15 2.34375 14.7903 2.34375 14.5313L2.34375 10.7147C3.15013 10.5051 3.75 9.77752 3.75 8.90625C3.75 8.03498 3.15013 7.30742 2.34375 7.09783L2.34375 0.46875C2.34375 0.209656 2.13386 1.41287e-07 1.875 1.63918e-07C1.61613 1.86548e-07 1.40625 0.209656 1.40625 0.46875L1.40625 7.09783C0.59987 7.30742 -6.08901e-07 8.03498 -5.32733e-07 8.90625ZM1.875 7.96875C2.39204 7.96875 2.8125 8.38943 2.8125 8.90625C2.8125 9.42307 2.39204 9.84375 1.875 9.84375C1.35796 9.84375 0.9375 9.42307 0.937499 8.90625C0.937499 8.38944 1.35796 7.96875 1.875 7.96875Z"
                            fill="white"/>
                    </svg>
                </a>
            </li>
        </ul>
        <div class="sort-right">
            <div class="course-dropdown d-none d-sm-block">
                <select class="course-sort" name="sorting">
                    <option value="latest" {{ $sorting == 'latest' ? 'selected':'' }}>{{__('latest') }}</option>
                    <option value="top_rated" {{ $sorting == 'top_rated' ? 'selected':'' }} >{{__('top_rated') }}</option>
                    <option value="oldest" {{ $sorting == 'oldest' ? 'selected':'' }} >{{__('oldest') }}</option>
                </select>
            </div>
            <form method="get" action="#" id="course-filter-form" class="search-form">
                <input type="text" placeholder="{{__('search') }}" name="q" value="{{ $q ?? '' }}" class="keyword">
                <button type="button" class="search-btn"><i class="bx bx-search"></i></button>
            </form>
        </div>
    </div>
</div>
