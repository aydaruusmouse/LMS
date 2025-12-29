<table class="table table-borderless best-selling-courses">
    <thead>
        <tr>
            <th>{{__('course_title')}}</th>
            <th>{{__('price')}}</th>
            <th>{{__('enroll')}}</th>
        </tr>
    </thead>

    <tbody>

        @foreach ($best_selling_courses as $course)
            <tr>
                <td>
                    <div class="selling-course-title d-flex align-items-center">
                        <div class="selling-course-thumb">
                            <img src="{{ getFileLink('402x248', $course->image) }}" alt="">
                        </div>
                        <p>{{ $course->title }}</p>
                    </div>
                </td>
                <td><span class="price">${{ $course->price }}</span></td>
                <td><span class="enrolle">{{ $course->enrolls->count() }}</span></td>
            </tr>
        @endforeach

    </tbody>
</table>
