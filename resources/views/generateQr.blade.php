
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <title>{{__('main.fatoorah')}} - PDF</title>
    <meta charset="UTF-8">
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<style type="text/css">
    .invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
th,tr, td{
    text-align: center;
}
</style>
</head>
<body>

<script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">    
    <div class="row">
        <div class="col-md-12">
            {!! QrCode::size(200)->format('svg')->generate($ticket->id) !!}
        </div>
    </div>
</div>
</body>
</html>
