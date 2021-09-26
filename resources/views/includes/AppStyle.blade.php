{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 --}}

 <link rel="stylesheet" href="{{ URL('css/style-starter.css') }} ">

<style type="text/css">
/* Popup CSS */
.wrap_popup{
	display:none;
	position: fixed;
	z-index: 1;
	left: 0;
	top: 0;
	height:100%;
	width:100%;
	overflow:auto;
    opacity: 0.6;
}

.popup{
	height:auto;
	width:80%;
	max-width:600px;
	margin:5% auto;
	display:block;
	border-radius:8px;
	overflow:hidden;
}

.title{
	width:100%;
	display:block;
	font-weight:700;
	padding:5px;
}

.title p{
	margin:5px;
}

.box{
	width:100%;
	display:block;
	padding:5px;
}

.box p{
	margin:5px;
}

.box button{
	padding:10px;
	margin:10px 0px 10px 0px;
	border:3px solid ;
	border-radius:5px;
}

.ui-datepicker-calendar {
   display: none;
}
</style>