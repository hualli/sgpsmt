<?php

namespace App\Enums;

enum PermitStatus: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
    case Expired = 'expired';
}
