<?php

namespace App\Enums;

enum CourseStatusEnum: string
{
    case DRAFT       = 'draft';

    case IN_REVIEW   = 'in_review';

    case REJECTED    = 'rejected';

    case APPROVED    = 'approved';

    case PUBLISHED   = 'published';

    case UNPUBLISHED = 'unpublished';
}
