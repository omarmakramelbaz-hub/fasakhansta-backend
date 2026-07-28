<div class="container">
     @if (count($errors))
     <div class="alert alert-danger" style="border-radius: 10px;">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
 @endif
</div>
