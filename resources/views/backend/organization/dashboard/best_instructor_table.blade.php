<table class="table table-borderless best-selling-courses best-instructor">
    <thead>
        <tr>
            <th>{{__('instructor_name')}}</th>
            <th>{{__('rating')}}</th>
            <th>{{__('course')}}</th>
            <th>{{__('total_sell')}}</th>
        </tr>
    </thead>

    <tbody>

        @foreach ($best_instructors as $instructor)
            <tr>
                <td>
                    <div class="instructors-pro d-flex align-items-center">
                        <div class="inst-avtar">
                            <img src="{{ getFileLink('402x248', $instructor->image) }}" alt="">
                        </div>
                        <div class="inst-intro">
                            <h6>{{ $instructor->user->first_name }}
                                {{ $instructor->user->last_name }}</h6>
                            <p>{{ $instructor->organization->org_name }}</p>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="rating"><i class="las la-star"></i>
                        {{ $instructor->total_rating }} (1264)</span>
                </td>
                <td><span class="ins-course">29</span></td>
                <td><span class="sell">$8567.50</span></td>
            </tr>
        @endforeach

    </tbody>
</table>
