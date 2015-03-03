@extends('layout/front')

@section('content')

@include('layout.notify')

    @if(Session::has('login_error'))
        <script>
            var notify = document.getElementById('notify');
            notify.classList.add('is-show');
            notify.classList.add('error');
            notify.querySelector('.text-notify').innerText = 'Datos incorrectos';
        </script>
    @endif

    <div class="Content-home">
        <div id="slider">
            <a href="{{asset('/')}}">
                @for($i=0;$i<count($slidersArrays);$i++)
                    @if($slidersArrays[$i]>0)
                        <img src="sliders/{{$slidersName[$i]}}" />

                    @endif
                @endfor
                @for($i=0;$i<count($slidersArrays);$i++)
                    @if($i==0)
                        <span  class="slider sliderValid">0</span>
                    @else
                        <span  class="slider ">{{$i}}</span>
                    @endif
                @endfor
            </a>
            <span id="back"><</span>
            <span id="next">></span>

        </div>
        <div class="content-sign-up">
            @if(Auth::user())
                <section class="Login">
                    <h2>BIENVENIDA</h2>

                    <section class="content-inf">
                        <figure>
                            <a href="">
                                @if(Auth::user()->photo!="")
                                {{ HTML::image('users/'.Auth::user()->photo,'',array('id'=>'')) }}
                                @else
                                {{ HTML::image('users/profile-default.png','',array('id'=>'')) }}
                                @endif
                            </a>

                        </figure>
                        <div>
                            <p class="title">Tu nombre:</p>
                            <p class="title-body">{{Auth::user()->name}} {{Auth::user()->last_name}}</p>
                            <p class="title">Cedula de ciudadania:</p>
                            <p class="title-body">{{Auth::user()->identification_card}}</p>
                        </div>
                    </section>

                    <a class="button-edit" href="{{route('update',Auth::user()->id)}}">EDITAR PERFIL</a>
                </section>
            @else
                <section class="Login ">
                    <p>INICIAR SESION</p>
                    {{ Form::open(['url' => 'login', 'method' => 'POST', 'role' => 'form', 'class'=>'Login-form','id'=>'loginForm']) }}

                    <div class="">
                        {{Form::label('email','Correo Electronico.',array('id'=>'email'))}}
                        {{Form::text('email','',['id' => 'emailInput'])}}
                    </div>

                    <div class="">
                        {{Form::label('password','Contraseña.',array('id'=>'password'))}}
                        {{Form::password('password',['id' => 'password'])}}
                    </div>
                    <div>
                        <div class="Remember">
                            <a id="Remember" href="{{route('passwordRestart')}}">Olvidaste la contraseña?</a>
                        </div>
                        <button class="home-button" id="signUpButton-home">
                            IDENTIFICARSE
                        </button>
                    </div>
                    {{ Form::close() }}
                </section>
            @endif
            <div class="content-creditRequest" style="background:rgba(13, 12, 12, 0.03) !important; border: 2px solid rgba(204, 204, 204, 0.53);">
                @if(Auth::user())
                    <section class="home-request">
                        <h2>PROXIMO PAGO</h2>
                        <div class="content-text state-text">
                            <p>Fecha limite de pago.</p>
                            <p>Pago minimo.</p>
                            <p>Estado.</p>
                        </div>
                        <div class="content-text state-text1">
                            <p>2015 - 03 - 01</p>
                            <p>$60.000</p>
                            <div><p class="state-home">EN MORA.</p></div>
                        </div>
                        <a href="">ESTADO DE CUENTA</a>
                    </section>
                @else
                    <section class="Home-request ">
                        <p>SOLICITAR CREDITO</p>
                        {{ Form::open(['route' => 'credit', 'method' => 'post', 'role' => 'form', 'class'=>'Login-form','id'=>'loginForm']) }}
                        <div class="">
                            {{Form::label('identification_card','Numero de Cedula.',array('id'=>'email'))}}
                            {{Form::text('identification_card','',['id' => 'identification_card'])}}
                        </div>

                        <div>
                            <div class="Remember">
                                <a id="Remember" href="{{route('passwordRestart')}}">Como funciona?</a>
                            </div>
                            <button class="home-button" id="signUpButton-home">
                                IDENTIFICARSE
                            </button>
                        </div>
                        {{ Form::close() }}

                    </section>
                @endif

            </div>
        </div>

        <div class="content-Request">
            <a href="{{asset('/')}}">
                <img src="{{asset('img/inferior.png')}}">
            </a>
        </div>

    </div>


@stop

@section('javascript')
        {{ HTML::script('js/slider.js'); }}
@stop
