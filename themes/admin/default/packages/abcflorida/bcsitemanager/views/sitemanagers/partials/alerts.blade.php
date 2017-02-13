@if ( isset( $msg ) )     
<div data-alert class="alert-box alert-bar alert-effect-slidetop alert-type-error alert-show"><div class="alert-box-inner"><span class="icon"><i class="fa fa-info"></i></span><p>{{ $msg }}</p></div><span class="alert-close"><i class="fa fa-times-circle-o"></i></span></div>
@else
<div data-alert class="alert-box alert-bar alert-effect-slidetop alert-type-error alert-show"><div class="alert-box-inner"><span class="icon"><i class="fa fa-info"></i></span><p>Message was lost</p></div><span class="alert-close"><i class="fa fa-times-circle-o"></i></span></div>
@endif