<?php
  
namespace App\Enums;
 
enum CharityStatusEnum:string {
    case pending = 'pending';
    case active = 'active';
    case inactive = 'inactive';
    case rejected = 'rejected';

}
